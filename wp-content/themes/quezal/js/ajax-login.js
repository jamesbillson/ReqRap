jQuery(document).ready(function() {
	(function() {
		jQuery('a[href*="/req/site/login"]').on('click', function(e) {
			e.preventDefault();
			jQuery('#ajax-login').modal('show');
			return false;
		});
		jQuery('#ajax-login--btn').on('click', function(e) {
			e.preventDefault();
			jQuery('#ajax-login--form').submit();
			return false;
		});
	})();
});