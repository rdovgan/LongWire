$(document).ready(function () {
    var headerContentHeight = $(".content").offset().top - $("#menu").height();
    var headerMenuHeight = $("#header").height();

    $(window).scroll(function () {
        if (($(window).scrollTop() > headerMenuHeight) && (!$("#invBtns").hasClass('open'))) {
            $("#invBtns").animate({
                left: 0
            }, 500).addClass('open');
        } else if (($(window).scrollTop() <= headerMenuHeight) && ($("#invBtns").hasClass('open'))) {
            $("#invBtns").animate({
                left: '360px'
            }, 500).removeClass('open');
        }
        if ($(window).scrollTop() > headerContentHeight) {
            $('#menu').css({position: 'fixed', top: '0px'});
            $('.content').css({'margin-top': '50px'});
        } else {
            $('#menu').css({position: 'static'});
            $('.content').css({'margin-top': '0px'});
        }
    });
    /* Buttons with modals */
    $(".btnLogin").click(function () {
        $("#modalLogin").modal('show');
    });
    $(".btnRegister").click(function () {
        $("#modalRegister").modal('show');
    });
    /* Close message block */
    $("button.close").click(function () {
        $(this).parent().prop("hidden", true);
    });
    /* Focus first text field on modal show */
    $('#modalLogin').on('shown.bs.modal', function () {
        $('#loginName').focus();
    });
    $('#modalRegister').on('shown.bs.modal', function () {
        $('#registerName').focus();
    });
    showMessage();
    showModalOption();
    //hide ADV
//    setTimeout(function () {
//        $("#ho_adv").css("height", "0px");
//    },1000);
});

function printInfo(time, left, top, width, height) {
    $("#messageBlock").css("margin-left", left + '%');
    $("#messageBlock").css("margin-top", top + 'px');
    $("#messageBlock").css("min-width", width + 'px');
    $("#messageBlock").css("min-height", height + 'px');
    $("#messageBlock").prop("hidden", false);
    $('#messageBlock').fadeIn().delay(time).fadeOut('slow');
//    setTimeout(function () {
//        messageClear();
//    }, time+5000);
}

function showMessage() {
    if ($("#messageText").text() !== "")
        printInfo(2000, 70, 0, 200, 100);
}

function messageClear() {
    $("#messageBlock").text('');
    $("#messageBlock").prop("hidden", true);
}

function showModalOption() {
    if (option === 'login') {
        $("#modalLogin").modal('show');
    } else if (option === 'register') {
        $("#modalRegister").modal('show');
    }
}

$(function () {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
});

function createPostDialog() {
    $("#modalPost").modal('show');
}