"use strict";

// Class definition
var KTSigninGeneral = function() {
    // Elements
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleForm = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {                   
                    // 'email': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Email tidak boleh kosong'
                    //         },
                    //         emailAddress: {
                    //             message: 'Email tidak valid'
                    //         }
                    //     }
                    // },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Password tidak boleh kosong'
                            }
                        }
                    } 
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row'
                    })
                }
            }
        );      

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    // Disable button to avoid multiple click 
                    submitButton.disabled = true;
                    // Simulate ajax request
                    setTimeout(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        }
                    });
                    var formLogin = $('#kt_sign_in_form').serialize();
                     //var emailSubmit = $('#password').val();
                        $.ajax({
                              type: "POST",
                              url: urlLogin, 
                              data: formLogin,
                              success: function (data) {
                                  var temp = [];
                                  
                                  $.each(data, function (key, value) {
                                      temp.push({
                                          v: value,
                                          k: key
                                      });
                                  });     
                                  //console.log(data);
                                  if(temp[0].v == 'success'){
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
                                    Swal.fire({
                                        text: "Kamu telah berhasil mereset password silahkan login dengan password yg baru!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Oke siap!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed) { 
                                            form.querySelector('[name="password"]').value= "";
                                            //form.querySelector('[name="password"]').value= "";                                
                                            window.setTimeout(function(){location.href=urlHome},500);
                                        }
                                    });
                                  }
                              },
                              error: function (data) {
                              }
                          });
                        
                    }, 1000);   						
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, siap!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
		});
    }

    // Public functions
    return {
        // Initialization
        init: function() {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');
            
            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTSigninGeneral.init();
});
