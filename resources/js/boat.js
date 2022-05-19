$(function () {
    let editor;

    ClassicEditor.create(document.querySelector(".barca #descriere"), {
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

    $("#boatEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let boat = button.data("boat");

        let modal = $(this);
        var galerie = modal.find("#galerie");
        galerie.empty();
        modal.find("#boatEditId").val(boat.id);
        modal.find("#pozitie").val(boat.pozitie);
        modal.find("#nume").val(boat.nume);
        modal.find("#model").val(boat.model);
        modal.find("#an_fabricatie").val(boat.an_fabricatie);
        modal.find("#capacitate").val(boat.capacitate);
        modal.find("#layout").val(boat.layout);
        var previzualizare_imagine = $("#previzualizare_imagine");
        previzualizare_imagine.html(
            `<img id="img" src="/files/${boat.imagine}" width="70" height="70"/>`
        );
        // modal.find("#descriere").text(boat.details.descriere);
        editor.setData(boat.details.descriere);
        modal.find("#wc_dus").val(boat.details.wc_dus);
        modal.find("#lungime").val(boat.details.lungime);
        modal.find("#punte_cockpit").val(boat.details.dotari_punte_cockpit);
        modal.find("#bucatarie_salon").val(boat.details.dotari_bucatarie_salon);
        modal.find("#cabine").val(boat.details.dotari_cabine);
        modal
            .find("#echipament_navigatie")
            .val(boat.details.echipament_navigatie);
        modal
            .find("#echipament_siguranta")
            .val(boat.details.echipament_siguranta);

        boat.details.imagini.forEach(function (imagine, index) {
            galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
    height="70"/>`);
        });

        $("#boatEditModal #imagini").on("change", function () {
            var galerie = $(this).next().next();
            // galerie.empty();
            galerie.find("img").remove();
            var countFiles = $(this)[0].files.length;
            console.log(countFiles);
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
                    // reader.readAsDataURL($(this)[0].files[i]);
                }
            }
        });

        $("#boatEditModal #imagine").on("change", function (event) {
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

    $("#addBoat").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let pozitie = $("#pozitie").val();
        let nume = $("#nume").val();
        let model = $("#model").val();
        let an_fabricatie = $("#an_fabricatie").val();
        let capacitate = $("#capacitate").val();
        let layout = $("#layout").val();
        let imagine = document.getElementById("imagine").files[0];
        // let descriere = $("#descriere").val();
        const descriere = editor.getData();
        let wc_dus = $("#wc_dus").val();
        let lungime = $("#lungime").val();

        let numar_imagini = $("#imagini")[0].files.length;
        let imagini = document.getElementById("imagini");
        let punte_cockpit = $("#punte_cockpit").val();
        let bucatarie_salon = $("#bucatarie_salon").val();
        let cabine = $("#cabine").val();
        let echipament_navigatie = $("#echipament_navigatie").val();
        let echipament_siguranta = $("#echipament_siguranta").val();

        let formData = new FormData();

        for (let i = 0; i <= numar_imagini; i++) {
            file = imagini.files[i];
            formData.append("imagini[]", file);
        }

        formData.append("pozitie", pozitie);
        formData.append("nume", nume);
        formData.append("model", model);
        formData.append("an_fabricatie", an_fabricatie);
        formData.append("capacitate", capacitate);
        formData.append("layout", layout);
        formData.append("imagine", imagine);
        formData.append("descriere", descriere);
        formData.append("wc_dus", wc_dus);
        formData.append("lungime", lungime);
        formData.append("punte_cockpit", punte_cockpit);
        formData.append("bucatarie_salon", bucatarie_salon);
        formData.append("cabine", cabine);
        formData.append("echipament_navigatie", echipament_navigatie);
        formData.append("echipament_siguranta", echipament_siguranta);

        $.ajax({
            url: "/admin/barca/creare",
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
                    .find("input:text,textarea, select")
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

    $("#form_boat_edit").on("submit", function (event) {
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
                $("#boatEditModal").removeClass("show");
                $("#boatEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#boatDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let boat = button.data("boat");

        let modal = $(this);

        modal.find("#boatDeleteId").val(boat.id);
        modal.find("#boatDeleteName").text(boat.nume);
    });
    $("#form_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();
        var form = this;
        let id = $("#boatDeleteId").val();
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
                $("#boatDeleteModal").removeClass("show");
                $(".modal-backdrop").remove();
                toastr.success(response.success);
            }
        });
    });
});
