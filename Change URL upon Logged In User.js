// Check Body Class if User is logged in
var status = document.body.classList.contains( 'logged-in' );

if(status == 'true'){    // If Logged In then
    jQuery('.menu-main ul li:last-child a').text("profile");
    jQuery('.menu-main ul li:last-child a').attr("href", "www.google.com");
}
else{                   // If user is not Logged In Then
    jQuery('.menu-main ul li:last-child a').text("sign up");
    jQuery('.menu-main ul li:last-child a').attr("href", "www.yahoo.com");
}