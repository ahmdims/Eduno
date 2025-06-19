"use strict";
var KTSignupGeneral = function () {
    var t, e, r, passwordMeter;

    return {
        init: function () {
            t = document.querySelector("#kt_sign_up_form");
            e = document.querySelector("#kt_sign_up_submit");

            passwordMeter = KTPasswordMeter.getInstance(
                t.querySelector('[data-kt-password-meter="true"]')
            );

            r = FormValidation.formValidation(t, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: { message: "Full Name is required" }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: { message: "Email address is required" },
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: "The value is not a valid email address"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: { message: "The password is required" },
                            callback: {
                                message: "Weak password",
                                callback: function (input) {
                                    return input.value.length > 0 ? passwordMeter.getScore() > 50 : false;
                                }
                            }
                        }
                    },
                    "password_confirmation": {
                        validators: {
                            notEmpty: { message: "The password confirmation is required" },
                            identical: {
                                compare: function () {
                                    return t.querySelector('[name="password"]').value;
                                },
                                message: "The password and its confirm are not the same"
                            }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: { message: "Please select a registration type" }
                        }
                    },
                    reason: {
                        validators: {
                            notEmpty: { message: "Please explain why you chose RPL" }
                        }
                    },
                    toc: {
                        validators: {
                            notEmpty: { message: "You must accept the terms and conditions" }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            // Handler klik tombol submit
            !function (action) {
                try {
                    return new URL(action), !0;
                } catch (_) {
                    return !1;
                }
            }(e.closest("form").getAttribute("action")) ? e.addEventListener("click", function (i) {
                i.preventDefault();
                r.validate().then(function (status) {
                    if (status === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                        e.disabled = !0;
                        setTimeout(function () {
                            e.removeAttribute("data-kt-indicator");
                            e.disabled = !1;
                            Swal.fire({
                                text: "You have successfully registered!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    t.reset();
                                    var redirect = t.getAttribute("data-kt-redirect-url");
                                    redirect && (location.href = redirect);
                                }
                            });
                        }, 2000);
                    } else {
                        Swal.fire({
                            text: "Please fix the errors and try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        });
                    }
                });
            }) : e.addEventListener("click", function (i) {
                i.preventDefault();
                r.validate().then(function (status) {
                    if (status === "Valid") {
                        e.setAttribute("data-kt-indicator", "on");
                        e.disabled = !0;
                        axios.post(e.closest("form").getAttribute("action"), new FormData(t))
                            .then(function (response) {
                                const redirect = response.data.redirect ?? t.getAttribute("data-kt-redirect-url");
                                Swal.fire({
                                    text: "You have successfully registered!",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" }
                                }).then(() => {
                                    if (redirect) {
                                        location.href = redirect;
                                    }
                                });
                            })
                            .catch(function (error) {
    console.error('Register Error:', error);

    Swal.fire({
        text: error?.response?.data?.message || "Sorry, something went wrong. Please try again.",
        icon: "error",
        buttonsStyling: !1,
        confirmButtonText: "Ok, got it!",
        customClass: { confirmButton: "btn btn-primary" }
    });
})
                            .then(function () {
                                e.removeAttribute("data-kt-indicator");
                                e.disabled = !1;
                            });
                    } else {
                        Swal.fire({
                            text: "Please fix the errors and try again.",
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: { confirmButton: "btn btn-primary" }
                        });
                    }
                });
            });

            // Jika password diubah, reset validasi
            t.querySelector('[name="password"]').addEventListener("input", function () {
                this.value.length > 0 && r.updateFieldStatus("password", "NotValidated");
            });
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
