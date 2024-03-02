!(function ($) {
    "use strict";
    function checkForNewData() {
        // Use AJAX to check for new data
        $.ajax({
            url: custom_ajax_object.ajaxurl,
            type: 'POST',
            dataType: 'json', // Expect JSON response
            data: {
                action: 'check_for_new_data',
            },
            success: function(response) {
                if (response.status === 'new_data_found') {
                    // Play a notification sound if new data is found
                    playNotificationSound();
                    // Display a message or perform other actions as needed
                    console.log('A new visitor data is found. Please check.');
                }
            },
        });
    }

    // Function to play a notification sound
    function playNotificationSound() {
        // Check if the Web Audio API is supported
        if ('AudioContext' in window || 'webkitAudioContext' in window) {
            var context = new (window.AudioContext || window.webkitAudioContext)();
            var oscillator = context.createOscillator();
            oscillator.connect(context.destination);
            oscillator.start();
            oscillator.stop(context.currentTime + 1); // Stop the sound after 1 second
        } else {
            // Fallback to HTML5 Audio element if Web Audio API is not supported
            var audio = new Audio('path/to/notification-sound.mp3'); // Replace with the actual path to your notification sound
            audio.play();
        }
    }

    // Check for new data immediately on page load
    checkForNewData();

    // Check for new data every 30 seconds
    setInterval(checkForNewData, 30000); // Adjust the interval as needed
})(jQuery);