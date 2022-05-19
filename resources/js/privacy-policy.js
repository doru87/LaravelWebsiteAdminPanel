$(function () {
    let editor;
    ClassicEditor.create(document.querySelector("#editor-privacy-policy"))
        .then((newEditor) => {
            editor = newEditor;
        })
        .catch((error) => {
            console.log(error);
        });

    $(".politica-de-confidentialitate").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        const continut = editor.getData();
        let formData = new FormData();
        formData.append("continut", continut);

        $.ajax({
            url: "/admin/politica-de-confidentialitate/creare",
            type: "POST",
            data: formData,
            processData: false,
            dataType: "json",
            contentType: false,
        }).done(function (response) {
            if (response.hasOwnProperty("errors")) {
                for (const key in response) {
                    const element = response[key];
                    for (const key in element) {
                        toastr.error(element[key]);
                    }
                }
            } else if (response.hasOwnProperty("success")) {
                editor.setData("");
                toastr.success(response.success);
            }
        });
    });
});
