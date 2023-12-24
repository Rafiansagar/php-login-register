(function($) {
	"use strict";

    // wow init
    new WOW().init();

    // Chat List Off Canvas
    $(document).on('click', '.user-offcan-trigger', function() {
        $('body').toggleClass('conversation-list-open');
    });
    

})(jQuery);