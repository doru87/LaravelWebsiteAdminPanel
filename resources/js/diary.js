$(function () {
    let editor;

    ClassicEditor.create(document.querySelector(".jurnal #descriere"), {
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

    $("#evenimentSelectat").on("change", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var id = $(this).val();

        $.ajax({
            method: "POST",
            url: "/admin/jurnal/idEveniment",
            data: { id },
        }).done(function (response) {
            if (response.hasOwnProperty("error")) {
            } else if (response.hasOwnProperty("success")) {
                console.log(response.success);
                $("#diary").removeClass("hidden_diary");
                $("#diary #pozitie").val(response.success.pozitie);
                $("#diary #nume").val(response.success.nume);
                $("#diary #eventId").val(response.success.id);
                $("#diary #itinerariu").val(response.success.destinatie);
                var galerie = $("#diary #galerie");
                var previzualizare_imagine = $("#previzualizare_imagine");
                var img = $("#previzualizare_imagine img");
                $("#diary #imagine").prop("disabled", true);
                $("#diary #imagini").prop("disabled", true);
                previzualizare_imagine.empty();
                $("<img />", {
                    src: "/files/" + response.success.imagine,
                    class: "thumb-image",
                    width: "70",
                    height: "70",
                }).appendTo(previzualizare_imagine);
                galerie.empty();

                response.success.details.imagini.forEach((imagine) => {
                    $("<img />", {
                        src: "/files/" + imagine,
                        class: "thumb-image",
                        width: "70",
                        height: "70",
                    }).appendTo(galerie);
                });
            }
        });
    });
    $("#inceput_perioada").datetimepicker({
        format: "Y-m-d",
        lang: "ro",
    });
    $("#final_perioada").datetimepicker({
        format: "Y-m-d",
        lang: "ro",
    });

    $("#addDiary").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let pozitie = $("#pozitie").val();
        let nume_eveniment = $("#nume").val();
        let id_eveniment = $("#eventId").val();
        // let descriere_sumara = $("#descriere_sumara").val();
        let inceput_perioada = $("#inceput_perioada").val();
        let final_perioada = $("#final_perioada").val();
        let itinerariu = $("#itinerariu").val();
        // let descriere_detaliata = $("#descriere_detaliata").val();
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
        formData.append("nume_eveniment", nume_eveniment);
        formData.append("id_eveniment", id_eveniment);
        // formData.append("descriere_sumara", descriere_sumara);
        formData.append("inceput_perioada", inceput_perioada);
        formData.append("final_perioada", final_perioada);
        formData.append("itinerariu", itinerariu);
        formData.append("descriere", descriere);
        formData.append("imagine", imagine);
        // formData.append("descriere_detaliata", descriere_detaliata);

        $.ajax({
            url: "/admin/jurnal/creare",
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

    $("#form_diary_edit").on("submit", function (event) {
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
                $("#diaryEditModal").removeClass("show");
                $("#diaryEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#diaryEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let jurnal = button.data("jurnal");

        let modal = $(this);

        modal.find("#diaryEditId").val(jurnal.id);
        modal.find("#pozitie").val(jurnal.pozitie);
        // modal.find("#descriere_sumara").val(jurnal.descriere_sumara);
        modal.find("#inceput_perioada").val(jurnal.inceput_perioada);
        editor.setData(jurnal.descriere);
        modal.find("#final_perioada").val(jurnal.final_perioada);
        modal.find("#itinerariu").val(jurnal.itinerariu);
        modal
            .find("#descriere_detaliata")
            .val(jurnal.details.descriere_detaliata);
    });

    $("#diaryDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let jurnal = button.data("jurnal");

        let modal = $(this);

        modal.find("#diaryDeleteId").val(jurnal.id);
    });

    $("#form_diary_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();

        var form = this;
        let id = $("#diaryDeleteId").val();
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
                $("#diaryDeleteModal").removeClass("show");
                $(".modal-backdrop").remove();
                toastr.success(response.success);
            }
        });
    });
});
