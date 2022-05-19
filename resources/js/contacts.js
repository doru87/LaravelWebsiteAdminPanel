$(function () {
    $("#contactViewModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let contact = button.data("contact");

        let modal = $(this);

        modal.find("#contactId").val(contact.id);
        modal.find("#nume").val(contact.nume);
        modal.find("#email").val(contact.email);
        modal.find("#telefon").val(contact.telefon);
        modal.find("#mesaj").val(contact.mesaj);
    });

    $("#contactDeleteModal").on("shown.bs.modal", function (event) {
        let button = $(event.relatedTarget);
        let contact = button.data("contact");

        let modal = $(this);

        modal.find("#contactDeleteId").val(contact.id);
    });

    $("#form_contact_delete").on("submit", function (event) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        event.preventDefault();

        var form = this;
        let id = $("#contactDeleteId").val();
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
                $("#contactDeleteModal").removeClass("show");
                $(".modal-backdrop").remove();
                toastr.success(response.success);
            }
        });
    });
});
