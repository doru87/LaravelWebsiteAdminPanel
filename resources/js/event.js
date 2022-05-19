$(function () {
    let editor;

    ClassicEditor.create(document.querySelector(".eveniment #descriere"), {
        extraPlugins: [MyCustomUploadAdapterPlugin],
    })
        .then((newEditor) => {
            editor = newEditor;
        })
        .catch((error) => {
            console.log(error);
        });

    function MyCustomUploadAdapterPlugin(editor) {
        editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
            // Configure the URL to the upload script in your back-end here!
            return new MyUploadAdapter(loader);
        };
    }

    $("#addEvent").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let pozitie = $("#pozitie").val();
        let nume = $("#nume").val();
        let destinatie = $("#destinatie").val();
        // let descriere = $("#descriere").val();
        const descriere = editor.getData();

        let imagine = document.getElementById("imagine").files[0];
        let numar_imagini = $("#imagini")[0].files.length;
        let imagini = document.getElementById("imagini");
        let formData = new FormData();

        for (let i = 0; i <= numar_imagini; i++) {
            file = imagini.files[i];
            formData.append("imagini[]", file);
        }

        formData.append("pozitie", pozitie);
        formData.append("nume", nume);
        formData.append("descriere", descriere);
        formData.append("destinatie", destinatie);
        formData.append("imagine", imagine);

        $.ajax({
            url: "/admin/eveniment-personalizat/creare",
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
                $(".content")
                    .find("input:text,textarea")
                    .each(function () {
                        $(this).val("");
                    });
                editor.setData("");
                $("#previzualizare_imagine img").remove();
                $("#galerie img").remove();
                toastr.success(response.success);
            }
        });
    });
    $("#eventEditModal").on("shown.bs.modal", function (e) {
        let button = $(e.relatedTarget);
        let event = button.data("event");

        let modal = $(this);
        var galerie = modal.find("#galerie");
        galerie.empty();
        modal.find("#eventEditId").val(event.id);
        modal.find("#pozitie").val(event.pozitie);
        modal.find("#nume").val(event.nume);
        modal.find("#destinatie").val(event.destinatie);
        // modal.find("#descriere").val(event.descriere);
        editor.setData(event.descriere);

        var previzualizare_imagine = $("#previzualizare_imagine");
        previzualizare_imagine.html(`<img id="img" src="/files/${event.imagine}" width="70"
    height="70"/>`);

        event.details.imagini.forEach(function (imagine, index) {
            galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
      height="70"/>`);
        });

        $("#eventEditModal #imagini").on("change", function () {
            var galerie = $(this).next().next();
            galerie.find("img").remove();
            var countFiles = $(this)[0].files.length;

            var imgPath = $(this)[0].value;
            var extn = imgPath
                .substring(imgPath.lastIndexOf(".") + 1)
                .toLowerCase();

            if (
                extn == "gif" ||
                extn == "png" ||
                extn == "jpg" ||
                extn == "jpeg"
            ) {
                for (var i = 0; i < countFiles; i++) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $("<img />", {
                            src: e.target.result,
                            id: "thumb-image",
                            width: "70",
                            height: "70",
                        }).appendTo(galerie);
                    };
                }
            }
        });

        $("#eventEditModal #imagine").on("change", function (event) {
            var imgPath = $(this)[0].value;
            var extn = imgPath
                .substring(imgPath.lastIndexOf(".") + 1)
                .toLowerCase();
            var img = $("#img");
            if (
                extn == "gif" ||
                extn == "png" ||
                extn == "jpg" ||
                extn == "jpeg"
            ) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    img.attr("src", e.target.result);
                };
                reader.readAsDataURL($("#imagine")[0].files[0]);
            }
        });
    });
    $("#form_event_edit").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: new FormData(form),
            processData: false,
            dataType: "json",
            contentType: false,
        }).done(function (response) {
            console.log(response);
            if (response.hasOwnProperty("errors")) {
                for (const key in response) {
                    const element = response[key];
                    for (const key in element) {
                        console.log(element[key]);
                        toastr.error(element[key]);
                    }
                }
            } else if (response.hasOwnProperty("success")) {
                $("#eventEditModal").removeClass("show");
                $("#eventEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#eventDeleteModal").on("shown.bs.modal", function (e) {
        let button = $(e.relatedTarget);
        let event = button.data("event");

        let modal = $(this);

        modal.find("#eventDeleteId").val(event.id);
        modal.find("#eventDeleteName").text(event.nume);
    });
    $("#form_event_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();
        var form = this;
        let id = $("#eventDeleteId").val();
        var form = this;
        $.ajax({
            url: $(form).attr("action"),
            type: $(form).attr("method"),
            data: new FormData(form),
            processData: false,
            dataType: "json",
            contentType: false,
        }).done(function (response) {
            console.log(response);
            if (response.hasOwnProperty("success")) {
                $(`.item${id}`).remove();
                $("#eventDeleteModal").removeClass("show");
                $(".modal-backdrop").remove();
                toastr.success(response.success);
            }
        });
    });
});
