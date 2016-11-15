$(document).ready(function(){

    $('.profile-photo-container').hover(function(){
        $('.btn-upload').css('visibility', 'visible');
    });

    $('.profile-photo-container').mouseleave(function(){
        $('.btn-upload').css('visibility', 'hidden');
    });

    $('.profile-cover').hover(function(){
        $('.btn-cover-upload').css('visibility', 'visible');
    });

    $('.profile-cover').mouseleave(function(){
        $('.btn-cover-upload').css('visibility', 'hidden');
    });

    $('.btn-upload').click(function(event){
       $('#profile-upload').trigger('click');
    });

    $('.btn-cover-upload').click(function(event){
        $('#cover-upload').trigger('click');
    });


});