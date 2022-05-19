$(function () {
    $("#table").DataTable();
    $("#imagine").change(function (event) {
        imagine = event.target.files[0].name;
        var imgPath = $("#imagine")[0].value;
        var extn = imgPath
            .substring(imgPath.lastIndexOf(".") + 1)
            .toLowerCase();
        var previzualizare_imagine = $("#previzualizare_imagine");
        var img = $("#previzualizare_imagine img");
        console.log(img);
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (img.length > 0) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    img.replaceWith(
                        $("<img />", {
                            src: e.target.result,
                            class: "thumb-image",
                            width: "70",
                            height: "70",
                        })
                    );
                };
                reader.readAsDataURL($("#imagine")[0].files[0]);
            } else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                        src: e.target.result,
                        class: "thumb-image",
                        width: "70",
                        height: "70",
                    }).appendTo(previzualizare_imagine);
                };
                reader.readAsDataURL($("#imagine")[0].files[0]);
            }
        }
    });

    $("#imagini").change(function () {
        var countFiles = $("#imagini")[0].files.length;
        var imgPath = $("#imagini")[0].value;
        var extn = imgPath
            .substring(imgPath.lastIndexOf(".") + 1)
            .toLowerCase();
        var galerie = $("#galerie");
        galerie.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    console.log(e.target);
                    $("<img />", {
                        src: e.target.result,
                        class: "thumb-image",
                        width: "70",
                        height: "70",
                    }).appendTo(galerie);
                };
                reader.readAsDataURL($("#imagini")[0].files[i]);
            }
        } else {
            alert("Pls select only images");
        }
    });

    $("#check_in").datetimepicker({
        format: "Y-m-d",
        lang: "ro",
    });
    $("#check_out").datetimepicker({
        format: "Y-m-d",
        lang: "ro",
    });

    var splide = new Splide("#main-slider", {
        pagination: false,
        cover: true,
    });
});
