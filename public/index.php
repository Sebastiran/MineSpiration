<?php
/*
 * Bijna elke url wordt doorgestuurd naar deze pagina.
 * Deze pagina kijkt welke pagina er nodig is.
 * Dit zorgt voor een nettere url.
 */

$url =  explode('/',$_GET['url']); //haal de url en een zet deze in array


if(empty($url[0])){
    $url[0] = 'home.html'; //zorg dat bij een lege url de homepagina wordt geladen.
}

$file = $url[0];

//kijk of de header bestaat, en output deze
if(file_exists('./public/header/' . $file )){
    include('./public/header/' . $file );
}
else{
    include('./public/header/default.html');
}

//kijk of de body bestaat, en output deze
if(file_exists('./public/body/' . $file )){
    include('./public/body/' . $file );
}
else{
    include('./public/body/404.html');
}

//kijk of de footer bestaat, en output deze
if(file_exists('./public/footer/' . $file )){
    include('./public/footer/' . $file );
}
else{
    include('./public/footer/default.html');
}