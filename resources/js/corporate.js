$(function () {
    let editor;

    ClassicEditor.create(document.querySelector(".corporate #descriere"), {
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

    $("#addCorporate").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let pozitie = $("#pozitie").val();
        let nume = $("#nume").val();
        // let descriere = $("#descriere").val();
        const descriere = editor.getData();
        let tip_activitate = $("#tip_activitate").val();
        let durata = $("#durata").val();
        let destinatie = $("#destinatie").val();
        let capacitate = $("#capacitate").val();
        let imagine = document.getElementById("imagine").files[0];
        let numar_imagini = $("#imagini")[0].files.length;
        let imagini = document.getElementById("imagini");
        let formData = new FormData();

        for (let i = 0; i <= numar_imagini; i++) {
            file = imagini.files[i];
            formData.append("imagini[]", file);
        }

        let servicii_incluse = $("#servicii_incluse").val();
        let servicii_optionale = $("#servicii_optionale").val();

        formData.append("pozitie", pozitie);
        formData.append("nume", nume);
        formData.append("descriere", descriere);
        formData.append("tip_activitate", tip_activitate);
        formData.append("durata", durata);
        formData.append("destinatie", destinatie);
        formData.append("capacitate", capacitate);
        formData.append("imagine", imagine);
        formData.append("servicii_incluse", servicii_incluse);
        formData.append("servicii_optionale", servicii_optionale);

        console.log(formData);
        $.ajax({
            url: "/admin/corporate/stocare",
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
                    .find("input:text, textarea, select")
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
    $("#corporateEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let corporate = button.data("corporate");

        let modal = $(this);
        var galerie = modal.find("#galerie");
        galerie.empty();
        modal.find("#corporateEditId").val(corporate.id);
        modal.find("#pozitie").val(corporate.pozitie);
        modal.find("#nume").val(corporate.nume);
        // modal.find("#descriere").val(corporate.descriere);
        editor.setData(corporate.descriere);
        modal.find("#tip_activitate").val(corporate.tip_activitate);
        modal.find("#durata").val(corporate.durata);
        modal.find("#destinatie").val(corporate.destinatie);
        modal.find("#capacitate").val(corporate.capacitate);

        var previzualizare_imagine = $("#previzualizare_imagine");
        previzualizare_imagine.html(`<img id="img" src="/files/${corporate.imagine}" width="70"
        height="70"/>`);

        corporate.details.imagini.forEach(function (imagine, index) {
            galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
    height="70"/>`);
        });
        modal.find("#servicii_incluse").val(corporate.details.servicii_incluse);
        modal
            .find("#servicii_optionale")
            .val(corporate.details.servicii_optionale);

        $("#corporateEditModal #imagini").on("change", function () {
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

        $("#corporateEditModal #imagine").on("change", function (event) {
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
    $("#form_corporate_edit").on("submit", function (event) {
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
                $("#corporateEditModal").removeClass("show");
                $("#corporateEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#corporateDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let corporate = button.data("corporate");

        let modal = $(this);

        modal.find("#corporateDeleteId").val(corporate.id);
        modal.find("#corporateDeleteName").text(corporate.nume);
    });
    $("#form_corporate_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();
        var form = this;
        let id = $("#corporateDeleteId").val();
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
                $("#corporateDeleteModal").removeClass("show");
                $(".modal-backdrop").remove();
                toastr.success(response.success);
            }
        });
    });

    $("#inceput_sezon").datetimepicker({
        format: "Y-m-d",
        lang: "ro",
    });
    $("#final_sezon").datetimepicker({
        format: "Y-m-d",
        lang: "ro",
    });
});
