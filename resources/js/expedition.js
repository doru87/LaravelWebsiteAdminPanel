$(function () {
    let editor;

    ClassicEditor.create(document.querySelector(".expeditie #descriere"), {
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

    let zi = 1;
    var count = 0;

    $(".buton_itinerar").click(function () {
        count++;
        $(".lista_itinerarii").append(
            `<div class="card card-primary collapsed-card mt-3 itinerariu_${zi}"> <div class="card-header"> <h3 class="card-title">Ziua ${zi++}</h3> <div class="card-tools"> <button type="button" class="btn btn-tool" data-card-widget="collapse" > <i class="fas fa-plus"></i> </button> </div> </div> <div class="card-body"> <div class="form-group"> <label for="destinatie">Destinatie</label> <input type="text" class="form-control" id="destinatie" name="destinatie" placeholder="" value="" /> </div> <div class="form-group"> <label for="perioada">Perioada</label> <input type="text" class="form-control" id="perioada" name="perioada" placeholder="" value="" /> </div> <div class="form-group"> <label for="descriere">Descriere</label> <input type="text" class="form-control" id="descriere" name="descriere" placeholder="" value="" /> </div>  </div> </div>`
        );
        let itinerarii = [];
        const itinerariu = function (destinatie, perioada, descriere) {
            return {
                destinatie: destinatie,
                perioada: perioada,
                descriere: descriere,
            };
        };

        $(" div[class*='itinerariu_']").each((index) => {
            itinerarii.push(
                new itinerariu(
                    $(`.itinerariu_${index + 1}`)
                        .find("#destinatie")
                        .val(),
                    $(`.itinerariu_${index + 1}`)
                        .find("#perioada")
                        .val(),
                    $(`.itinerariu_${index + 1}`)
                        .find("#descriere")
                        .val()
                )
            );
            localStorage.setItem("itinerarii", JSON.stringify(itinerarii));
        });
    });
    localStorage.setItem("itinerarii", JSON.stringify([]));
    // $(".buton_itinerar").click(function () {
    //     count++;
    //     $(".lista_itinerarii").append(
    //         `<div class="card card-primary collapsed-card mt-3 itinerariu_${zi}"> <div class="card-header"> <h3 class="card-title">Ziua ${zi++}</h3> <div class="card-tools"> <button type="button" class="btn btn-tool" data-card-widget="collapse" > <i class="fas fa-plus"></i> </button> </div> </div> <div class="card-body"> <div class="form-group"> <label for="destinatie">Destinatie</label> <input type="text" class="form-control" id="destinatie" name="destinatie" placeholder="" value="" /> </div> <div class="form-group"> <label for="perioada">Perioada</label> <input type="text" class="form-control" id="perioada" name="perioada" placeholder="" value="" /> </div> <div class="form-group"> <label for="descriere">Descriere</label> <input type="text" class="form-control" id="descriere" name="descriere" placeholder="" value="" /> </div>  </div> </div>`
    //     );
    // });
    // let itinerarii = [];
    // let versiunea_finala_itinerarii = [];
    // let arrayUniqueByKey = [];

    // const itinerariu = function (destinatie, perioada, descriere) {
    //     return {
    //         destinatie: destinatie,
    //         perioada: perioada,
    //         descriere: descriere,
    //     };
    // };

    // setInterval(function () {
    //     $("div[class*='itinerariu_']").each((index, elem) => {
    //         $(elem).on("focusin", function () {
    //             let destinatie = $(this).find("#destinatie").val();
    //             $(this).find("#destinatie").attr("valoare", destinatie);

    //             let perioada = $(this).find("#perioada").val();
    //             $(this).find("#perioada").attr("valoare", perioada);

    //             let descriere = $(this).find("#descriere").val();
    //             $(this).find("#descriere").attr("valoare", descriere);

    //             itinerarii.push(
    //                 new itinerariu(
    //                     $(`.itinerariu_${index + 1}`)
    //                         .find("#destinatie")
    //                         .attr("valoare"),
    //                     $(`.itinerariu_${index + 1}`)
    //                         .find("#perioada")
    //                         .attr("valoare"),
    //                     $(`.itinerariu_${index + 1}`)
    //                         .find("#descriere")
    //                         .attr("valoare")
    //                 )
    //             );

    //             versiunea_finala_itinerarii = [
    //                 ...versiunea_finala_itinerarii,

    //                 itinerarii[itinerarii.length - 1],
    //             ];

    //             const key = "destinatie";
    //             arrayUniqueByKey = [
    //                 ...new Map(
    //                     versiunea_finala_itinerarii.map((item) => [
    //                         item[key],
    //                         item,
    //                     ])
    //                 ).values(),
    //             ];

    //             localStorage.setItem(
    //                 "itinerarii",
    //                 JSON.stringify(arrayUniqueByKey)
    //             );
    //         });

    //         $(elem).on("focusout", function () {
    //             let destinatie = $(this).find("#destinatie").val();
    //             $(this).find("#destinatie").attr("valoare", destinatie);

    //             let perioada = $(this).find("#perioada").val();
    //             $(this).find("#perioada").attr("valoare", perioada);

    //             let descriere = $(this).find("#descriere").val();
    //             $(this).find("#descriere").attr("valoare", descriere);

    //             itinerarii.push(
    //                 new itinerariu(
    //                     $(`.itinerariu_${index + 1}`)
    //                         .find("#destinatie")
    //                         .attr("valoare"),
    //                     $(`.itinerariu_${index + 1}`)
    //                         .find("#perioada")
    //                         .attr("valoare"),
    //                     $(`.itinerariu_${index + 1}`)
    //                         .find("#descriere")
    //                         .attr("valoare")
    //                 )
    //             );

    //             versiunea_finala_itinerarii = [
    //                 ...versiunea_finala_itinerarii,

    //                 itinerarii[itinerarii.length - 1],
    //             ];

    //             const key = "destinatie";
    //             arrayUniqueByKey = [
    //                 ...new Map(
    //                     versiunea_finala_itinerarii.map((item) => [
    //                         item[key],
    //                         item,
    //                     ])
    //                 ).values(),
    //             ];

    //             localStorage.setItem(
    //                 "itinerarii",
    //                 JSON.stringify(arrayUniqueByKey)
    //             );
    //         });
    //     });

    //     localStorage.setItem("itinerarii", JSON.stringify(arrayUniqueByKey));
    // }, 1000);

    // $(elem)
    //     .find("input")
    //     .change(function () {
    // console.log(this);
    // itinerarii.push(
    //     new itinerariu(
    //         $(`.itinerariu_${index + 1}`)
    //             .find("#destinatie")
    //             .attr("valoare"),
    //         $(`.itinerariu_${index + 1}`)
    //             .find("#perioada")
    //             .attr("valoare"),
    //         $(`.itinerariu_${index + 1}`)
    //             .find("#descriere")
    //             .attr("valoare")
    //     )
    // );
    //     versiunea_finala_itinerarii = [
    //         ...versiunea_finala_itinerarii,

    //         itinerarii[itinerarii.length - 1],
    //     ];

    //     const key = "destinatie";
    //     arrayUniqueByKey = [
    //         ...new Map(
    //             versiunea_finala_itinerarii.map((item) => [
    //                 item[key],
    //                 item,
    //             ])
    //         ).values(),
    //     ];

    // });
    //     });

    //     localStorage.setItem("itinerarii", JSON.stringify(arrayUniqueByKey));
    // }, 1000);

    $("#addExpedition").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let pozitie = $("#pozitie").val();
        let nume = $("#nume").val();
        const descriere = editor.getData();
        // let descriere = $("#descriere").val();
        let locatie = $("#locatie").val();
        let modelBarcaSelectat = $("#modelBarcaSelectat").val();
        let perioada = $("#perioada_expeditie").val();
        let skipper = $("#skipper-text").val();
        let pret = $("#pret").val();
        let imagine = document.getElementById("imagine").files[0];

        let numar_imagini = $("#imagini")[0].files.length;
        let imagini = document.getElementById("imagini");
        let servicii_incluse = $("#servicii_incluse").val();
        let check_in = $("#check_in").val();
        let check_out = $("#check_out").val();

        var itinerarii = localStorage.getItem("itinerarii");
        let formData = new FormData();

        for (let i = 0; i <= numar_imagini; i++) {
            file = imagini.files[i];
            formData.append("imagini[]", file);
        }

        formData.append("pozitie", pozitie);
        formData.append("nume", nume);
        formData.append("descriere", descriere);
        formData.append("locatie", locatie);
        formData.append("modelBarcaSelectat", modelBarcaSelectat);
        formData.append("perioada", perioada);
        formData.append("skipper", skipper);
        formData.append("pret", pret);
        formData.append("imagine", imagine);

        formData.append("servicii_incluse", servicii_incluse);
        formData.append("check_in", check_in);
        formData.append("check_out", check_out);
        formData.append("itinerarii", itinerarii);

        $.ajax({
            url: "/admin/expeditie/creare",
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

    // $("#form_expedition_edit").on("submit", function (event) {
    $("#editExpedition").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let pozitie = $("#pozitie").val();
        let nume = $("#nume").val();
        // let descriere = $("#descriere").val();
        const descriere = editor.getData();
        let locatie = $("#locatie").val();
        let modelBarcaSelectat = $("#modelBarcaSelectat").val();
        let expeditionEditId = $("#expeditionEditId").val();
        let perioada = $("#perioada_expeditie").val();
        let skipper = $("#skipper-text").val();
        let pret = $("#pret").val();
        let imagine = document.getElementById("imagine").files[0];

        // let imagine = $("#img").attr("src");
        // console.log(imagine);

        let numar_imagini = $("#imagini")[0].files.length;
        // let numar_imagini = $("#galerie").children().length;
        // console.log(numar_imagini);
        let imagini = document.getElementById("imagini");

        let servicii_incluse = $("#servicii_incluse").val();
        let check_in = $("#check_in").val();
        let check_out = $("#check_out").val();

        let formData = new FormData();

        for (let i = 0; i <= numar_imagini; i++) {
            file = imagini.files[i];
            formData.append("imagini[]", file);
        }
        // let images = [];
        // $("#galerie")
        //     .children("img")
        //     .each(function () {
        //         images.push(this.src);
        //         formData.append("imagini[]", images);
        //     });

        formData.append("pozitie", pozitie);
        formData.append("nume", nume);
        formData.append("descriere", descriere);
        formData.append("locatie", locatie);
        formData.append("modelBarcaSelectat", modelBarcaSelectat);
        formData.append("expeditionEditId", expeditionEditId);
        formData.append("perioada", perioada);
        formData.append("skipper", skipper);
        formData.append("pret", pret);
        formData.append("imagine", imagine);

        formData.append("servicii_incluse", servicii_incluse);
        formData.append("check_in", check_in);
        formData.append("check_out", check_out);

        let itinerarii = [];
        const itinerariu = function (destinatie, perioada, descriere) {
            return {
                destinatie: destinatie,
                perioada: perioada,
                descriere: descriere,
            };
        };

        $(" div[class*='itinerariu_']").each((index) => {
            itinerarii.push(
                new itinerariu(
                    $(`.itinerariu_${index + 1}`)
                        .find("#destinatie")
                        .val(),
                    $(`.itinerariu_${index + 1}`)
                        .find("#perioada")
                        .val(),
                    $(`.itinerariu_${index + 1}`)
                        .find("#descriere")
                        .val()
                )
            );
        });

        for (var i = 0; i < itinerarii.length; i++) {
            formData.append("itinerarii[]", JSON.stringify(itinerarii[i]));
        }

        $.ajax({
            url: "/admin/expeditie/editare",
            method: "POST",
            // data: new FormData(form),
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
                $("#expeditionEditModal").removeClass("show");
                $("#expeditionEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#expeditionEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let expeditie = button.data("expeditie");

        let modal = $(this);
        var galerie = modal.find("#galerie");
        galerie.empty();
        modal.find("#expeditionEditId").val(expeditie.id);
        modal.find("#pozitie").val(expeditie.pozitie);
        modal.find("#nume").val(expeditie.nume);
        // modal.find("#descriere").val(expeditie.descriere);
        editor && editor.setData(expeditie.descriere);
        modal.find("#locatie").val(expeditie.locatie);
        modal.find("#perioada_expeditie").val(expeditie.perioada);
        // modal.find("#modelBarcaSelectat").val(expeditie.model);

        var options = $("#modelBarcaSelectat option");

        var values = $.map(options, function (option) {
            return option.value;
        });

        values.forEach((option) => {
            if (expeditie.model == option) {
                $(
                    `#modelBarcaSelectat option[value='${expeditie.model}']`
                ).attr("selected", "selected");
            }
        });

        $(".lista_itinerarii").empty();
        $.each(expeditie.itineraries, function (index, val) {
            let zi = index + 1;

            $(".lista_itinerarii").append(
                `<div class="card card-primary collapsed-card mt-3 itinerariu_${
                    index + 1
                }"> <div class="card-header"> <h3 class="card-title">Ziua ${zi++}</h3> <div class="card-tools"> <button type="button" class="btn btn-tool" data-card-widget="collapse" > <i class="fas fa-plus"></i> </button> </div> </div> <div class="card-body"> <div class="form-group"> <label for="destinatie">Destinatie</label> <input type="text" class="form-control" id="destinatie" name="destinatie" placeholder="" value="${
                    val.destinatie
                }" /> </div> <div class="form-group"> <label for="perioada">Perioada</label> <input type="text" class="form-control" id="perioada" name="perioada" placeholder="" value="${
                    val.perioada
                }" /> </div> <div class="form-group"> <label for="descriere">Descriere</label> <input type="text" class="form-control" id="descriere" name="descriere" placeholder="" value="${
                    val.descriere
                }" /> </div>  </div> </div>`
            );
        });

        modal.find("#skipper").val(expeditie.skipper);
        if (expeditie.skipper === "Inclus") {
            modal.find("#skipper-text").val(expeditie.skipper);
            $("#skipper").prop("checked", true);
        } else {
            modal.find("#skipper-text").val(expeditie.skipper);
            $("#skipper").prop("checked", false);
        }
        modal.find("#pret").val(expeditie.pret);

        var previzualizare_imagine = $("#previzualizare_imagine");
        previzualizare_imagine.html(`<img id="img" src="/files/${expeditie.imagine}" width="70"
      height="70"/>`);

        expeditie.details.imagini.forEach(function (imagine, index) {
            galerie.append(`<img id="thumb-image" src="/files/${imagine}" width="70"
        height="70"/>`);
        });
        modal.find("#servicii_incluse").val(expeditie.details.servicii_incluse);
        modal.find("#check_in").val(expeditie.details.check_in);
        modal.find("#check_out").val(expeditie.details.check_out);

        $("#expeditionEditModal #imagini").on("change", function () {
            var galerie = $(this).next().next();
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

        $("#expeditionEditModal #imagine").on("change", function (event) {
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

    $("#expeditionDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let expeditie = button.data("expeditie");

        let modal = $(this);

        modal.find("#expeditionDeleteId").val(expeditie.id);
        modal.find("#expeditionDeleteName").text(expeditie.nume);
    });
    $("#form_expedition_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();

        var form = this;
        let id = $("#expeditionDeleteId").val();
        $.ajax({
            url: $(form).attr("action"),
            type: $(form).attr("method"),
            data: new FormData(form),
            processData: false,
            dataType: "json",
            contentType: false,
        }).done(function (response) {
            if (response.hasOwnProperty("success")) {
                $(`.item${id}`).remove();
                $("#expeditionDeleteModal").removeClass("show");
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
    $(".check_in").hide();
    $(".check_out").hide();

    $(".expeditie #check_in").change(function (event) {
        let check_in = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let formData = new FormData();
        formData.append("check_in", check_in);
        $.ajax({
            type: "POST",
            url: "/admin/expeditie/perioada",
            data: formData,
            processData: false,
            contentType: false,
        }).done(function (response) {
            $(".check_in").html(response);
            var text = $(".check_in").html();
            $(".expeditie #perioada_expeditie").val(
                text.concat($(".check_out").html())
            );
        });
    });
    $(".expeditie #check_out").change(function () {
        let check_out = $(this).val();
        let formData = new FormData();
        formData.append("check_out", check_out);
        $.ajax({
            type: "POST",
            url: "/admin/expeditie/perioada",
            data: formData,
            processData: false,
            contentType: false,
        }).done(function (response) {
            // $(".expeditie #perioada").val(response);
            $(".check_in").html();
            $(".check_out").html(response);
            var text = $(".check_out").html();
            $(".expeditie #perioada_expeditie").val(
                $(".check_in").html().concat(text)
            );
        });
    });
});
