jQuery( document ).ready(function() {
    jQuery("i.fa.fa-bars").click(function(){
        jQuery("#mobile_menu").toggle();
    });
});


jQuery(window).resize(function(){
    if ($(window).width() <= 767) {  
        jQuery("#mobile_menu").css("display", "none");				
    }     
});

var status = document.body.classList.contains( 'logged-in' );
if(status == 'true'){
    jQuery('.menu-main ul li:last-child a').text("profile");
    jQuery('.menu-main ul li:last-child a').attr("href", "http://thebackstopgroup.perfectwebsolutions.info/profile/");
}
else{
    jQuery('.menu-main ul li:last-child a').text("sign up");
    jQuery('.menu-main ul li:last-child a').attr("href", "http://thebackstopgroup.perfectwebsolutions.info/sign-up/");
}