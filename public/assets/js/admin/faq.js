document.addEventListener("DOMContentLoaded", function () {
    // Cache API Data
    let apiCache = {};

    // Tombol Edit
    $(".btn-edit").on("click", function () {
        const id = $(this).data("id");
        console.log("Editing FAQ with ID:", id);

        const form = $("#formModal form");

        // Reset Form
        form[0].reset();
        form.find('input[name="_method"]').remove();
        form.append('<input type="hidden" name="_method" value="PUT">');
        form.attr("action", `/admin/faq/${id}`);

        // Perbarui Label Modal
        $("#formModalLabel").text("Edit Data FAQ");

        // Set Field
        const setFields = (data) => {
            $("#question").val(data.question);
            $("#answer").val(data.answer);
            $('trix-editor').html(data.answer);
        };

        // Ambil Data dari API atau Cache
        if (apiCache[id]) {
            setFields(apiCache[id]);
        } else {
            fetch(`/admin/faq/${id}/get`)
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
});
