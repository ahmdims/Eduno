document.addEventListener("DOMContentLoaded", function () {
    // Cache API Data
    let apiCache = {};

    // Tombol Edit
    $(".btn-edit").on("click", function () {
        const id = $(this).data("id");
        console.log("Editing Article with ID:", id);

        const form = $("#formModal form");

        // Reset Form
        form[0].reset();
        form.find('input[name="_method"]').remove();
        form.append('<input type="hidden" name="_method" value="PUT">');
        form.attr("action", `/admin/article/${id}`);

        // Perbarui Label Modal
        $("#formModalLabel").text("Edit Data Article");

        // Set Field
        const setFields = (data) => {
            $("#title").val(data.title);
            $("#content").val(data.content);
            $("trix-editor").html(data.content);
            $("#category_id").val(data.category_id);
            $("#status").val(data.status);
        };

        // Ambil Data dari API atau Cache
        if (apiCache[id]) {
            setFields(apiCache[id]);
        } else {
            fetch(`/admin/article/${id}/get`)
                .then((res) => {
                    if (!res.ok) throw new Error(res.statusText);
                    return res.json();
                })
                .then((data) => {
                    apiCache[id] = data;
                    setFields(data);
                })
                .catch((err) =>
                    console.error("Error fetching user data:", err)
                );
        }
    });

    // Tombol Delete
    $(".delete-btn").on("click", function (e) {
        e.preventDefault();
        const form = $(this).closest("form");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

});