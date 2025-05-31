"use strict";
var LaporGrafKategori = function () {
    var t, e;
    return {
        init: function () {
            (t = document.querySelector("#kategori_table")) && (e = $(t).DataTable({
                info: !1,
                order: [],
                pageLength: 10
            }), (() => {
                const e = "Kategori LaporGraf";
                new $.fn.dataTable.Buttons(t, {
                    buttons: [{
                        extend: "copyHtml5",
                        title: e
                    }, {
                        extend: "excelHtml5",
                        title: e
                    }, {
                        extend: "csvHtml5",
                        title: e
                    }, {
                        extend: "pdfHtml5",
                        title: e
                    }]
                }).container().appendTo($("#laporan_kategori_ekspor")), document.querySelectorAll("#laporan_kategori_ekspor_menu [data-laporan-ekspor]").forEach((t => {
                    t.addEventListener("click", (t => {
                        t.preventDefault();
                        const e = t.target.getAttribute("data-laporan-ekspor");
                        document.querySelector(".dt-buttons .buttons-" + e).click()
                    }))
                }))
            })(), document.querySelector('[data-filter-laporan="search"]').addEventListener("keyup", (function (t) {
                e.search(t.target.value).draw()
            })), (() => {
                const t = document.querySelector('[data-filter-laporan="petugas"]');
                t && $(t).on("change", (function (t) {
                    let r = t.target.value;
                    "semua" === r && (r = ""), e.column(2).search(r).draw()
                }))
            })(), document.querySelectorAll('[data-laporgraf-filter="delete_row"]').forEach((t => {
                t.addEventListener("click", (function (t) {
                    t.preventDefault();
                    const r = t.target.getAttribute("data-url"),
                        a = (t.target.getAttribute("data-id"), t.target.closest("tr").querySelector('[data-laporgraf-filter="nama_kategori"]').innerText);
                    Swal.fire({
                        text: "Apakah Anda yakin ingin menghapus kategori " + a + "?",
                        icon: "warning",
                        showCancelButton: !0,
                        buttonsStyling: !1,
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Tidak, batalkan",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function (n) {
                        n.value ? fetch(r, {
                            method: "DELETE",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            }
                        }).then((t => t.json())).then((r => {
                            r.success ? Swal.fire({
                                text: "Kategori " + a + " berhasil dihapus.",
                                icon: "success",
                                confirmButtonText: "Oke, mengerti!",
                                timer: 2e3,
                                timerProgressBar: !0,
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            }).then((function () {
                                e.row($(t.target.closest("tr"))).remove().draw()
                            })) : Swal.fire({
                                text: "Gagal menghapus kategori.",
                                icon: "error",
                                confirmButtonText: "Oke, mengerti!",
                                timer: 2e3,
                                timerProgressBar: !0,
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            })
                        })) : "cancel" === n.dismiss && Swal.fire({
                            text: "Kategori " + a + " tidak jadi dihapus.",
                            icon: "error",
                            confirmButtonText: "Oke, mengerti!",
                            timer: 2e3,
                            timerProgressBar: !0,
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        })
                    }))
                }))
            })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    LaporGrafKategori.init()
}));
