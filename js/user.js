$(document).ready(function(){
    markActiveItem();
});

function markActiveItem(){
    $("#"+activeItem).addClass("active");
}

function description(event){
    obj = $(event.target).children(".postDescription");
    if(obj.attr('hidden'))
        obj.attr('hidden',false);
    else
        obj.attr('hidden',true);
}

function createPostDialog(){
    $("#modalPost").modal('show');
}