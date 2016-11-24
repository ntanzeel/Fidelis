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
        return false;
    });

    $('.btn-cover-upload').click(function(event){
        $('#cover-upload').trigger('click');
        return false;
    });

    $('#profile-upload').change(function(){
        $('#submit-profile-pic').submit();
    });

    $('#cover-upload').change(function(){
        $('#submit-cover').submit();
    });





});