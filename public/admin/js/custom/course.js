"use strict";
var EdunoCourse = function () {
    var t, e;
    return {
        init: function () {
            t = document.querySelector("#course_table");
            if (!t) return;

            e = $(t).DataTable();

            // Pencarian Live
            document.querySelector('[data-filter="search"]').addEventListener("keyup", function (t) {
                e.search(t.target.value).draw();
            });

            // Hapus Baris dengan Konfirmasi + CSRF Token
            document.querySelectorAll('[data-filter="delete_row"]').forEach((btn) => {
                btn.addEventListener("click", function (event) {
                    event.preventDefault();

                    const url = btn.getAttribute("data-url"),
                        namaKategori = btn.closest("tr").querySelector('[data-filter="name"]').innerText;

                    Swal.fire({
                        text: "Apakah Anda yakin ingin menghapus kategori " + namaKategori + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Tidak, batalkan",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then(function (result) {
                        if (result.value) {
                            fetch(url, {
                                method: "DELETE",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                                }
                            })
                            .then((res) => res.json())
                            .then((response) => {
                                if (response.success) {
                                    Swal.fire({
                                        text: "Kategori " + namaKategori + " berhasil dihapus.",
                                        icon: "success",
                                        confirmButtonText: "Oke, mengerti!",
                                        timer: 2000,
                                        timerProgressBar: true,
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    }).then(function () {
                                        e.row($(btn.closest("tr"))).remove().draw();
                                    });
                                } else {
                                    Swal.fire({
                                        text: "Gagal menghapus kategori.",
                                        icon: "error",
                                        confirmButtonText: "Oke, mengerti!",
                                        timer: 2000,
                                        timerProgressBar: true,
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    });
                                }
                            });
                        } else if (result.dismiss === "cancel") {
                            Swal.fire({
                                text: "Kategori " + namaKategori + " tidak jadi dihapus.",
                                icon: "error",
                                confirmButtonText: "Oke, mengerti!",
                                timer: 2000,
                                timerProgressBar: true,
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            });
                        }
                    });
                });
            });
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    EdunoCourse.init();
});
