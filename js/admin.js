$(document).ready(function () {
    $(".panel-heading").click(function () {
        $obj = $(this);
        $list = $obj.parent().children('.table');
        hidden = $list.attr('hidden');
        $list.attr('hidden', !hidden);
    });

    $("#addAchLink").click(function () {
        $block = $("#addAchBlock");
        hidden = $block.attr('hidden');
        $block.attr('hidden', !hidden);
    });
    $("#addAchBtn").click(function () {
        $name = $("#achName").val();
        $desc = $("#achDesc").val();
        $group = 1;
        var req = getXmlHttp();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    if (req.responseText === 'ok') {
                        $("#achName").val('');
                        $("#achDesc").val('');
                        $("#achList tr:last").after("<tr><td>" + $name + "</td><td>" + $desc + "</td><td>" + $group + "</td></tr>");
                    }
                }
            }
        };
        req.open('GET', 'admin/addAchievement/' + $name + '/' + $desc + '/' + $group, true);
        req.send(null);
    });
});

function getXmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest !== 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
