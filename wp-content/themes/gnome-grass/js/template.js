$(document).ready(function() {
    
    /* Global search placeholder
     * ====================================================================== */
    
    var search_input = $('#s');
    var search_placeholder = search_input.attr('placeholder');
    
    if (!("placeholder" in document.createElement("input"))) {
        if(search_input.val() == '' || search_input.val() == search_placeholder) {
            search_input.addClass('placeholder').val(search_placeholder);
        }
        
        search_input.click(function() {
            if(search_input.hasClass('placeholder')) {
                search_input.val('').removeClass('placeholder');
            }
        });
        
        search_input.blur(function() {
            if(search_input.val() == '' || search_input.val() == search_placeholder) {
                search_input.addClass('placeholder').val(search_placeholder);
            }
        });        
    }    
});
