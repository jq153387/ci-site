$.ajaxSetup({ cache: false });
var show = {
    per: 10,
    index: { n: 0, m: "first" },
    pre: { n: "上一頁", m: "prev" },
    next: { n: "下一頁", m: "next" },
};
var counter = 0,
    perPage = 12;
function ablum_init(id) {
    $.getJSON("api/album_sub/" + id, function (data) {
        $.each(data.json, function (j, item) {
            $(".perf-item").append(
                "<li><span><a href='#' onclick=\"ChangeCase('" +
                    item.id +
                    "')\">" +
                    item.name +
                    "</a></span></li>"
            );
            if (j == 0) {
                $.getJSON("api/album_photo/" + item.id, function (data) {
                    $.each(data.json, function (k, item) {
                        if (k >= 0 && k < perPage) {
                            $(".perf-list").append(
                                '<li><div class="mid"><a href="assets/uploads/' +
                                    item.url +
                                    '" class="group1"><img src="assets/uploads/' +
                                    item.url +
                                    '" /></a></div></li>'
                            );
                            $(".group1").colorbox({ rel: "group1" });
                        }
                        counter++;
                    });
                    $("#pager").pager({
                        pagenumber: 1,
                        pagecount: Math.ceil(counter / perPage),
                        buttonClickCallback: PageClick,
                        show: show,
                        pid: item.id,
                    });
                });
            }
        });
    });
}

function ChangeCase(id) {
    counter = 0;
    $(".perf-list").replaceWith('<ul class="perf-list"></ul>');
    $.getJSON("api/album_photo/" + id, function (data) {
        $.each(data.json, function (k, item) {
            if (k >= 0 && k < perPage) {
                $(".perf-list").append(
                    '<li><div class="mid"><a href="assets/uploads/' +
                        item.url +
                        '" class="group1"><img src="assets/uploads/' +
                        item.url +
                        '" /></a></div></li>'
                );
                $(".group1").colorbox({ rel: "group1" });
            }
            counter++;
        });
        $("#pager").pager({
            pagenumber: 1,
            pagecount: Math.ceil(counter / perPage),
            buttonClickCallback: PageClick,
            show: show,
            pid: id,
        });
    });
}

PageClick = function (pageclickednumber, id) {
    counter = 0;
    $(".perf-list").replaceWith('<ul class="perf-list"></ul>');
    $.getJSON("api/album_photo/" + id, function (data) {
        $.each(data.json, function (k, item) {
            if (
                k >= perPage * pageclickednumber - 12 &&
                k < perPage * pageclickednumber
            ) {
                $(".perf-list").append(
                    '<li><div class="mid"><a href="assets/uploads/' +
                        item.url +
                        '" class="group1"><img src="assets/uploads/' +
                        item.url +
                        '" /></a></div></li>'
                );
                $(".group1").colorbox({ rel: "group1" });
            }
            counter++;
        });
        $("#pager").pager({
            pagenumber: pageclickednumber,
            pagecount: Math.ceil(counter / perPage),
            buttonClickCallback: PageClick,
            show: show,
            pid: id,
        });
    });
};
