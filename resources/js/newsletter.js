$(function () {
    $("#newsletter").on("click", function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let email = $("#email").val();
        let formData = new FormData();
        formData.append("email", email);

        $.ajax({
            url: "/newsletter",
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
                $(".right-footer").find("input:text").val("");
                toastr.success(response.success);
            }
        });
    });
});
