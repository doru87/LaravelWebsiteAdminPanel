$(function () {
    let editor;
    ClassicEditor.create(document.querySelector("#editor-terms-and-conditions"))
        .then((newEditor) => {
            editor = newEditor;
        })
        .catch((error) => {
            console.log(error);
        });

    $(".termene-si-conditii").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        const continut = editor.getData();
        let formData = new FormData();
        formData.append("continut", continut);

        $.ajax({
            url: "/admin/termeni-si-conditii/creare",
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
