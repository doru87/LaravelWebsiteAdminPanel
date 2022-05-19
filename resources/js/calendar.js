$(function () {
    $("#addCalendar").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let pozitie = $("#pozitie").val();
        let nume = $("#nume").val();
        let inceput_perioada = $("#inceput_perioada").val();
        let final_perioada = $("#final_perioada").val();
        let locatie = $("#locatie").val();

        let formData = new FormData();

        formData.append("pozitie", pozitie);
        formData.append("nume", nume);
        formData.append("inceput_perioada", inceput_perioada);
        formData.append("final_perioada", final_perioada);
        formData.append("locatie", locatie);

        $.ajax({
            url: "/admin/calendar-regate/creare",
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
                toastr.success(response.success);
            }
        });
    });

    $("#calendarEditModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let calendar = button.data("calendar");

        let modal = $(this);

        modal.find("#calendarEditId").val(calendar.id);
        modal.find("#pozitie").val(calendar.pozitie);
        modal.find("#nume").val(calendar.nume);
        modal.find("#inceput_perioada").val(calendar.inceput_perioada);
        modal.find("#final_perioada").val(calendar.final_perioada);
        modal.find("#locatie").val(calendar.locatie);
    });

    $("#form_calendar_edit").on("submit", function (event) {
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
                $("#calendarEditModal").removeClass("show");
                $("#calendarEditModal").addClass("fade");
                $(".modal-backdrop").remove();

                toastr.success(response.success);
                location.reload();
            }
        });
    });

    $("#calendarDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let calendar = button.data("calendar");

        let modal = $(this);

        modal.find("#calendarDeleteId").val(calendar.id);
        modal.find("#calendarDeleteName").text(calendar.nume);
    });

    $("#form_calendar_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();

        var form = this;
        let id = $("#calendarDeleteId").val();
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
                $("#calendarDeleteModal").removeClass("show");
                $(".modal-backdrop").remove();
                toastr.success(response.success);
            }
        });
    });
});
