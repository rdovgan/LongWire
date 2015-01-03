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
    /* Login/Register buttons */
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
});

function printInfo(time, left, top, right, bottom) {
    $("#messageBlock").css("margin-left", left + '%');
    $("#messageBlock").css("margin-top", top + 'px');
    $("#messageBlock").css("margin-right", right + '%');
    $("#messageBlock").css("margin-bottom", bottom + '%');
    $("#messageBlock").prop("hidden", false);
}

function showMessage() {
    if($("#messageText").text()!=="")
        printInfo(5000, 20, 30);
}
//printInfo("New text", 100, 75, -24, 10);