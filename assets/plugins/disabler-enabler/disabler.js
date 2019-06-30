(function ( $ ) {

	$.fn.disable = function(actionButtons) {

		var form = $(this);
		var disable = (function() {
			for (var i = 0; i < actionButtons.length; i++) {
				$(form).find(actionButtons[i]).each(function() {
					$(this).prop('disabled', true);
				});
			}
		})();
	};

}( jQuery ));