
(function ($) {
    "use strict";


    /*==================================================================
    [ Validate ]*/
    var input = $('.form__group .form__input');

    $('.form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.form .form__input').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
      var rex= /[^<>'"~`\/\\() ;*%$&#=-]/gm;
      // $(input).attr('type') == 'text' || $(input).attr('type') == 'password'
      if(true) {
        var string = $(input).val().trim().match(rex);
        // console.log(string.length);
        // console.log($(input).val().trim().length);
          if(string.length != $(input).val().trim().length) {
             // console.log($(input).val().trim().match(rex));
             alert("不能輸入特殊符號 ex:&<>...");
            return false;
          }
          else if($(input).val().trim() == "") {
            alert("不能輸入空值");
           return false;
          }
      }
      else {
          if($(input).val().trim() == ''){
              return false;
          }
      }
        // if($(input).attr('type') == 'text' || $(input).attr('type') == 'password') {
        //     if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
        //         return false;
        //     }
        // }
        // else {
        //     if($(input).val().trim() == ''){
        //         return false;
        //     }
        // }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }



})(jQuery);
