$(document).ready(function () {
    markActiveItem();
    $("#btnPersonForm").click(function () {
        hidden = $("#personFormBlock").attr('hidden');
        $("#personFormBlock").attr('hidden', !hidden);
        span = $(this).children("span");
        if (hidden) {
            span.addClass('rotate');

        } else {
            span.removeClass('rotate');
        }
    });
    $('.like').click(function () {
        id = $(this).parent().attr('id');
        var req = getXmlHttp();
        var objLikes = $(this).children('button').children('i');
        var objDislikes = $(this).parent().children('.dislike').children('button').children('i');
        var oldLikes = objLikes.text();
        var oldDislikes = objDislikes.text();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    if (req.responseText === 'inc') {
                        objLikes.text(parseInt(oldLikes) + 1);
                    } else if (req.responseText === 'dec') {
                        objLikes.text(parseInt(oldLikes) - 1);
                    } else {
                        objDislikes.text(parseInt(oldDislikes) - 1);
                    }
                }
            }
        }
        req.open('GET', 'up/' + id, true);
        req.send(null);
    });
    $('.dislike').click(function () {
        id = $(this).parent().attr('id');
        var req = getXmlHttp();
        var objDislikes = $(this).children('button').children('i');
        var objLikes = $(this).parent().children('.like').children('button').children('i');
        var oldDislikes = objDislikes.text();
        var oldLikes = objLikes.text();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    if (req.responseText === 'inc') {
                        objDislikes.text(parseInt(oldDislikes) + 1);
                    } else if (req.responseText === 'dec') {
                        objDislikes.text(parseInt(oldDislikes) - 1);
                    } else {
                        objLikes.text(parseInt(oldLikes) - 1);
                    }
                }
            }
        }
        req.open('GET', 'down/' + id, true);
        req.send(null);
    });
    $('.fav').click(function () {
        id = $(this).parent().attr('id');
        var req = getXmlHttp();
        var objFav = $(this).children('button').children('i');
        var oldFav = objFav.text();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    if (req.responseText === 'inc') {
                        objFav.text(parseInt(oldFav) + 1);
                    } else if (req.responseText === 'dec') {
                        objFav.text(parseInt(oldFav) - 1);
                    }
                }
            }
        }
        req.open('GET', 'fav/' + id, true);
        req.send(null);
    });
});

function markActiveItem() {
    $("#" + activeItem).addClass("active");
}

function showPost(event) {
    obj = $(event.target).parent().find("pre");
    if (obj.attr('hidden'))
        obj.attr('hidden', false);
    else
        obj.attr('hidden', true);
}

function createPostDialog() {
    $("#modalPost").modal('show');
}

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
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
