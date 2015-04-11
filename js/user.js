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
                        objLikes.parent().parent().addClass('fill');
                    } else if (req.responseText === 'dec') {
                        objLikes.text(parseInt(oldLikes) - 1);
                        objLikes.parent().parent().removeClass('fill');
                    } else {
                        objDislikes.text(parseInt(oldDislikes) - 1);
                        objDislikes.parent().parent().removeClass('fill');
                    }
                }
            }
        };
        req.open('GET', url + 'index.php/post/up/' + id, true);//TODO: remove index.php when it works
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
                        objDislikes.parent().parent().addClass('fill');
                    } else if (req.responseText === 'dec') {
                        objDislikes.text(parseInt(oldDislikes) - 1);
                        objDislikes.parent().parent().removeClass('fill');
                    } else {
                        objLikes.text(parseInt(oldLikes) - 1);
                        objLikes.parent().parent().removeClass('fill');
                    }
                }
            }
        };
        req.open('GET', url + 'index.php/post/down/' + id, true);//TODO: remove index.php when it works
        req.send(null);
    });
    $('.fav').click(function () {
        id = $(this).parent().attr('id');
        var req = getXmlHttp();
        var objFav = $(this).children('button').children('i');
        var iconFav = $(this).children('button').children('span');
        var oldFav = objFav.text();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    if (req.responseText === 'inc') {
                        objFav.text(parseInt(oldFav) + 1);
                        iconFav.removeClass('glyphicon-star-empty');
                        iconFav.addClass('glyphicon-star');
                        objFav.parent().parent().addClass('fill');
                    } else if (req.responseText === 'dec') {
                        objFav.text(parseInt(oldFav) - 1);
                        iconFav.removeClass('glyphicon-star');
                        iconFav.addClass('glyphicon-star-empty');
                        objFav.parent().parent().removeClass('fill');
                    }
                }
            }
        };
        req.open('GET', url + 'index.php/post/fav/' + id, true);//TODO: remove index.php when it works
        req.send(null);
    });
    $('.access').click(function () {
        $obj = $(this);
        idStr = $obj.parent().parent().attr('id');
        id = idStr.substr(6, idStr.length);
        var req = getXmlHttp();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    if (req.responseText === '1') {
                        $obj.removeClass('accessMail1');
                        $obj.addClass('accessMail2');
                    } else if (req.responseText === '2') {
                        $obj.removeClass('accessMail2');
                        $obj.addClass('accessMail1');
                    }
                }
            }
        };
        req.open('GET', 'accessMail/' + id, true);
        req.send(null);
    });
    $('.deleteMail').click(function () {
        $obj = $(this);
        $line = $(this).parent().parent();
        idStr = $obj.parent().parent().attr('id');
        id = idStr.substr(6, idStr.length);
        var req = getXmlHttp();
        req.onreadystatechange = function () {
            if (req.readyState === 4) {
                if (req.status === 200) {
                    if (req.responseText === 'finish') {
                        $line.css('display', 'none');
                    }
                }
            }
        };
        req.open('GET', 'deleteMail/' + id, true);
        req.send(null);
    });
    $('.btnOpenPost').click(function(){
        obj = $(this);
        id = obj.parent().parent().attr('id');
        window.open(url+'index.php/post/viewPost/'+id,'_blank');//TODO: remove index.php when it works
    });
});

function markActiveItem() {
    $("#" + activeItem).addClass("active");
}

function showPost(event) {
    obj = $(event.target).parent().find(".postBody");
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
    if (!xmlhttp && typeof XMLHttpRequest !== 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}
