"use strict";

var KTAdminEditCourse = function () {
    return {
        init: function () {
            const form = document.querySelector('form');
            const hiddenTextarea = document.getElementById('description_hidden');
            const descriptionSelector = "#kt_course_add_description";
            const metaSelector = "#kt_course_add_meta_description";

            // Inisialisasi Quill untuk deskripsi
            const descriptionElement = document.querySelector(descriptionSelector);
            if (descriptionElement) {
                const quill = new Quill(descriptionSelector, {
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ script: 'sub' }, { script: 'super' }],
                            [{ indent: '-1' }, { indent: '+1' }],
                            [{ direction: 'rtl' }],
                            [{ size: ['small', false, 'large', 'huge'] }],
                            [{ color: [] }, { background: [] }],
                            [{ font: [] }],
                            [{ align: [] }],
                            ['link', 'image', 'video'],
                            ['clean']
                        ]
                    },
                    placeholder: "Type your text here...",
                    theme: "snow"
                });

                if (hiddenTextarea) {
                    quill.root.innerHTML = hiddenTextarea.value;
                }

                if (form && hiddenTextarea) {
                    form.addEventListener("submit", function () {
                        hiddenTextarea.value = quill.root.innerHTML;
                    });
                }
            }

            const metaElement = document.querySelector(metaSelector);
            if (metaElement) {
                new Quill(metaSelector, {
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, 4, 5, 6, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ script: 'sub' }, { script: 'super' }],
                            [{ indent: '-1' }, { indent: '+1' }],
                            [{ direction: 'rtl' }],
                            [{ size: ['small', false, 'large', 'huge'] }],
                            [{ color: [] }, { background: [] }],
                            [{ font: [] }],
                            [{ align: [] }],
                            ['link', 'image', 'video'],
                            ['clean']
                        ]
                    },
                    placeholder: "Type your text here...",
                    theme: "snow"
                });
            }

            const indicator = document.getElementById("kt_course_add_status_indicator");
            const statusSelect = document.getElementById("kt_course_add_status_select");
            const colorClasses = ["bg-success", "bg-danger", "bg-primary"];

            if (statusSelect && indicator) {
                const updateIndicatorColor = (value) => {
                    indicator.classList.remove(...colorClasses);
                    switch (value) {
                        case "1":
                            indicator.classList.add("bg-success");
                            break;
                        case "0":
                            indicator.classList.add("bg-primary");
                            break;
                        case "2":
                            indicator.classList.add("bg-danger");
                            break;
                    }
                };

                updateIndicatorColor(statusSelect.value);

                $(statusSelect).on("change", function (e) {
                    updateIndicatorColor(e.target.value);
                });
            }

            (() => {
                let validator;
                const form = document.querySelector('form');
                const submitButton = document.getElementById("kt_ecommerce_add_product_submit");

                if (!form || !submitButton) return;

                validator = FormValidation.formValidation(form, {
                    fields: {
                        title: {
                            validators: {
                                notEmpty: {
                                    message: "Course title is required"
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: "Course status is required"
                                }
                            }
                        },
                        category_id: {
                            validators: {
                                notEmpty: {
                                    message: "Category title is required"
                                }
                            }
                        },
                        video: {
                            validators: {
                                notEmpty: {
                                    message: "Intro video URL is required"
                                }
                            }
                        },
                        level: {
                            validators: {
                                notEmpty: {
                                    message: "Course level is required"
                                }
                            }
                        },
                        language: {
                            validators: {
                                notEmpty: {
                                    message: "Language is required"
                                }
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

                submitButton.addEventListener("click", (event) => {
                    event.preventDefault();

                    validator && validator.validate().then((status) => {
                        if (status === "Valid") {
                            submitButton.setAttribute("data-kt-indicator", "on");
                            submitButton.disabled = true;

                            const formData = new FormData(form);

                            fetch(form.action, {
                                method: form.method,
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                                }
                            })
                                .then(async (response) => {
                                    submitButton.removeAttribute("data-kt-indicator");
                                    submitButton.disabled = false;

                                    if (!response.ok) {
                                        const errorData = await response.json().catch(() => null);
                                        throw new Error(errorData?.message || 'Failed to submit the form.');
                                    }

                                    return response.json();
                                })
                                .then((data) => {
                                    Swal.fire({
                                        text: data.message || "Form has been successfully submitted!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location = data.redirect_url || form.getAttribute("data-kt-redirect");
                                        }
                                    });
                                })
                                .catch((error) => {
                                    Swal.fire({
                                        html: error.message || "Sorry, looks like there are some errors detected, please try again.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                });

                        } else {
                            Swal.fire({
                                html: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                });
            })();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAdminEditCourse.init();
});
