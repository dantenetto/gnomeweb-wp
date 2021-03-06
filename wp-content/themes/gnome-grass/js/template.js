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
    
    
    /* Language selector
     * ====================================================================== */
    
    $('#footer .language a.map').click(function(e) {
        e.preventDefault();
        
        if($('#language_selector').length == 0) {
        
            $.ajax({
                'type': 'GET',
                'url': $(this).attr('href'),
                'dataType': 'text',
                'success': function(data) {
                    $('#footer').after('<div id="language_selector">' + data + '</div>');
                    window.scrollTo(0, $('body').height());
                    $('#language_selector').show().addClass('active');
                    $('html, body').animate({scrollTop: $(window).scrollTop() + $('#language_selector').height()}, 500);
                }
            });
            
        } else {
        
            if($('#language_selector').hasClass('active')) {
                $('#language_selector').slideUp().removeClass('active');
            } else {
                window.scrollTo(0, $('body').height());
                $('#language_selector').show().addClass('active');
                $('html, body').animate({scrollTop: $(window).scrollTop() + $('#language_selector').height()}, 500);
            }
        
        }
    });
});
