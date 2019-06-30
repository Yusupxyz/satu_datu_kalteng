(function ( $ ) {

	$.fn.enable = function(actionButtons) {

		var form = $(this);
		var enable = (function() {
			for (var i = 0; i < actionButtons.length; i++) {
				$(form).find(actionButtons[i]).each(function() {
					$(this).prop('disabled', false);
				});
			}
		})();
	};

}( jQuery ));