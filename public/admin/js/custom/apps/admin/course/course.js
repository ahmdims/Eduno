"use strict";
var KTAdminCourse = function () {
    var t, e, n;

    var r = () => {
        e.querySelectorAll('[data-kt-admin-course-filter="delete_row"]').forEach((t => {
            t.addEventListener("click", (function (a) {
                a.preventDefault();
                const row = t.closest("tr");
                const courseName = row.querySelector('[data-kt-admin-course-filter="product_name"]')?.innerText || "this item";
                const deleteUrl = t.getAttribute("data-url");

                Swal.fire({
                    text: "Are you sure you want to delete " + courseName + "?",
                    icon: "warning",
                    showCancelButton: !0,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((function (result) {
                    if (result.value) {
                        fetch(deleteUrl, {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    text: "You have deleted " + courseName + "!",
                                    icon: "success",
                                    confirmButtonText: "Ok, got it!",
                                    timer: 2000,
                                    timerProgressBar: !0,
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then(() => {
                                    n.row($(row)).remove().draw();
                                });
                            } else {
                                Swal.fire({
                                    text: "Failed to delete the course.",
                                    icon: "error",
                                    confirmButtonText: "Ok, got it!",
                                    timer: 2000,
                                    timerProgressBar: !0,
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                        });
                    } else if (result.dismiss === "cancel") {
                        Swal.fire({
                            text: courseName + " was not deleted.",
                            icon: "error",
                            confirmButtonText: "Ok, got it!",
                            timer: 2000,
                            timerProgressBar: !0,
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        });
                    }
                }));
            }));
        }));
    };

    return {
        init: function () {
            t = "#kt_admin_course_table",
            e = document.querySelector(t),
            n = new DataTable(t, {
                info: !1,
                order: [],
                pageLength: 10,
                columnDefs: [
                    { render: DataTable.render.number(",", ".", 2), targets: 4 },
                    { orderable: !1, targets: 6 }
                ]
            }).on("draw", () => { r(); }),

            document.querySelector('[data-kt-admin-course-filter="search"]').addEventListener("keyup", function (t) {
                n.search(t.target.value).draw();
            }),

            (() => {
                const statusFilter = document.querySelector('[data-kt-admin-course-filter="status"]');
                $(statusFilter).on("change", (t => {
                    let value = t.target.value;
                    if (value === "all") value = "";
                    n.column(2).search(value).draw();
                }));
            })(),

            r();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTAdminCourse.init();
});
