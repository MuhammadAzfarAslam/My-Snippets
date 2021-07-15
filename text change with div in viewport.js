var windowheight = "";
var windownew = "";
var windowscroll = "";
var testi = "";
var testi2 = "";
var about = "";
var about2 = "";
var clients = "";
var clients2 = ""; 
var specialities = "";
var specialities2 = ""; 
var contact_us = "";
var contact_us2 = ""; 

jQuery(document).ready(function(){
	jQuery(".homeCaption .elementor-text-editor").html("");
});

jQuery(window).scroll(function(){
  	windowscroll = jQuery(window).scrollTop();
  	windowheight = jQuery(window).height();
  	windownew = windowheight/2;
  	// About Us
  	about = jQuery('#about_us').offset().top;
  	about2 = about - windownew;
  	// clients
  	clients = jQuery('#clients').offset().top;
  	clients2 = clients - windownew;
  	// Services
  	testi = jQuery('#services').offset().top;
  	testi2 = testi - windownew;
  	// Specialities
  	specialities = jQuery('#specialities').offset().top;
  	specialities2 = specialities - windownew
  	// contact_us
  	contact_us = jQuery('#contact_us').offset().top;
  	contact_us2 = contact_us - windownew
      if(windowscroll >= testi2 && windowscroll <= clients2){
        console.log("testi start");
        jQuery(".homeCaption .elementor-text-editor").html("");
        jQuery(".homeCaption .elementor-text-editor").html("SERVICES");
        jQuery(".homeCaption .elementor-text-editor").css('color', '#bf4136');
      }
  else if(windowscroll >= about2 && windowscroll <= testi2){
        console.log("testi start");
        jQuery(".homeCaption .elementor-text-editor").html("");
        jQuery(".homeCaption .elementor-text-editor").html("ABOUT US");
    	jQuery(".homeCaption .elementor-text-editor").css('color', '#bf4136');
      }
  else if(windowscroll >= clients2 && windowscroll <= specialities2){
        console.log("CLIENTS start");
        jQuery(".homeCaption .elementor-text-editor").html("");
        jQuery(".homeCaption .elementor-text-editor").html("CLIENTS");
    	jQuery(".homeCaption .elementor-text-editor").css('color', 'white');
      }
  else if(windowscroll >= specialities2 && windowscroll <= contact_us2){
        console.log("SPECIALITIES start");
        jQuery(".homeCaption .elementor-text-editor").html("");
        jQuery(".homeCaption .elementor-text-editor").html("SPECIALITIES");
    	jQuery(".homeCaption .elementor-text-editor").css('color', 'white');
      }
  else if(windowscroll >= contact_us2){
        console.log("CONTACT start");
        jQuery(".homeCaption .elementor-text-editor").html("");
        jQuery(".homeCaption .elementor-text-editor").html("CONTACT US");
    	jQuery(".homeCaption .elementor-text-editor").css('color', 'white');
      }
    else{
      console.log("not started yet");
      jQuery(".homeCaption .elementor-text-editor").html("");
    }
});
