document.addEventListener("DOMContentLoaded", function () {
    // Cache API Data
    let apiCache = {};

    // Tombol Edit
    $(".btn-edit").on("click", function () {
        const id = $(this).data("id");
        console.log("Editing Material with ID:", id);

        const form = $("#materialModal form");

        // Reset Form
        form[0].reset();
        form.find('input[name="_method"]').remove();
        form.append('<input type="hidden" name="_method" value="PUT">');
        form.attr("action", `/admin/material/${id}`);

        // Perbarui Label Modal
        $("#materialModalLabel").text("Edit Data Material");

        // Set Field
        const setFields = (data) => {
            $("#title").val(data.title);
            $("#video").val(data.video);
            $("#content").val(data.content);
            $('trix-editor').html(data.content);
        };

        // Ambil Data dari API atau Cache
        if (apiCache[id]) {
            setFields(apiCache[id]);
        } else {
            fetch(`/admin/material/${id}/get`)
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