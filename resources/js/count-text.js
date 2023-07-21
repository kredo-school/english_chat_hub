$(document).ready(function () {
    $('.js-count-text').on('input', function () {
        const text = $(this).val();
        const errorElement = $('#error-message');

        if (text.length > 50) {
            // Show error message and disable form submission
            errorElement.text('Please enter a maximum of 50 characters.');
            this.setCustomValidity('Please enter a maximum of 50 characters.');
        } else {
            // Clear error message and enable form submission
            errorElement.text('');
            this.setCustomValidity('');
        }
    });
});
