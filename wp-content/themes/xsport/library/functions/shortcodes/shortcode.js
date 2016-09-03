(function() {
	if (typeof(window.InlineShortcodeView_vc_row) != 'undefined'){
		 window.InlineShortcodeView_icontexttabs = window.InlineShortcodeView_vc_row.extend({
				render: function() {
					debugger;
					window.InlineShortcodeView_icontexttabs.__super__.render.call(this);
					[].slice.call(document.querySelectorAll('.tabs')).forEach(function(el) {
						new CBPFWTabs(el);
					});
					return this;
				}

		  });
	  }
	 if (typeof(vc) != 'undefined'){ 
     window.InlineShortcodeView_icontexttab = vc.shortcode_view.extend({
            render: function() {
                debugger;
                window.InlineShortcodeView_icontexttab.__super__.render.call(this);
                [].slice.call(document.querySelectorAll('.tabs')).forEach(function(el) {
                    new CBPFWTabs(el);
                });
                return this;
            }

      });
	  }
	
})();

