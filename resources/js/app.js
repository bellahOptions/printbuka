import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
 

$(document).ready(function() {
    //alert('Hello, welcome to Printbuka! Please complete the onboarding process to get started. If you have any questions, feel free to reach out to your manager or HR representative. We are excited to have you on board and look forward to working with you!');
    console.log("jQuery is working!");
    // Show/hide the "Other" role input based on selection
    $('select[name="staff_role"]').change(function() {
        if ($(this).val() === 'other') {
            $('input[name="other_role"]').removeClass('hidden');
        } else {
            $('input[name="other_role"]').addClass('hidden');
        }
    });
});
