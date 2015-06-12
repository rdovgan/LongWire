hamburger = 0;
$(document).ready(function () {
    var headerMenuHeight = $("#header").height();
    var headerContentHeight = $(".content").offset().top - $("#menu").height();
    $(window).scroll(function () {
        if (($(window).scrollTop() > headerMenuHeight) && (!$("#invBtns").hasClass('fadeInRightBig'))) {
            $("#invBtns").removeClass('fadeOutRightBig');
            $("#invBtns").css("display", "block");
            $("#invBtns").addClass('fadeInRightBig');
        } else if (($(window).scrollTop() <= headerMenuHeight) && ($("#invBtns").hasClass('fadeInRightBig'))) {
            $("#invBtns").removeClass('fadeInRightBig');
            $("#invBtns").addClass('fadeOutRightBig');
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
    $("#hiddenHamburger").click(function () {
        $("#navbarItems").css("display", "block");
        $("#hiddenHamburger").css("display", "none");
        hamburger = 1;
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
$(function () {
    $(document).click(function (event) {
        if (($(event.target).closest("#mainMenu").length) || (hamburger === 0))
            return;
        $("#navbarItems").css("display", "");
        $("#hiddenHamburger").css("display", "");
        hamburger = 0;
        event.stopPropagation();
    });
});