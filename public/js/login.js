//check of de user al is ingelogd
sessionValid(function(){
    $.mobile.changePage( "home");
});

$(document).ready(function(){//Als het document is geladen
    $('#loginform').submit(function(event){//als er op de submitknop wordt gedrukt
        $.ajax({//ga met een ajax-call...
            type: "POST",
            url: "api/login.php",//naar login.php
            data: $("#loginform").serialize(),//gebruik de data van #loginform
            dataType: "json",//verwacht een JSON response
            success: function(data){ //als je een succesvolle response krijgt (http 200)
                if(data['type'] == 'success'){//en het type = success (dus ingelogd)
                    $.mobile.changePage( "profile");//ga naar de profielpagina
                }
                else{//als het een ander type is geef foutmelding
                    //@todo proper handling handling
                    $('#popupBasic > p').html(data['mess']);
                    $('#popupBasic').popup("open");
                }
            },//bij een http die geen 200 is, doe niets (dit moet nog worden uitgebreid, 
            //waarschijnlijk naar en foutlog ofzo)
            error: function(data){
                //@todo errorhandling
            }
        });
        return false; // Dit zorgt ervoor dat de webpagina niet wordt herladen op submit
    });
});


function sessionValid(trueback, falseback){
    //Ajax doet een asynchrone request naar de sever
    $.ajax({
        type: "POST", //type post is veiliger
        url: "api/checkSession.php", //checksession.php kijk of er een session is
        dataType: "json",
        success: function(data){
            if(data[0]){ //als de true word gegeven, voor de function trueback 
                         //uit,voer anders falseback uit. (mits deze opgegeven zijn)
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
            if(falseback != undefined){
                falseback();
            }
        }
    });
}