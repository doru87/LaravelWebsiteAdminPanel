// $(function () {
//     $("#regattaEditModal").on("shown.bs.modal", function (event) {
//         let button = $(event.relatedTarget);
//         let regata = button.data("regata");

//         let modal = $(this);
//         var galerie = modal.find("#galerie");
//         galerie.empty();
//         modal.find("#regattaEditId").val(regata.id);
//         modal.find("#nume").val(regata.nume);
//         modal.find("#descriere").val(regata.descriere);
//         modal.find("#pret").val(regata.pret);

//         modal.find("#inceput_sezon").val(regata.details.inceput_sezon);
//         modal.find("#final_sezon").val(regata.details.final_sezon);

//         var previzualizare_imagine = $("#previzualizare_imagine");
//         previzualizare_imagine.html(`<img id="img" src="/files/${regata.imagine}" width="70"
//     height="70"/>`);

//         regata.details.imagini.forEach(function (imagine, index) {
//             galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
//       height="70"/>`);
//         });
//         modal.find("#locatie").val(regata.calendar.locatie);

//         $("#regattaEditModal #imagini").on("change", function () {
//             var galerie = $(this).next().next();
//             galerie.find("img").remove();
//             var countFiles = $(this)[0].files.length;

//             var imgPath = $(this)[0].value;
//             var extn = imgPath
//                 .substring(imgPath.lastIndexOf(".") + 1)
//                 .toLowerCase();

//             if (
//                 extn == "gif" ||
//                 extn == "png" ||
//                 extn == "jpg" ||
//                 extn == "jpeg"
//             ) {
//                 for (var i = 0; i < countFiles; i++) {
//                     var reader = new FileReader();

//                     reader.onload = function (e) {
//                         $("<img />", {
//                             src: e.target.result,
//                             id: "thumb-image",
//                             width: "70",
//                             height: "70",
//                         }).appendTo(galerie);
//                     };
//                 }
//             }
//         });

//         $("#regattaEditModal #imagine").on("change", function (event) {
//             var imgPath = $(this)[0].value;
//             var extn = imgPath
//                 .substring(imgPath.lastIndexOf(".") + 1)
//                 .toLowerCase();
//             var img = $("#img");
//             if (
//                 extn == "gif" ||
//                 extn == "png" ||
//                 extn == "jpg" ||
//                 extn == "jpeg"
//             ) {
//                 var reader = new FileReader();
//                 reader.onload = function (e) {
//                     img.attr("src", e.target.result);
//                 };
//                 reader.readAsDataURL($("#imagine")[0].files[0]);
//             }
//         });
//     });
//     $("#form_regatta_edit").on("submit", function (event) {
//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });
//         event.preventDefault();
//         var form = this;
//         $.ajax({
//             url: $(form).attr("action"),
//             method: $(form).attr("method"),
//             data: new FormData(form),
//             processData: false,
//             dataType: "json",
//             contentType: false,
//         }).done(function (response) {
//             console.log(response);
//             if (response.hasOwnProperty("errors")) {
//                 for (const key in response) {
//                     const element = response[key];
//                     for (const key in element) {
//                         console.log(element[key]);
//                         toastr.error(element[key]);
//                     }
//                 }
//             } else if (response.hasOwnProperty("success")) {
//                 $("#regattaEditModal").removeClass("show");
//                 $("#regattaEditModal").addClass("fade");
//                 $(".modal-backdrop").remove();

//                 toastr.success(response.success);
//                 location.reload();
//             }
//         });
//     });

//     $("#regattaDeleteModal").on("shown.bs.modal", function (event) {
//         let button = $(event.relatedTarget);
//         let regata = button.data("regata");

//         let modal = $(this);

//         modal.find("#regattaDeleteId").val(regata.id);
//         modal.find("#regattaDeleteName").text(regata.nume);
//     });
//     $("#form_regatta_delete").on("submit", function (event) {
//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });
//         event.preventDefault();
//         var form = this;
//         let id = $("#regattaDeleteId").val();
//         var form = this;
//         $.ajax({
//             url: $(form).attr("action"),
//             type: $(form).attr("method"),
//             data: new FormData(form),
//             processData: false,
//             dataType: "json",
//             contentType: false,
//         }).done(function (response) {
//             console.log(response);
//             if (response.hasOwnProperty("success")) {
//                 $(`.item${id}`).remove();
//                 $("#regattaDeleteModal").removeClass("show");
//                 $(".modal-backdrop").remove();
//                 toastr.success(response.success);
//             }
//         });
//     });

//     $("#inceput_sezon").datetimepicker({
//         format: "Y-m-d",
//         lang: "ro",
//     });
//     $("#final_sezon").datetimepicker({
//         format: "Y-m-d",
//         lang: "ro",
//     });

//     $("#addRegatta").on("click", function () {
//         $.ajaxSetup({
//             headers: {
//                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//             },
//         });

//         let nume = $("#nume").val();
//         let descriere = $("#descriere").val();
//         let pret = $("#pret").val();
//         let imagine = document.getElementById("imagine").files[0];
//         let numar_imagini = $("#imagini")[0].files.length;
//         let imagini = document.getElementById("imagini");
//         let formData = new FormData();

//         for (let i = 0; i <= numar_imagini; i++) {
//             file = imagini.files[i];
//             formData.append("imagini[]", file);
//         }

//         let inceput_sezon = $("#inceput_sezon").val();
//         let final_sezon = $("#final_sezon").val();
//         let locatie = $("#locatie").val();

//         formData.append("nume", nume);
//         formData.append("descriere", descriere);
//         formData.append("pret", pret);
//         formData.append("imagine", imagine);
//         formData.append("numar_imagini", numar_imagini);
//         formData.append("inceput_sezon", inceput_sezon);
//         formData.append("final_sezon", final_sezon);
//         formData.append("locatie", locatie);

//         $.ajax({
//             url: "/admin/regata/creare",
//             type: "POST",
//             data: formData,
//             processData: false,
//             dataType: "json",
//             contentType: false,
//         }).done(function (response) {
//             if (response.hasOwnProperty("errors")) {
//                 for (const key in response) {
//                     const element = response[key];
//                     for (const key in element) {
//                         toastr.error(element[key]);
//                     }
//                 }
//             } else if (response.hasOwnProperty("success")) {
//                 $(".content")
//                     .find("input:text,textarea, select")
//                     .each(function () {
//                         $(this).val("");
//                     });

//                 $("#previzualizare_imagine img").remove();
//                 $("#galerie img").remove();
//                 toastr.success(response.success);
//             }
//         });
//     });
// });

$(function () {
    let editor;

    ClassicEditor.create(document.querySelector(".regatta #descriere"), {
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

    $("#regattaEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let regatta = button.data("regatta");

        let modal = $(this);
        var galerie = modal.find("#galerie");
        galerie.empty();
        modal.find("#regattaEditId").val(regatta.id);
        modal.find("#pozitie").val(regatta.pozitie);
        modal.find("#nume").val(regatta.nume);
        // modal.find("#descriere").val(regatta.descriere);
        editor.setData(regatta.descriere);
        modal.find("#nivel_performanta").val(regatta.nivel_performanta);
        // modal.find("#model").val(calendar.regatta.model);

        var options = $("#modelBarcaSelectat option");

        var values = $.map(options, function (option) {
            return option.value;
        });

        values.forEach((option) => {
            if (regatta.model == option) {
                $(`#modelBarcaSelectat option[value='${regatta.model}']`).attr(
                    "selected",
                    "selected"
                );
            }
        });
        modal.find("#an_fabricatie").val(regatta.an_fabricatie);
        modal.find("#pret").val(regatta.pret);

        var previzualizare_imagine = $("#previzualizare_imagine");
        previzualizare_imagine.html(`<img id="img" src="/files/${regatta.imagine}" width="70"
    height="70"/>`);

        regatta.details.imagini.forEach(function (imagine, index) {
            galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
      height="70"/>`);
        });

        $("#regattaEditModal #imagini").on("change", function () {
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

        $("#regattaEditModal #imagine").on("change", function (event) {
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
    $("#form_regatta_edit").on("submit", function (event) {
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
                $("#regattaEditModal").removeClass("show");
                $("#regattaEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#regattaDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let regatta = button.data("regatta");

        let modal = $(this);
        modal.find("#regattaDeleteId").val(regatta.id);
        modal.find("#regattaDeleteName").text(regatta.nume);
    });
    $("#form_regatta_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();
        var form = this;
        let id = $("#regattaDeleteId").val();
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
                $("#regattaDeleteModal").removeClass("show");
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

    $("#addRegatta").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let pozitie = $("#pozitie").val();
        let calendarId = $("#calendarId").val();
        let nume = $("#nume").val();
        // let descriere = $("#descriere").val();
        const descriere = editor.getData();
        let nivel_performanta = $("#nivel_performanta").val();
        let modelBarcaSelectat = $("#modelBarcaSelectat").val();
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

        formData.append("pozitie", pozitie);
        formData.append("calendarId", calendarId);
        formData.append("nume", nume);
        formData.append("descriere", descriere);
        formData.append("nivel_performanta", nivel_performanta);
        formData.append("modelBarcaSelectat", modelBarcaSelectat);
        formData.append("an_fabricatie", an_fabricatie);
        formData.append("pret", pret);
        formData.append("imagine", imagine);
        formData.append("numar_imagini", numar_imagini);
        formData.append("inceput_sezon", inceput_sezon);
        formData.append("final_sezon", final_sezon);
        formData.append("locatie", locatie);

        $.ajax({
            url: "/admin/regata/creare",
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
});
