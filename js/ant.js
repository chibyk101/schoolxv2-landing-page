
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var name = $('.validate-input input[name="name"]');
    var school = $('.validate-input input[name="school"]');
    var email = $('.validate-input input[name="email"]');
    var state = $('.validate-input input[name="state"]');
    var city = $('.validate-input input[name="city"]');
    var phone = $('.validate-input input[name="phone"]');
    var message = $('.validate-input textarea[name="message"]');
    


    $('.validate-form').on('submit',function(){
        var check = true;

        if($(name).val().trim() == ''){
            showValidate(name);
            check=false;
        }

        if($(school).val().trim() == ''){
            showValidate(school);
            check=false;
        }

        if($(email).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            showValidate(email);
            check=false;
        }

        if($(state).val().trim() == ''){
            showValidate(state);
            check=false;
        }

        if($(city).val().trim() == ''){
            showValidate(city);
            check=false;
        }

        if($(phone).val().trim().match(/^\(?([0-9]{4})\)?[-.]?([0-9]{3})[-.]?([0-9]{4})$/) == null) {
            showValidate(phone);
            check=false;
        }

        if($(message).val().trim() == ''){
            showValidate(message);
            check=false;
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
       });
    });

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);