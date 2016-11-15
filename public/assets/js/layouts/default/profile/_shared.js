$(document).ready(function(){

    $('.profile-photo-container').hover(function(){
        $('.btn-upload').css('visibility', 'visible');
    });

    $('.profile-photo-container').mouseleave(function(){
        $('.btn-upload').css('visibility', 'hidden');
    });

    $('.btn-upload').click(function(event){
       $('#imgupload').trigger('click');
    });


});