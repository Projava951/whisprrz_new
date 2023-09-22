$(document).ready(function(){
    $('.filesubmit').click(function() {
        $('#bg_img').val('update_donation_bg');
        var $formsubmit = $(this).parents('form');
        $formsubmit.submit();
        $('#bg_img').val('');
    });

    $('.article_submit').click(function() {
        $('#art_setting').val('update_art');
        var $formsubmit = $(this).parents('form');
        $formsubmit.submit();
        $('#art_setting').val('');
    });
});