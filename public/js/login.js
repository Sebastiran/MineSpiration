sessionValid(function(){window.location = "profile"});
$(document).ready(function(){
    $('#loginform').submit(function(event){
        $.ajax({
            type: "POST",
            url: "api/login.php",
            data: $("#loginform").serialize(),
            dataType: "json",
            success: function(data){
                if(data['type'] == 'succces'){
                    window.location('profile');
                }
                else{
                    //@todo proper handling handling
                    $('#popupBasic > p').html(data['mess']);
                    $('#popupBasic').popup("open");
                }
            },
            error: function(data){
                //@todo errorhandling
            }
        });
        return false;
    });
});

function sessionValid(trueback, falseback){
    $.ajax({
        type: "POST",
        url: "api/checkSession.php",
        dataType: "json",
        success: function(data){
            if(data[0]){
                if(trueback != undefined){
                    trueback();
                }
            }
            else{
                if(falseback != undefined){
                    falseback();
                }
            }
        },
        error: function(){
            return false;
        }
    });
}