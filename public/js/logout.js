$.ajax({
    url: "api/logout.php",
    success: function(){
        setTimeout(function(){
            $.mobile.changePage( "home", { transition: "slide", reverse: true });
        },1250);
    }
});
