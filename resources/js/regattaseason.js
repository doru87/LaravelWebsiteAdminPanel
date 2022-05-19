$(function () {
    $("#regattaSeasonEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let sezonregate = button.data("sezonregate");

        let modal = $(this);
        var galerie = modal.find("#galerie");
        galerie.empty();
        modal.find("#regattaSeasonEditId").val(sezonregate.id);
        modal.find("#nume").val(sezonregate.nume);
        modal.find("#descriere").val(sezonregate.descriere);
        modal.find("#nivel_performanta").val(sezonregate.nivel_performanta);
        modal.find("#model").val(sezonregate.model);
        modal.find("#an_fabricatie").val(sezonregate.an_fabricatie);
        modal.find("#pret").val(sezonregate.pret);

        modal.find("#inceput_sezon").val(sezonregate.details.inceput_sezon);
        modal.find("#final_sezon").val(sezonregate.details.final_sezon);

        var previzualizare_imagine = $("#previzualizare_imagine");
        previzualizare_imagine.html(`<img id="img" src="/files/${sezonregate.imagine}" width="70"
    height="70"/>`);

        sezonregate.details.imagini.forEach(function (imagine, index) {
            galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
      height="70"/>`);
        });
        modal.find("#locatie").val(sezonregate.calendar.locatie);

        $("#regattaSeasonEditModal #imagini").on("change", function () {
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

        $("#regattaSeasonEditModal #imagine").on("change", function (event) {
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
    $("#form_regattaseason_edit").on("submit", function (event) {
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
                $("#regattaSeasonEditModal").removeClass("show");
                $("#regattaSeasonEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#regattaSeasonDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let sezonregate = button.data("sezonregate");

        let modal = $(this);

        modal.find("#regattaSeasonDeleteId").val(sezonregate.id);
        modal.find("#regattaSeasonDeleteName").text(sezonregate.nume);
    });
    $("#form_regattaseason_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();
        var form = this;
        let id = $("#regattaSeasonDeleteId").val();
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
                $("#regattaSeasonDeleteModal").removeClass("show");
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

    $("#addRegattaSeason").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let nume = $("#nume").val();
        let descriere = $("#descriere").val();
        let nivel_performanta = $("#nivel_performanta").val();
        let model_barca = $("#modelBarcaSelectat").val();
        let an_fabricatie = $("#an_fabricatie").val();
        let pret = $("#pret").val();
        let imagine = document.getElementById("imagine").files[0];
        let numar_imagini = $("#imagini")[0].files.length;
        let imagini = document.getElementById("imagini");
        let formData = new FormData();

        for (let i = 0; i <= numar_imagini; i++) {
            file = imagini.files[i];
            formData.append("imagini[]", file);
        }

        let inceput_sezon = $("#inceput_sezon").val();
        let final_sezon = $("#final_sezon").val();
        let locatie = $("#locatie").val();

        formData.append("nume", nume);
        formData.append("descriere", descriere);
        formData.append("nivel_performanta", nivel_performanta);
        formData.append("model_barca", model_barca);
        formData.append("an_fabricatie", an_fabricatie);
        formData.append("pret", pret);
        formData.append("imagine", imagine);
        formData.append("numar_imagini", numar_imagini);
        formData.append("inceput_sezon", inceput_sezon);
        formData.append("final_sezon", final_sezon);
        formData.append("locatie", locatie);

        $.ajax({
            url: "/admin/sezon-regate/creare",
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

                $("#previzualizare_imagine img").remove();
                $("#galerie img").remove();
                toastr.success(response.success);
            }
        });
    });
});
