/*==============================================================*/
// Contact Form  JS
/*==============================================================*/
(function ($) {
    "use strict"; // Start of use strict
    $("#contactForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
        } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
        }
    });


    function submitForm(){

        var data = $( "#contactForm" ).serialize();
        $.ajax({
            type: "POST",
            url: "/contact-us",
            data: data,
            success : function(statustxt){
                if (statustxt == "success"){
                    formSuccess();
                } else {
                    formError();
                }
            }
        });
    }

    function formSuccess(){
        $("#contactForm")[0].reset();
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'تم الإرسال بنجاح',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 4000
        })
    }

    function formError(){
        Swal.fire({
            position: 'center',
            icon: 'error',
            text : 'تأكد من المدخلات',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 4000
        })
    }
}(jQuery)); // End of use strict
