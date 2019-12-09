/* Global page scipts */
const PageScripts = (function(){

    function init() {

        // Semantic close button
        $('.message .close').on('click', function() {
            $(this).closest('.message').transition('fade');
        });

        // Semantic dropdown
        $('.ui.dropdown').dropdown();

        // Payment Sent Modal
        $('#payment-sent-form').on('submit', function(){
           // $('#payment-sent-modal').modal('show');
           $('#dimmer').dimmer('show');
        });

        // Semantic Tab
        $('.menu .item').tab();
    }

    return {
        init
    }
})();

export default PageScripts;
