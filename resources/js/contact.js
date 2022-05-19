$(function () {
    // $("#contactFormular").on("click", function (e) {
    $("#contactForm").on("submit", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        e.preventDefault();

        let nume = $("#nume").val();
        let email = $("#email").val();
        let telefon = $("#telefon").val();
        let mesaj = $("#mesaj").val();

        let formData = new FormData();

        formData.append("nume", nume);
        formData.append("email", email);
        formData.append("telefon", telefon);
        formData.append("mesaj", mesaj);
        formData.append(
            "g-recaptcha-response",
            getReCaptchaV3Response("contact_us_ajax_id")
        );

        $.ajax({
            url: "/contact/create",
            type: "POST",
            data: formData,
            processData: false,
            dataType: "json",
            contentType: false,
        }).done(function (response) {
            refreshReCaptchaV3("contact_us_ajax_id", "contact_us_action");
        });
        return false;
    });
});
