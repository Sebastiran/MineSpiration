function checkpass(obj){
    passvalue = $.pwstrength(obj.value);
    switch(passvalue){
        case 0:{
                $(obj).css('background-color','#ffcccc');
                break;
        }
        case 1:{
                $(obj).css('background-color','#ffe6cc');
                break;
        }
        case 2:{
                $(obj).css('background-color','#ffffcc');
                break;
        }
        case 3:{
                $(obj).css('background-color','#e6ffcc');
                break;
        }
        case 4:{
                $(obj).css('background-color','#ccffcc');
                break;
        }
    }
}

function comparepass(obj){
    if(obj.value === $('#p1').val()){
        $(obj).css('background-color','#ccffcc');
    }
    else{
        $(obj).css('background-color','#ffcccc');
    }
}

$(document).ready(function(){
    $('#singupform').submit(function(event){
        if($.pwstrength($('#p1').val()) < 2){
            $('#popupBasic > p').html("Insecure password");
            $('#popupBasic').popup("open");
            return false;
        }
        if($('#p1').val() != $('#p2').val()){
            $('#popupBasic > p').html("Password values are not the same");
            $('#popupBasic').popup("open");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "api/signup.php",
            data: $("#singupform").serialize(),
            dataType: "json",
            success: function(data){
                if(data['type'] == 'success'){
                    $.mobile.changePage( "confirm");
                }
                else{
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
        return false;
    });
});