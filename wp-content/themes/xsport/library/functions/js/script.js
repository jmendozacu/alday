(function( $ ) {
 
    $( '#pix-event-start-date' ).datepicker({
        dateFormat: 'MM dd, yy',
        onClose: function( selectedDate ){
            $( '#pix-event-end-date' ).datepicker( 'option', 'minDate', selectedDate );
        }
    });
    $( '#pix-event-end-date' ).datepicker({
        dateFormat: 'MM dd, yy',
        onClose: function( selectedDate ){
            $( '#pix-event-start-date' ).datepicker( 'option', 'maxDate', selectedDate );
        }
    });
 
})( jQuery );