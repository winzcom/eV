var requestWizard = (function(){

    var wizard = {};

    var start_request_form = document.getElementById('start_request');
    start_request_form.onsubmit = function(event){
        event.preventDefault();
        event.stopPropagation();
        return false;
    }

    return wizard;

})();