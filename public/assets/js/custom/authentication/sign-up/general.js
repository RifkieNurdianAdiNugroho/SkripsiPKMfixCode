"use strict";

// Class definition
var KTSignupGeneral = function() {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    // Handle form
    var handleForm  = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
			form,
			{
				fields: {
					'first_name': {
						validators: {
							notEmpty: {
								message: 'Nama lengkap tidak boleh kosong!'
							}
						}
                    },
                    // 'last_name': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Nama belakang tidak boleh kosong!'
                    //         }
                    //     }
                    // },
                    'nomor_wa': {
                        validators: {
                            notEmpty: {
                                message: 'Nomor whatsapp is tidak boleh kosong!'
                            }
                        }
                    },
					'email': {
                        validators: {
							notEmpty: {
								message: 'Email tidak boleh kosong!'
							},
                            emailAddress: {
								message: 'Email tidak valid'

							}
						}
					},
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'Password is tidak boleh kosong!'
                            },
                        }
                    },
                    'confirm-password': {
                        validators: {
                            notEmpty: {
                                message: 'Konfirmasi password tidak boleh kosong!'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Password konfirmasi tidak sama dengan password'
                            }
                        }
                    },
                    'toc': {
                        validators: {
                            notEmpty: {
                                message: 'Kamu harus menchecklist persyaratan!'
                            }
                        }
                    }
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }  
                    }),
					bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
				}
			}
		);

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function(status) {
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
                    var formLogin = $('#kt_sign_up_form').serialize();
                    var emailSubmit = $('#email').val();
                        $.ajax({
                              type: "POST",
                              url: urlRegister, 
                              data: formLogin,
                              success: function (data) {
                                  var temp = [];
                                  $.each(data, function (key, value) {
                                      temp.push({
                                          v: value,
                                          k: key
                                      });
                                  });
                                  //console.log(temp[0].v);
                                  console.log(emailSubmit);
                                  if(temp[0].v == 'email_exist'){
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
                                    Swal.fire({
                                        text: "Mohon maaf email kamu sudah terdaftar silahkan pergi ke halamn login atau gunakan email lain untuk mendaftar!",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, siap!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed) {                             
                                            window.setTimeout(function(){location.href=urlLogin},100);
                                        }
                                    });
                                  }

                                  if(temp[0].v == 'error'){
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
                                    Swal.fire({
                                        text: "Mohon maaf sedang terjadi kesalah ulangi beberapa saat lagi atau hubungi admin jika masih mengalami kendala!",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, siap!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                  }

                                  if(temp[0].v == 'success'){
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
                                    Swal.fire({
                                        text: "Kamu telah berhasil mendaftar lanjutkan ke langkah verifikasi ya.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Pergi ke halaman verifikasi",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed) {                             
                                            window.setTimeout(function(){location.href=urlVerify},300);
                                        }
                                    });
                                  }
                              },
                              error: function (data) {
                              }
                          });
                    }, 1500);   						
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Mohon maaf , ada kelengkapan yang belum anda isi , silahkan di cek kembali",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Siap!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
		    });
        });

        // Handle password input
        form.querySelector('input[name="password"]').addEventListener('input', function() {
            if (this.value.length > 0) {
                validator.updateFieldStatus('password', 'NotValidated');
            }
        });
    }

    // Password input validation
    var validatePassword = function() {
        return  (passwordMeter.getScore() === 100);
    }

    // Public functions
    return {
        // Initialization
        init: function() {
            // Elements
            form = document.querySelector('#kt_sign_up_form');
            submitButton = document.querySelector('#kt_sign_up_submit');
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

            handleForm ();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTSignupGeneral.init();
});
