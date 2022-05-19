$(function () {
    let editor;

    ClassicEditor.create(document.querySelector(".charter #descriere"), {
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
    $("#addCharter").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let pozitie = $("#pozitie").val();
        let nume = $("#nume").val();
        const descriere = editor.getData();
        // let descriere = $("#descriere").val();
        let perioada = $("#perioada").val();
        let capacitate = $("#capacitate").val();
        let skipper = $("#skipper-text").val();
        let pret = $("#pret").val();
        let imagine = document.getElementById("imagine").files[0];

        let numar_imagini = $("#imagini")[0].files.length;
        let imagini = document.getElementById("imagini");
        let servicii_incluse = $("#servicii_incluse").val();
        // let check_in = $("#check_in").val();
        // let check_out = $("#check_out").val();

        let formData = new FormData();

        for (let i = 0; i <= numar_imagini; i++) {
            file = imagini.files[i];
            formData.append("imagini[]", file);
        }

        formData.append("pozitie", pozitie);
        formData.append("nume", nume);
        formData.append("descriere", descriere);
        formData.append("perioada", perioada);
        formData.append("capacitate", capacitate);
        formData.append("skipper", skipper);
        formData.append("pret", pret);
        formData.append("imagine", imagine);

        formData.append("servicii_incluse", servicii_incluse);
        // formData.append("check_in", check_in);
        // formData.append("check_out", check_out);

        $.ajax({
            url: "/admin/charter/creare",
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
                $("input[type=checkbox]").prop("checked", false);
                $("#previzualizare_imagine img").remove();
                $("#galerie img").remove();
                toastr.success(response.success);
            }
        });
    });

    $("#form_charter_edit").on("submit", function (event) {
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
                $("#charterEditModal").removeClass("show");
                $("#charterEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#charterEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let charter = button.data("charter");

        let modal = $(this);
        var galerie = modal.find("#galerie");
        galerie.empty();
        modal.find("#charterEditId").val(charter.id);
        modal.find("#pozitie").val(charter.pozitie);
        modal.find("#nume").val(charter.nume);
        // modal.find("#descriere").val(charter.descriere);
        editor.setData(charter.descriere);
        modal.find("#perioada").val(charter.perioada);
        modal.find("#capacitate").val(charter.capacitate);
        modal.find("#skipper").val(charter.skipper);
        if (charter.skipper === "Inclus") {
            modal.find("#skipper-text").val(charter.skipper);
            $("#skipper").prop("checked", true);
        } else {
            modal.find("#skipper-text").val(charter.skipper);
            $("#skipper").prop("checked", false);
        }
        modal.find("#pret").val(charter.pret);
        var previzualizare_imagine = $("#previzualizare_imagine");
        previzualizare_imagine.html(`<img id="img" src="/files/${charter.imagine}" width="70"
  height="70"/>`);

        charter.details.imagini.forEach(function (imagine, index) {
            galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
    height="70"/>`);
        });
        modal.find("#servicii_incluse").val(charter.details.servicii_incluse);
        // modal.find("#check_in").val(charter.details.check_in);
        // modal.find("#check_out").val(charter.details.check_out);

        $("#charterEditModal #imagini").on("change", function () {
            var galerie = $(this).next().next();
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
                }
            }
        });

        $("#charterEditModal #imagine").on("change", function (event) {
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

    $("#charterDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let charter = button.data("charter");

        let modal = $(this);

        modal.find("#charterDeleteId").val(charter.id);
        modal.find("#charterDeleteName").text(charter.nume);
    });
    $("#form_charter_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();

        var form = this;
        let id = $("#charterDeleteId").val();
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
                $("#charterDeleteModal").removeClass("show");
                $(".modal-backdrop").remove();
                toastr.success(response.success);
            }
        });
    });

    $("#skipper").on("click", function () {
        if (this.checked) {
            $("#skipper-text").val("Inclus");
        } else {
            $("#skipper-text").val("Nu e inclus");
        }
    });

    // $(".charter #check_in").change(function () {
    //     let check_in = $(this).val();
    //     console.log(check_in);
    //     $.ajaxSetup({
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //     });
    //     let formData = new FormData();
    //     formData.append("check_in", check_in);

    //     $(".charter #check_out").change(function () {
    //         let check_out = $(this).val();

    //         formData.append("check_out", check_out);
    //         $.ajax({
    //             type: "POST",
    //             url: "/admin/charter/perioada",
    //             data: formData,
    //             processData: false,
    //             contentType: false,
    //         }).done(function (response) {
    //             console.log(response);
    //             response > 1
    //                 ? $("#perioada").val(response + " zile")
    //                 : $("#perioada").val(response + " zi");
    //         });
    //     });
    // });
});
