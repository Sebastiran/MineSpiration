$.ajax({
    url: "api/logout.php",
    success: function(){
        setTimeout(function(){
            $.mobile.changePage( "home.html", { transition: "slide", reverse: true });
        },1250);
    }
});
