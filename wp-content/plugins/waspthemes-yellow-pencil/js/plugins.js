/* ========================================================================
 * Bootstrap: transition.js v3.3.5
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */

+function ($){
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      WebkitTransition : 'webkitTransitionEnd',
      MozTransition    : 'transitionend',
      OTransition      : 'oTransitionEnd otransitionend',
      transition       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }

    return false // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false
    var $el = this
    $(this).one('bsTransitionEnd', function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()

    if (!$.support.transition) return

    $.event.special.bsTransitionEnd = {
      bindType: $.support.transition.end,
      delegateType: $.support.transition.end,
      handle: function (e) {
        if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
      }
    }
  })

}(jQuery);



/*
* jQuery Mobile v1.4.5
* http://jquerymobile.com
*
* Copyright 2010, 2014 jQuery Foundation, Inc. and other contributors
* Released under the MIT license.
* http://jquery.org/license
*
*/

(function ( root, doc, factory ) {
  if ( typeof define === "function" && define.amd ) {
    // AMD. Register as an anonymous module.
    define( [ "jquery" ], function ( $ ) {
      factory( $, root, doc );
      return $.mobile;
    });
  } else {
    // Browser globals
    factory( root.jQuery, root, doc );
  }
}( this, document, function ( jQuery, window, document, undefined ) {// This plugin is an experiment for abstracting away the touch and mouse
// events so that developers don't have to worry about which method of input
// the device their document is loaded on supports.
//
// The idea here is to allow the developer to register listeners for the
// basic mouse events, such as mousedown, mousemove, mouseup, and click,
// and the plugin will take care of registering the correct listeners
// behind the scenes to invoke the listener at the fastest possible time
// for that device, while still retaining the order of event firing in
// the traditional mouse environment, should multiple handlers be registered
// on the same element for different events.
//
// The current version exposes the following virtual events to jQuery bind methods:
// "vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel"

(function( $, window, document, undefined ) {

var dataPropertyName = "virtualMouseBindings",
  touchTargetPropertyName = "virtualTouchID",
  virtualEventNames = "vmouseover vmousedown vmousemove vmouseup vclick vmouseout vmousecancel".split( " " ),
  touchEventProps = "clientX clientY pageX pageY screenX screenY".split( " " ),
  mouseHookProps = $.event.mouseHooks ? $.event.mouseHooks.props : [],
  mouseEventProps = $.event.props.concat( mouseHookProps ),
  activeDocHandlers = {},
  resetTimerID = 0,
  startX = 0,
  startY = 0,
  didScroll = false,
  clickBlockList = [],
  blockMouseTriggers = false,
  blockTouchTriggers = false,
  eventCaptureSupported = "addEventListener" in document,
  $document = $( document ),
  nextTouchID = 1,
  lastTouchID = 0, threshold,
  i;

$.vmouse = {
  moveDistanceThreshold: 10,
  clickDistanceThreshold: 10,
  resetTimerDuration: 1500
};

function getNativeEvent( event ) {

  while ( event && typeof event.originalEvent !== "undefined" ) {
    event = event.originalEvent;
  }
  return event;
}

function createVirtualEvent( event, eventType ) {

  var t = event.type,
    oe, props, ne, prop, ct, touch, i, j, len;

  event = $.Event( event );
  event.type = eventType;

  oe = event.originalEvent;
  props = $.event.props;

  // addresses separation of $.event.props in to $.event.mouseHook.props and Issue 3280
  // https://github.com/jquery/jquery-mobile/issues/3280
  if ( t.search( /^(mouse|click)/ ) > -1 ) {
    props = mouseEventProps;
  }

  // copy original event properties over to the new event
  // this would happen if we could call $.event.fix instead of $.Event
  // but we don't have a way to force an event to be fixed multiple times
  if ( oe ) {
    for ( i = props.length, prop; i; ) {
      prop = props[ --i ];
      event[ prop ] = oe[ prop ];
    }
  }

  // make sure that if the mouse and click virtual events are generated
  // without a .which one is defined
  if ( t.search(/mouse(down|up)|click/) > -1 && !event.which ) {
    event.which = 1;
  }

  if ( t.search(/^touch/) !== -1 ) {
    ne = getNativeEvent( oe );
    t = ne.touches;
    ct = ne.changedTouches;
    touch = ( t && t.length ) ? t[0] : ( ( ct && ct.length ) ? ct[ 0 ] : undefined );

    if ( touch ) {
      for ( j = 0, len = touchEventProps.length; j < len; j++) {
        prop = touchEventProps[ j ];
        event[ prop ] = touch[ prop ];
      }
    }
  }

  return event;
}

function getVirtualBindingFlags( element ) {

  var flags = {},
    b, k;

  while ( element ) {

    b = $.data( element, dataPropertyName );

    for (  k in b ) {
      if ( b[ k ] ) {
        flags[ k ] = flags.hasVirtualBinding = true;
      }
    }
    element = element.parentNode;
  }
  return flags;
}

function getClosestElementWithVirtualBinding( element, eventType ) {
  var b;
  while ( element ) {

    b = $.data( element, dataPropertyName );

    if ( b && ( !eventType || b[ eventType ] ) ) {
      return element;
    }
    element = element.parentNode;
  }
  return null;
}

function enableTouchBindings() {
  blockTouchTriggers = false;
}

function disableTouchBindings() {
  blockTouchTriggers = true;
}

function enableMouseBindings() {
  lastTouchID = 0;
  clickBlockList.length = 0;
  blockMouseTriggers = false;

  // When mouse bindings are enabled, our
  // touch bindings are disabled.
  disableTouchBindings();
}

function disableMouseBindings() {
  // When mouse bindings are disabled, our
  // touch bindings are enabled.
  enableTouchBindings();
}

function startResetTimer() {
  clearResetTimer();
  resetTimerID = setTimeout( function() {
    resetTimerID = 0;
    enableMouseBindings();
  }, $.vmouse.resetTimerDuration );
}

function clearResetTimer() {
  if ( resetTimerID ) {
    clearTimeout( resetTimerID );
    resetTimerID = 0;
  }
}

function triggerVirtualEvent( eventType, event, flags ) {
  var ve;

  if ( ( flags && flags[ eventType ] ) ||
        ( !flags && getClosestElementWithVirtualBinding( event.target, eventType ) ) ) {

    ve = createVirtualEvent( event, eventType );

    $( event.target).trigger( ve );
  }

  return ve;
}

function mouseEventCallback( event ) {
  var touchID = $.data( event.target, touchTargetPropertyName ),
    ve;

  if ( !blockMouseTriggers && ( !lastTouchID || lastTouchID !== touchID ) ) {
    ve = triggerVirtualEvent( "v" + event.type, event );
    if ( ve ) {
      if ( ve.isDefaultPrevented() ) {
        event.preventDefault();
      }
      if ( ve.isPropagationStopped() ) {
        event.stopPropagation();
      }
      if ( ve.isImmediatePropagationStopped() ) {
        event.stopImmediatePropagation();
      }
    }
  }
}

function handleTouchStart( event ) {

  var touches = getNativeEvent( event ).touches,
    target, flags, t;

  if ( touches && touches.length === 1 ) {

    target = event.target;
    flags = getVirtualBindingFlags( target );

    if ( flags.hasVirtualBinding ) {

      lastTouchID = nextTouchID++;
      $.data( target, touchTargetPropertyName, lastTouchID );

      clearResetTimer();

      disableMouseBindings();
      didScroll = false;

      t = getNativeEvent( event ).touches[ 0 ];
      startX = t.pageX;
      startY = t.pageY;

      triggerVirtualEvent( "vmouseover", event, flags );
      triggerVirtualEvent( "vmousedown", event, flags );
    }
  }
}

function handleScroll( event ) {
  if ( blockTouchTriggers ) {
    return;
  }

  if ( !didScroll ) {
    triggerVirtualEvent( "vmousecancel", event, getVirtualBindingFlags( event.target ) );
  }

  didScroll = true;
  startResetTimer();
}

function handleTouchMove( event ) {
  if ( blockTouchTriggers ) {
    return;
  }

  var t = getNativeEvent( event ).touches[ 0 ],
    didCancel = didScroll,
    moveThreshold = $.vmouse.moveDistanceThreshold,
    flags = getVirtualBindingFlags( event.target );

    didScroll = didScroll ||
      ( Math.abs( t.pageX - startX ) > moveThreshold ||
        Math.abs( t.pageY - startY ) > moveThreshold );

  if ( didScroll && !didCancel ) {
    triggerVirtualEvent( "vmousecancel", event, flags );
  }

  triggerVirtualEvent( "vmousemove", event, flags );
  startResetTimer();
}

function handleTouchEnd( event ) {
  if ( blockTouchTriggers ) {
    return;
  }

  disableTouchBindings();

  var flags = getVirtualBindingFlags( event.target ),
    ve, t;
  triggerVirtualEvent( "vmouseup", event, flags );

  if ( !didScroll ) {
    ve = triggerVirtualEvent( "vclick", event, flags );
    if ( ve && ve.isDefaultPrevented() ) {
      // The target of the mouse events that follow the touchend
      // event don't necessarily match the target used during the
      // touch. This means we need to rely on coordinates for blocking
      // any click that is generated.
      t = getNativeEvent( event ).changedTouches[ 0 ];
      clickBlockList.push({
        touchID: lastTouchID,
        x: t.clientX,
        y: t.clientY
      });

      // Prevent any mouse events that follow from triggering
      // virtual event notifications.
      blockMouseTriggers = true;
    }
  }
  triggerVirtualEvent( "vmouseout", event, flags);
  didScroll = false;

  startResetTimer();
}

function hasVirtualBindings( ele ) {
  var bindings = $.data( ele, dataPropertyName ),
    k;

  if ( bindings ) {
    for ( k in bindings ) {
      if ( bindings[ k ] ) {
        return true;
      }
    }
  }
  return false;
}

function dummyMouseHandler() {}

function getSpecialEventObject( eventType ) {
  var realType = eventType.substr( 1 );

  return {
    setup: function(/* data, namespace */) {
      // If this is the first virtual mouse binding for this element,
      // add a bindings object to its data.

      if ( !hasVirtualBindings( this ) ) {
        $.data( this, dataPropertyName, {} );
      }

      // If setup is called, we know it is the first binding for this
      // eventType, so initialize the count for the eventType to zero.
      var bindings = $.data( this, dataPropertyName );
      bindings[ eventType ] = true;

      // If this is the first virtual mouse event for this type,
      // register a global handler on the document.

      activeDocHandlers[ eventType ] = ( activeDocHandlers[ eventType ] || 0 ) + 1;

      if ( activeDocHandlers[ eventType ] === 1 ) {
        $document.bind( realType, mouseEventCallback );
      }

      // Some browsers, like Opera Mini, won't dispatch mouse/click events
      // for elements unless they actually have handlers registered on them.
      // To get around this, we register dummy handlers on the elements.

      $( this ).bind( realType, dummyMouseHandler );

      // For now, if event capture is not supported, we rely on mouse handlers.
      if ( eventCaptureSupported ) {
        // If this is the first virtual mouse binding for the document,
        // register our touchstart handler on the document.

        activeDocHandlers[ "touchstart" ] = ( activeDocHandlers[ "touchstart" ] || 0) + 1;

        if ( activeDocHandlers[ "touchstart" ] === 1 ) {
          $document.bind( "touchstart", handleTouchStart )
            .bind( "touchend", handleTouchEnd )

            // On touch platforms, touching the screen and then dragging your finger
            // causes the window content to scroll after some distance threshold is
            // exceeded. On these platforms, a scroll prevents a click event from being
            // dispatched, and on some platforms, even the touchend is suppressed. To
            // mimic the suppression of the click event, we need to watch for a scroll
            // event. Unfortunately, some platforms like iOS don't dispatch scroll
            // events until *AFTER* the user lifts their finger (touchend). This means
            // we need to watch both scroll and touchmove events to figure out whether
            // or not a scroll happenens before the touchend event is fired.

            .bind( "touchmove", handleTouchMove )
            .bind( "scroll", handleScroll );
        }
      }
    },

    teardown: function(/* data, namespace */) {
      // If this is the last virtual binding for this eventType,
      // remove its global handler from the document.

      --activeDocHandlers[ eventType ];

      if ( !activeDocHandlers[ eventType ] ) {
        $document.unbind( realType, mouseEventCallback );
      }

      if ( eventCaptureSupported ) {
        // If this is the last virtual mouse binding in existence,
        // remove our document touchstart listener.

        --activeDocHandlers[ "touchstart" ];

        if ( !activeDocHandlers[ "touchstart" ] ) {
          $document.unbind( "touchstart", handleTouchStart )
            .unbind( "touchmove", handleTouchMove )
            .unbind( "touchend", handleTouchEnd )
            .unbind( "scroll", handleScroll );
        }
      }

      var $this = $( this ),
        bindings = $.data( this, dataPropertyName );

      // teardown may be called when an element was
      // removed from the DOM. If this is the case,
      // jQuery core may have already stripped the element
      // of any data bindings so we need to check it before
      // using it.
      if ( bindings ) {
        bindings[ eventType ] = false;
      }

      // Unregister the dummy event handler.

      $this.unbind( realType, dummyMouseHandler );

      // If this is the last virtual mouse binding on the
      // element, remove the binding data from the element.

      if ( !hasVirtualBindings( this ) ) {
        $this.removeData( dataPropertyName );
      }
    }
  };
}

// Expose our custom events to the jQuery bind/unbind mechanism.

for ( i = 0; i < virtualEventNames.length; i++ ) {
  $.event.special[ virtualEventNames[ i ] ] = getSpecialEventObject( virtualEventNames[ i ] );
}

// Add a capture click handler to block clicks.
// Note that we require event capture support for this so if the device
// doesn't support it, we punt for now and rely solely on mouse events.
if ( eventCaptureSupported ) {
  document.addEventListener( "click", function( e ) {
    var cnt = clickBlockList.length,
      target = e.target,
      x, y, ele, i, o, touchID;

    if ( cnt ) {
      x = e.clientX;
      y = e.clientY;
      threshold = $.vmouse.clickDistanceThreshold;

      // The idea here is to run through the clickBlockList to see if
      // the current click event is in the proximity of one of our
      // vclick events that had preventDefault() called on it. If we find
      // one, then we block the click.
      //
      // Why do we have to rely on proximity?
      //
      // Because the target of the touch event that triggered the vclick
      // can be different from the target of the click event synthesized
      // by the browser. The target of a mouse/click event that is synthesized
      // from a touch event seems to be implementation specific. For example,
      // some browsers will fire mouse/click events for a link that is near
      // a touch event, even though the target of the touchstart/touchend event
      // says the user touched outside the link. Also, it seems that with most
      // browsers, the target of the mouse/click event is not calculated until the
      // time it is dispatched, so if you replace an element that you touched
      // with another element, the target of the mouse/click will be the new
      // element underneath that point.
      //
      // Aside from proximity, we also check to see if the target and any
      // of its ancestors were the ones that blocked a click. This is necessary
      // because of the strange mouse/click target calculation done in the
      // Android 2.1 browser, where if you click on an element, and there is a
      // mouse/click handler on one of its ancestors, the target will be the
      // innermost child of the touched element, even if that child is no where
      // near the point of touch.

      ele = target;

      while ( ele ) {
        for ( i = 0; i < cnt; i++ ) {
          o = clickBlockList[ i ];
          touchID = 0;

          if ( ( ele === target && Math.abs( o.x - x ) < threshold && Math.abs( o.y - y ) < threshold ) ||
                $.data( ele, touchTargetPropertyName ) === o.touchID ) {
            // XXX: We may want to consider removing matches from the block list
            //      instead of waiting for the reset timer to fire.
            e.preventDefault();
            e.stopPropagation();
            return;
          }
        }
        ele = ele.parentNode;
      }
    }
  }, true);
}
})( jQuery, window, document );

(function( $ ) {
  $.mobile = {};
}( jQuery ));

  (function( $, undefined ) {
    var support = {
      touch: "ontouchend" in document
    };

    $.mobile.support = $.mobile.support || {};
    $.extend( $.support, support );
    $.extend( $.mobile.support, support );
  }( jQuery ));


(function( $, window, undefined ) {
  var $document = $( document ),
    supportTouch = $.mobile.support.touch,
    scrollEvent = "touchmove scroll",
    touchStartEvent = supportTouch ? "touchstart" : "mousedown",
    touchStopEvent = supportTouch ? "touchend" : "mouseup",
    touchMoveEvent = supportTouch ? "touchmove" : "mousemove";

  // setup new event shortcuts
  $.each( ( "touchstart touchmove touchend " +
    "tap taphold " +
    "swipe swipeleft swiperight " +
    "scrollstart scrollstop" ).split( " " ), function( i, name ) {

    $.fn[ name ] = function( fn ) {
      return fn ? this.bind( name, fn ) : this.trigger( name );
    };

    // jQuery < 1.8
    if ( $.attrFn ) {
      $.attrFn[ name ] = true;
    }
  });

  function triggerCustomEvent( obj, eventType, event, bubble ) {
    var originalType = event.type;
    event.type = eventType;
    if ( bubble ) {
      $.event.trigger( event, undefined, obj );
    } else {
      $.event.dispatch.call( obj, event );
    }
    event.type = originalType;
  }

  // also handles scrollstop
  $.event.special.scrollstart = {

    enabled: true,
    setup: function() {

      var thisObject = this,
        $this = $( thisObject ),
        scrolling,
        timer;

      function trigger( event, state ) {
        scrolling = state;
        triggerCustomEvent( thisObject, scrolling ? "scrollstart" : "scrollstop", event );
      }

      // iPhone triggers scroll after a small delay; use touchmove instead
      $this.bind( scrollEvent, function( event ) {

        if ( !$.event.special.scrollstart.enabled ) {
          return;
        }

        if ( !scrolling ) {
          trigger( event, true );
        }

        clearTimeout( timer );
        timer = setTimeout( function() {
          trigger( event, false );
        }, 50 );
      });
    },
    teardown: function() {
      $( this ).unbind( scrollEvent );
    }
  };

  // also handles taphold
  $.event.special.tap = {
    tapholdThreshold: 750,
    emitTapOnTaphold: true,
    setup: function() {
      var thisObject = this,
        $this = $( thisObject ),
        isTaphold = false;

      $this.bind( "vmousedown", function( event ) {
        isTaphold = false;
        if ( event.which && event.which !== 1 ) {
          return false;
        }

        var origTarget = event.target,
          timer;

        function clearTapTimer() {
          clearTimeout( timer );
        }

        function clearTapHandlers() {
          clearTapTimer();

          $this.unbind( "vclick", clickHandler )
            .unbind( "vmouseup", clearTapTimer );
          $document.unbind( "vmousecancel", clearTapHandlers );
        }

        function clickHandler( event ) {
          clearTapHandlers();

          // ONLY trigger a 'tap' event if the start target is
          // the same as the stop target.
          if ( !isTaphold && origTarget === event.target ) {
            triggerCustomEvent( thisObject, "tap", event );
          } else if ( isTaphold ) {
            event.preventDefault();
          }
        }

        $this.bind( "vmouseup", clearTapTimer )
          .bind( "vclick", clickHandler );
        $document.bind( "vmousecancel", clearTapHandlers );

        timer = setTimeout( function() {
          if ( !$.event.special.tap.emitTapOnTaphold ) {
            isTaphold = true;
          }
          triggerCustomEvent( thisObject, "taphold", $.Event( "taphold", { target: origTarget } ) );
        }, $.event.special.tap.tapholdThreshold );
      });
    },
    teardown: function() {
      $( this ).unbind( "vmousedown" ).unbind( "vclick" ).unbind( "vmouseup" );
      $document.unbind( "vmousecancel" );
    }
  };

  // Also handles swipeleft, swiperight
  $.event.special.swipe = {

    // More than this horizontal displacement, and we will suppress scrolling.
    scrollSupressionThreshold: 30,

    // More time than this, and it isn't a swipe.
    durationThreshold: 1000,

    // Swipe horizontal displacement must be more than this.
    horizontalDistanceThreshold: 30,

    // Swipe vertical displacement must be less than this.
    verticalDistanceThreshold: 30,

    getLocation: function ( event ) {
      var winPageX = window.pageXOffset,
        winPageY = window.pageYOffset,
        x = event.clientX,
        y = event.clientY;

      if ( event.pageY === 0 && Math.floor( y ) > Math.floor( event.pageY ) ||
        event.pageX === 0 && Math.floor( x ) > Math.floor( event.pageX ) ) {

        // iOS4 clientX/clientY have the value that should have been
        // in pageX/pageY. While pageX/page/ have the value 0
        x = x - winPageX;
        y = y - winPageY;
      } else if ( y < ( event.pageY - winPageY) || x < ( event.pageX - winPageX ) ) {

        // Some Android browsers have totally bogus values for clientX/Y
        // when scrolling/zooming a page. Detectable since clientX/clientY
        // should never be smaller than pageX/pageY minus page scroll
        x = event.pageX - winPageX;
        y = event.pageY - winPageY;
      }

      return {
        x: x,
        y: y
      };
    },

    start: function( event ) {
      var data = event.originalEvent.touches ?
          event.originalEvent.touches[ 0 ] : event,
        location = $.event.special.swipe.getLocation( data );
      return {
            time: ( new Date() ).getTime(),
            coords: [ location.x, location.y ],
            origin: $( event.target )
          };
    },

    stop: function( event ) {
      var data = event.originalEvent.touches ?
          event.originalEvent.touches[ 0 ] : event,
        location = $.event.special.swipe.getLocation( data );
      return {
            time: ( new Date() ).getTime(),
            coords: [ location.x, location.y ]
          };
    },

    handleSwipe: function( start, stop, thisObject, origTarget ) {
      if ( stop.time - start.time < $.event.special.swipe.durationThreshold &&
        Math.abs( start.coords[ 0 ] - stop.coords[ 0 ] ) > $.event.special.swipe.horizontalDistanceThreshold &&
        Math.abs( start.coords[ 1 ] - stop.coords[ 1 ] ) < $.event.special.swipe.verticalDistanceThreshold ) {
        var direction = start.coords[0] > stop.coords[ 0 ] ? "swipeleft" : "swiperight";

        triggerCustomEvent( thisObject, "swipe", $.Event( "swipe", { target: origTarget, swipestart: start, swipestop: stop }), true );
        triggerCustomEvent( thisObject, direction,$.Event( direction, { target: origTarget, swipestart: start, swipestop: stop } ), true );
        return true;
      }
      return false;

    },

    // This serves as a flag to ensure that at most one swipe event event is
    // in work at any given time
    eventInProgress: false,

    setup: function() {
      var events,
        thisObject = this,
        $this = $( thisObject ),
        context = {};

      // Retrieve the events data for this element and add the swipe context
      events = $.data( this, "mobile-events" );
      if ( !events ) {
        events = { length: 0 };
        $.data( this, "mobile-events", events );
      }
      events.length++;
      events.swipe = context;

      context.start = function( event ) {

        // Bail if we're already working on a swipe event
        if ( $.event.special.swipe.eventInProgress ) {
          return;
        }
        $.event.special.swipe.eventInProgress = true;

        var stop,
          start = $.event.special.swipe.start( event ),
          origTarget = event.target,
          emitted = false;

        context.move = function( event ) {
          if ( !start || event.isDefaultPrevented() ) {
            return;
          }

          stop = $.event.special.swipe.stop( event );
          if ( !emitted ) {
            emitted = $.event.special.swipe.handleSwipe( start, stop, thisObject, origTarget );
            if ( emitted ) {

              // Reset the context to make way for the next swipe event
              $.event.special.swipe.eventInProgress = false;
            }
          }
          // prevent scrolling
          if ( Math.abs( start.coords[ 0 ] - stop.coords[ 0 ] ) > $.event.special.swipe.scrollSupressionThreshold ) {
            event.preventDefault();
          }
        };

        context.stop = function() {
            emitted = true;

            // Reset the context to make way for the next swipe event
            $.event.special.swipe.eventInProgress = false;
            $document.off( touchMoveEvent, context.move );
            context.move = null;
        };

        $document.on( touchMoveEvent, context.move )
          .one( touchStopEvent, context.stop );
      };
      $this.on( touchStartEvent, context.start );
    },

    teardown: function() {
      var events, context;

      events = $.data( this, "mobile-events" );
      if ( events ) {
        context = events.swipe;
        delete events.swipe;
        events.length--;
        if ( events.length === 0 ) {
          $.removeData( this, "mobile-events" );
        }
      }

      if ( context ) {
        if ( context.start ) {
          $( this ).off( touchStartEvent, context.start );
        }
        if ( context.move ) {
          $document.off( touchMoveEvent, context.move );
        }
        if ( context.stop ) {
          $document.off( touchStopEvent, context.stop );
        }
      }
    }
  };
  $.each({
    scrollstop: "scrollstart",
    taphold: "tap",
    swipeleft: "swipe.left",
    swiperight: "swipe.right"
  }, function( event, sourceEvent ) {

    $.event.special[ event ] = {
      setup: function() {
        $( this ).bind( sourceEvent, $.noop );
      },
      teardown: function() {
        $( this ).unbind( sourceEvent );
      }
    };
  });

})( jQuery, this );


}));




/*
 * jQuery plugin: fieldSelection - v0.1.1 - last change: 2006-12-16
 * (c) 2006 Alex Brem <alex@0xab.cd> - http://blog.0xab.cd
 */
(function(){var fieldSelection={getSelection:function(){var e=(this.jquery)?this[0]:this;return(('selectionStart'in e&&function(){var l=e.selectionEnd-e.selectionStart;return{start:e.selectionStart,end:e.selectionEnd,length:l,text:e.value.substr(e.selectionStart,l)}})||(document.selection&&function(){e.focus();var r=document.selection.createRange();if(r===null){return{start:0,end:e.value.length,length:0}}var re=e.createTextRange();var rc=re.duplicate();re.moveToBookmark(r.getBookmark());rc.setEndPoint('EndToStart',re);return{start:rc.text.length,end:rc.text.length+r.text.length,length:r.text.length,text:r.text}})||function(){return null})()},replaceSelection:function(){var e=(typeof this.id=='function')?this.get(0):this;var text=arguments[0]||'';return(('selectionStart'in e&&function(){e.value=e.value.substr(0,e.selectionStart)+text+e.value.substr(e.selectionEnd,e.value.length);return this})||(document.selection&&function(){e.focus();document.selection.createRange().text=text;return this})||function(){e.value+=text;return jQuery(e)})()}};jQuery.each(fieldSelection,function(i){jQuery.fn[i]=this})})();


// SweetAlert
// 2014-2015 (c) - Tristan Edwards
// github.com/t4t5/sweetalert
!function(e,t,n){"use strict";!function o(e,t,n){function a(s,l){if(!t[s]){if(!e[s]){var i="function"==typeof require&&require;if(!l&&i)return i(s,!0);if(r)return r(s,!0);var u=new Error("Cannot find module '"+s+"'");throw u.code="MODULE_NOT_FOUND",u}var c=t[s]={exports:{}};e[s][0].call(c.exports,function(t){var n=e[s][1][t];return a(n?n:t)},c,c.exports,o,e,t,n)}return t[s].exports}for(var r="function"==typeof require&&require,s=0;s<n.length;s++)a(n[s]);return a}({1:[function(o,a,r){var s=function(e){return e&&e.__esModule?e:{"default":e}};Object.defineProperty(r,"__esModule",{value:!0});var l,i,u,c,d=o("./modules/handle-dom"),f=o("./modules/utils"),p=o("./modules/handle-swal-dom"),m=o("./modules/handle-click"),v=o("./modules/handle-key"),y=s(v),h=o("./modules/default-params"),b=s(h),g=o("./modules/set-params"),w=s(g);r["default"]=u=c=function(){function o(e){var t=a;return t[e]===n?b["default"][e]:t[e]}var a=arguments[0];if(d.addClass(t.body,"stop-scrolling"),p.resetInput(),a===n)return f.logStr("SweetAlert expects at least 1 attribute!"),!1;var r=f.extend({},b["default"]);switch(typeof a){case"string":r.title=a,r.text=arguments[1]||"",r.type=arguments[2]||"";break;case"object":if(a.title===n)return f.logStr('Missing "title" argument!'),!1;r.title=a.title;for(var s in b["default"])r[s]=o(s);r.confirmButtonText=r.showCancelButton?"Confirm":b["default"].confirmButtonText,r.confirmButtonText=o("confirmButtonText"),r.doneFunction=arguments[1]||null;break;default:return f.logStr('Unexpected type of argument! Expected "string" or "object", got '+typeof a),!1}w["default"](r),p.fixVerticalPosition(),p.openModal(arguments[1]);for(var u=p.getModal(),v=u.querySelectorAll("button"),h=["onclick","onmouseover","onmouseout","onmousedown","onmouseup","onfocus"],g=function(e){return m.handleButton(e,r,u)},C=0;C<v.length;C++)for(var S=0;S<h.length;S++){var x=h[S];v[C][x]=g}p.getOverlay().onclick=g,l=e.onkeydown;var k=function(e){return y["default"](e,r,u)};e.onkeydown=k,e.onfocus=function(){setTimeout(function(){i!==n&&(i.focus(),i=n)},0)},c.enableButtons()},u.setDefaults=c.setDefaults=function(e){if(!e)throw new Error("userParams is required");if("object"!=typeof e)throw new Error("userParams has to be a object");f.extend(b["default"],e)},u.close=c.close=function(){var o=p.getModal();d.fadeOut(p.getOverlay(),5),d.fadeOut(o,5),d.removeClass(o,"showSweetAlert"),d.addClass(o,"hideSweetAlert"),d.removeClass(o,"visible");var a=o.querySelector(".sa-icon.sa-success");d.removeClass(a,"animate"),d.removeClass(a.querySelector(".sa-tip"),"animateSuccessTip"),d.removeClass(a.querySelector(".sa-long"),"animateSuccessLong");var r=o.querySelector(".sa-icon.sa-error");d.removeClass(r,"animateErrorIcon"),d.removeClass(r.querySelector(".sa-x-mark"),"animateXMark");var s=o.querySelector(".sa-icon.sa-warning");return d.removeClass(s,"pulseWarning"),d.removeClass(s.querySelector(".sa-body"),"pulseWarningIns"),d.removeClass(s.querySelector(".sa-dot"),"pulseWarningIns"),setTimeout(function(){var e=o.getAttribute("data-custom-class");d.removeClass(o,e)},300),d.removeClass(t.body,"stop-scrolling"),e.onkeydown=l,e.previousActiveElement&&e.previousActiveElement.focus(),i=n,clearTimeout(o.timeout),!0},u.showInputError=c.showInputError=function(e){var t=p.getModal(),n=t.querySelector(".sa-input-error");d.addClass(n,"show");var o=t.querySelector(".sa-error-container");d.addClass(o,"show"),o.querySelector("p").innerHTML=e,setTimeout(function(){u.enableButtons()},1),t.querySelector("input").focus()},u.resetInputError=c.resetInputError=function(e){if(e&&13===e.keyCode)return!1;var t=p.getModal(),n=t.querySelector(".sa-input-error");d.removeClass(n,"show");var o=t.querySelector(".sa-error-container");d.removeClass(o,"show")},u.disableButtons=c.disableButtons=function(){var e=p.getModal(),t=e.querySelector("button.confirm"),n=e.querySelector("button.cancel");t.disabled=!0,n.disabled=!0},u.enableButtons=c.enableButtons=function(){var e=p.getModal(),t=e.querySelector("button.confirm"),n=e.querySelector("button.cancel");t.disabled=!1,n.disabled=!1},"undefined"!=typeof e?e.sweetAlert=e.swal=u:f.logStr("SweetAlert is a frontend module!"),a.exports=r["default"]},{"./modules/default-params":2,"./modules/handle-click":3,"./modules/handle-dom":4,"./modules/handle-key":5,"./modules/handle-swal-dom":6,"./modules/set-params":8,"./modules/utils":9}],2:[function(e,t,n){Object.defineProperty(n,"__esModule",{value:!0});var o={title:"",text:"",type:null,allowOutsideClick:!1,showConfirmButton:!0,showCancelButton:!1,closeOnConfirm:!0,closeOnCancel:!0,confirmButtonText:"OK",confirmButtonColor:"#8CD4F5",cancelButtonText:"Cancel",imageUrl:null,imageSize:null,timer:null,customClass:"",html:!1,animation:!0,allowEscapeKey:!0,inputType:"text",inputPlaceholder:"",inputValue:"",showLoaderOnConfirm:!1};n["default"]=o,t.exports=n["default"]},{}],3:[function(t,n,o){Object.defineProperty(o,"__esModule",{value:!0});var a=t("./utils"),r=(t("./handle-swal-dom"),t("./handle-dom")),s=function(t,n,o){function s(e){m&&n.confirmButtonColor&&(p.style.backgroundColor=e)}var u,c,d,f=t||e.event,p=f.target||f.srcElement,m=-1!==p.className.indexOf("confirm"),v=-1!==p.className.indexOf("sweet-overlay"),y=r.hasClass(o,"visible"),h=n.doneFunction&&"true"===o.getAttribute("data-has-done-function");switch(m&&n.confirmButtonColor&&(u=n.confirmButtonColor,c=a.colorLuminance(u,-.04),d=a.colorLuminance(u,-.14)),f.type){case"mouseover":s(c);break;case"mouseout":s(u);break;case"mousedown":s(d);break;case"mouseup":s(c);break;case"focus":var b=o.querySelector("button.confirm"),g=o.querySelector("button.cancel");m?g.style.boxShadow="none":b.style.boxShadow="none";break;case"click":var w=o===p,C=r.isDescendant(o,p);if(!w&&!C&&y&&!n.allowOutsideClick)break;m&&h&&y?l(o,n):h&&y||v?i(o,n):r.isDescendant(o,p)&&"BUTTON"===p.tagName&&sweetAlert.close()}},l=function(e,t){var n=!0;r.hasClass(e,"show-input")&&(n=e.querySelector("input").value,n||(n="")),t.doneFunction(n),t.closeOnConfirm&&sweetAlert.close(),t.showLoaderOnConfirm&&sweetAlert.disableButtons()},i=function(e,t){var n=String(t.doneFunction).replace(/\s/g,""),o="function("===n.substring(0,9)&&")"!==n.substring(9,10);o&&t.doneFunction(!1),t.closeOnCancel&&sweetAlert.close()};o["default"]={handleButton:s,handleConfirm:l,handleCancel:i},n.exports=o["default"]},{"./handle-dom":4,"./handle-swal-dom":6,"./utils":9}],4:[function(n,o,a){Object.defineProperty(a,"__esModule",{value:!0});var r=function(e,t){return new RegExp(" "+t+" ").test(" "+e.className+" ")},s=function(e,t){r(e,t)||(e.className+=" "+t)},l=function(e,t){var n=" "+e.className.replace(/[\t\r\n]/g," ")+" ";if(r(e,t)){for(;n.indexOf(" "+t+" ")>=0;)n=n.replace(" "+t+" "," ");e.className=n.replace(/^\s+|\s+$/g,"")}},i=function(e){var n=t.createElement("div");return n.appendChild(t.createTextNode(e)),n.innerHTML},u=function(e){e.style.opacity="",e.style.display="block"},c=function(e){if(e&&!e.length)return u(e);for(var t=0;t<e.length;++t)u(e[t])},d=function(e){e.style.opacity="",e.style.display="none"},f=function(e){if(e&&!e.length)return d(e);for(var t=0;t<e.length;++t)d(e[t])},p=function(e,t){for(var n=t.parentNode;null!==n;){if(n===e)return!0;n=n.parentNode}return!1},m=function(e){e.style.left="-9999px",e.style.display="block";var t,n=e.clientHeight;return t="undefined"!=typeof getComputedStyle?parseInt(getComputedStyle(e).getPropertyValue("padding-top"),10):parseInt(e.currentStyle.padding),e.style.left="",e.style.display="none","-"+parseInt((n+t)/2)+"px"},v=function(e,t){if(+e.style.opacity<1){t=t||16,e.style.opacity=0,e.style.display="block";var n=+new Date,o=function(e){function t(){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}(function(){e.style.opacity=+e.style.opacity+(new Date-n)/100,n=+new Date,+e.style.opacity<1&&setTimeout(o,t)});o()}e.style.display="block"},y=function(e,t){t=t||16,e.style.opacity=1;var n=+new Date,o=function(e){function t(){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}(function(){e.style.opacity=+e.style.opacity-(new Date-n)/100,n=+new Date,+e.style.opacity>0?setTimeout(o,t):e.style.display="none"});o()},h=function(n){if("function"==typeof MouseEvent){var o=new MouseEvent("click",{view:e,bubbles:!1,cancelable:!0});n.dispatchEvent(o)}else if(t.createEvent){var a=t.createEvent("MouseEvents");a.initEvent("click",!1,!1),n.dispatchEvent(a)}else t.createEventObject?n.fireEvent("onclick"):"function"==typeof n.onclick&&n.onclick()},b=function(t){"function"==typeof t.stopPropagation?(t.stopPropagation(),t.preventDefault()):e.event&&e.event.hasOwnProperty("cancelBubble")&&(e.event.cancelBubble=!0)};a.hasClass=r,a.addClass=s,a.removeClass=l,a.escapeHtml=i,a._show=u,a.show=c,a._hide=d,a.hide=f,a.isDescendant=p,a.getTopMargin=m,a.fadeIn=v,a.fadeOut=y,a.fireClick=h,a.stopEventPropagation=b},{}],5:[function(t,o,a){Object.defineProperty(a,"__esModule",{value:!0});var r=t("./handle-dom"),s=t("./handle-swal-dom"),l=function(t,o,a){var l=t||e.event,i=l.keyCode||l.which,u=a.querySelector("button.confirm"),c=a.querySelector("button.cancel"),d=a.querySelectorAll("button[tabindex]");if(-1!==[9,13,32,27].indexOf(i)){for(var f=l.target||l.srcElement,p=-1,m=0;m<d.length;m++)if(f===d[m]){p=m;break}9===i?(f=-1===p?u:p===d.length-1?d[0]:d[p+1],r.stopEventPropagation(l),f.focus(),o.confirmButtonColor&&s.setFocusStyle(f,o.confirmButtonColor)):13===i?("INPUT"===f.tagName&&(f=u,u.focus()),f=-1===p?u:n):27===i&&o.allowEscapeKey===!0?(f=c,r.fireClick(f,l)):f=n}};a["default"]=l,o.exports=a["default"]},{"./handle-dom":4,"./handle-swal-dom":6}],6:[function(n,o,a){var r=function(e){return e&&e.__esModule?e:{"default":e}};Object.defineProperty(a,"__esModule",{value:!0});var s=n("./utils"),l=n("./handle-dom"),i=n("./default-params"),u=r(i),c=n("./injected-html"),d=r(c),f=".sweet-alert",p=".sweet-overlay",m=function(){var e=t.createElement("div");for(e.innerHTML=d["default"];e.firstChild;)t.body.appendChild(e.firstChild)},v=function(e){function t(){return e.apply(this,arguments)}return t.toString=function(){return e.toString()},t}(function(){var e=t.querySelector(f);return e||(m(),e=v()),e}),y=function(){var e=v();return e?e.querySelector("input"):void 0},h=function(){return t.querySelector(p)},b=function(e,t){var n=s.hexToRgb(t);e.style.boxShadow="0 0 2px rgba("+n+", 0.8), inset 0 0 0 1px rgba(0, 0, 0, 0.05)"},g=function(n){var o=v();l.fadeIn(h(),10),l.show(o),l.addClass(o,"showSweetAlert"),l.removeClass(o,"hideSweetAlert"),e.previousActiveElement=t.activeElement;var a=o.querySelector("button.confirm");a.focus(),setTimeout(function(){l.addClass(o,"visible")},500);var r=o.getAttribute("data-timer");if("null"!==r&&""!==r){var s=n;o.timeout=setTimeout(function(){var e=(s||null)&&"true"===o.getAttribute("data-has-done-function");e?s(null):sweetAlert.close()},r)}},w=function(){var e=v(),t=y();l.removeClass(e,"show-input"),t.value=u["default"].inputValue,t.setAttribute("type",u["default"].inputType),t.setAttribute("placeholder",u["default"].inputPlaceholder),C()},C=function(e){if(e&&13===e.keyCode)return!1;var t=v(),n=t.querySelector(".sa-input-error");l.removeClass(n,"show");var o=t.querySelector(".sa-error-container");l.removeClass(o,"show")},S=function(){var e=v();e.style.marginTop=l.getTopMargin(v())};a.sweetAlertInitialize=m,a.getModal=v,a.getOverlay=h,a.getInput=y,a.setFocusStyle=b,a.openModal=g,a.resetInput=w,a.resetInputError=C,a.fixVerticalPosition=S},{"./default-params":2,"./handle-dom":4,"./injected-html":7,"./utils":9}],7:[function(e,t,n){Object.defineProperty(n,"__esModule",{value:!0});var o='<div class="sweet-overlay" tabIndex="-1"></div><div class="sweet-alert"><div class="sa-icon sa-error">\n      <span class="sa-x-mark">\n        <span class="sa-line sa-left"></span>\n        <span class="sa-line sa-right"></span>\n      </span>\n    </div><div class="sa-icon sa-warning">\n      <span class="sa-body"></span>\n      <span class="sa-dot"></span>\n    </div><div class="sa-icon sa-info"></div><div class="sa-icon sa-success">\n      <span class="sa-line sa-tip"></span>\n      <span class="sa-line sa-long"></span>\n\n      <div class="sa-placeholder"></div>\n      <div class="sa-fix"></div>\n    </div><div class="sa-icon sa-custom"></div><h2>Title</h2>\n    <p>Text</p>\n    <fieldset>\n      <input type="text" tabIndex="3" />\n      <div class="sa-input-error"></div>\n    </fieldset><div class="sa-error-container">\n      <div class="icon">!</div>\n      <p>Not valid!</p>\n    </div><div class="sa-button-container">\n      <button class="cancel" tabIndex="2">Cancel</button>\n      <div class="sa-confirm-button-container">\n        <button class="confirm" tabIndex="1">OK</button><div class="la-ball-fall">\n          <div></div>\n          <div></div>\n          <div></div>\n        </div>\n      </div>\n    </div></div>';n["default"]=o,t.exports=n["default"]},{}],8:[function(e,t,o){Object.defineProperty(o,"__esModule",{value:!0});var a=e("./utils"),r=e("./handle-swal-dom"),s=e("./handle-dom"),l=["error","warning","info","success","input","prompt"],i=function(e){var t=r.getModal(),o=t.querySelector("h2"),i=t.querySelector("p"),u=t.querySelector("button.cancel"),c=t.querySelector("button.confirm");if(o.innerHTML=e.html?e.title:s.escapeHtml(e.title).split("\n").join("<br>"),i.innerHTML=e.html?e.text:s.escapeHtml(e.text||"").split("\n").join("<br>"),e.text&&s.show(i),e.customClass)s.addClass(t,e.customClass),t.setAttribute("data-custom-class",e.customClass);else{var d=t.getAttribute("data-custom-class");s.removeClass(t,d),t.setAttribute("data-custom-class","")}if(s.hide(t.querySelectorAll(".sa-icon")),e.type&&!a.isIE8()){var f=function(){for(var o=!1,a=0;a<l.length;a++)if(e.type===l[a]){o=!0;break}if(!o)return logStr("Unknown alert type: "+e.type),{v:!1};var i=["success","error","warning","info"],u=n;-1!==i.indexOf(e.type)&&(u=t.querySelector(".sa-icon.sa-"+e.type),s.show(u));var c=r.getInput();switch(e.type){case"success":s.addClass(u,"animate"),s.addClass(u.querySelector(".sa-tip"),"animateSuccessTip"),s.addClass(u.querySelector(".sa-long"),"animateSuccessLong");break;case"error":s.addClass(u,"animateErrorIcon"),s.addClass(u.querySelector(".sa-x-mark"),"animateXMark");break;case"warning":s.addClass(u,"pulseWarning"),s.addClass(u.querySelector(".sa-body"),"pulseWarningIns"),s.addClass(u.querySelector(".sa-dot"),"pulseWarningIns");break;case"input":case"prompt":c.setAttribute("type",e.inputType),c.value=e.inputValue,c.setAttribute("placeholder",e.inputPlaceholder),s.addClass(t,"show-input"),setTimeout(function(){c.focus(),c.addEventListener("keyup",swal.resetInputError)},400)}}();if("object"==typeof f)return f.v}if(e.imageUrl){var p=t.querySelector(".sa-icon.sa-custom");p.style.backgroundImage="url("+e.imageUrl+")",s.show(p);var m=80,v=80;if(e.imageSize){var y=e.imageSize.toString().split("x"),h=y[0],b=y[1];h&&b?(m=h,v=b):logStr("Parameter imageSize expects value with format WIDTHxHEIGHT, got "+e.imageSize)}p.setAttribute("style",p.getAttribute("style")+"width:"+m+"px; height:"+v+"px")}t.setAttribute("data-has-cancel-button",e.showCancelButton),e.showCancelButton?u.style.display="inline-block":s.hide(u),t.setAttribute("data-has-confirm-button",e.showConfirmButton),e.showConfirmButton?c.style.display="inline-block":s.hide(c),e.cancelButtonText&&(u.innerHTML=s.escapeHtml(e.cancelButtonText)),e.confirmButtonText&&(c.innerHTML=s.escapeHtml(e.confirmButtonText)),e.confirmButtonColor&&(c.style.backgroundColor=e.confirmButtonColor,c.style.borderLeftColor=e.confirmLoadingButtonColor,c.style.borderRightColor=e.confirmLoadingButtonColor,r.setFocusStyle(c,e.confirmButtonColor)),t.setAttribute("data-allow-outside-click",e.allowOutsideClick);var g=e.doneFunction?!0:!1;t.setAttribute("data-has-done-function",g),e.animation?"string"==typeof e.animation?t.setAttribute("data-animation",e.animation):t.setAttribute("data-animation","pop"):t.setAttribute("data-animation","none"),t.setAttribute("data-timer",e.timer)};o["default"]=i,t.exports=o["default"]},{"./handle-dom":4,"./handle-swal-dom":6,"./utils":9}],9:[function(t,n,o){Object.defineProperty(o,"__esModule",{value:!0});var a=function(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n]);return e},r=function(e){var t=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e);return t?parseInt(t[1],16)+", "+parseInt(t[2],16)+", "+parseInt(t[3],16):null},s=function(){return e.attachEvent&&!e.addEventListener},l=function(t){e.console&&e.console.log("SweetAlert: "+t)},i=function(e,t){e=String(e).replace(/[^0-9a-f]/gi,""),e.length<6&&(e=e[0]+e[0]+e[1]+e[1]+e[2]+e[2]),t=t||0;var n,o,a="#";for(o=0;3>o;o++)n=parseInt(e.substr(2*o,2),16),n=Math.round(Math.min(Math.max(0,n+n*t),255)).toString(16),a+=("00"+n).substr(n.length);return a};o.extend=a,o.hexToRgb=r,o.isIE8=s,o.logStr=l,o.colorLuminance=i},{}]},{},[1]),"function"==typeof define&&define.amd?define(function(){return sweetAlert}):"undefined"!=typeof module&&module.exports&&(module.exports=sweetAlert)}(window,document);