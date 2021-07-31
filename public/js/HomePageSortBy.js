
(function(fn) {
	'use strict';
	fn(window.jQuery, window, document);
}(function($, window, document) {
	'use strict';
   var $ = jQuery.noConflict();
	$(function() {
		$('.sort-btn').on('click', '[data-sort]', function(event) {
      window.alert("change sort");
			event.preventDefault();

			var $this = $(this),
				sortDir = 'desc';

			if ($this.data('sort') !== 'asc') {
				sortDir = 'asc';
			}

			$this.data('sort', sortDir).find('.fa').attr('class', 'fa fa-sort-' + sortDir);

      addURLParameter(sortDir);
			// call sortDesc() or sortAsc() or whathaveyou...
		});
	});
}));

  function addURLParameter (sortOrder){
    const urlParams = new URLSearchParams(window.location.search);

    urlParams.set('Order', sortOrder);

    window.location.search = urlParams;
  }
