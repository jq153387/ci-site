function postReview(e, id) {
    e.preventDefault();
    var this_id = "#review-re-" + id;
    var query =
        $(this_id).serialize() + "&csrf_tsj=" + getCookie("csrf_cookie_tsj");
    $.ajax({
        url: "/comments/add_review",
        type: "POST",
        data: query,
        dataType: "json",
        success: function (response) {
            // Update CSRF hash
            console.log(response);
            if ($.isEmptyObject(response.error)) {
                $(this_id + " .print-error-msg").css("display", "none");
                alert(response.success);
                for (const key in response.data) {
                    console.log();

                    if (key != "id") {
                        $(this_id + " [name='" + key + "']").val("");
                    }
                }
            } else {
                $(this_id + " .print-error-msg").css("display", "block");
                $(this_id + " .print-error-msg").html(response.error);
            }
        },
    });
}
function getCookie(name) {
    var arr = document.cookie.match(
        new RegExp("(^| )" + name + "=([^;]*)(;|$)")
    );
    if (arr != null) return unescape(arr[2]);
    return null;
}
