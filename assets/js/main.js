(function($) {
	"use strict";

    // wow init
    new WOW().init();

    // Chat List Off Canvas
    $(document).on('click', '.user-offcan-trigger', function() {
        $('body').toggleClass('conversation-list-open');
    });
    
    // Site Notifications
    var notification = document.querySelector('.notification');
    if (notification) {
        setTimeout(function() {
            notification.remove();
        }, 2000);
    }

    $(document).ready(function(){
        fetchData();
        function fetchData() {
            $.ajax({
                url: 'test.php',
                type: 'GET',
                success: function(response) {
                    $('#data-container').html(response);
                }
            });
        }
        setInterval(fetchData, 5000);
    });

})(jQuery);