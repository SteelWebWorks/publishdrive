import 'flowbite';

$(".toggle-additional-info").each(function () {
    let toggle = $(this).data("toggle");

    $(this).find("input[type = 'checkbox']").on("change", function () {

        if ($(this).prop("checked") == true) {
            $("#" + toggle).show();
        } else {
            $("#" + toggle).hide();
        }
    });
});
