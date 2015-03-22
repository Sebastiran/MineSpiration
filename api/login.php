<?php
session_start();
/*
	deze api kijkt of er een account bestaat met wachtwoord n en wachtwoord p
	als deze bestaat zal deze ede gebruiker inloggen, anders een melding geven.
*/

set_include_path('../engine'); //zorg dat alle includes (en requires) plaatsvinden vanuit de engine map
require_once('config.php'); //haal config.php op
require_once('user.php'); //haal de userclasse op

if(DEBUGMODE){
	$_POST = array_merge($_POST, $_GET); //als de config op debugmode staat, zorg dat 
                                             //getvariablen ook werken
}

if(isset($_SESSION['user'])){//als de user is ingelogd
    $return = array();//maak een array 
    $return['type'] = 'error';
    $return['errnr'] = '603';//6xx voor eigen foutmeldingen,
    $return['error'] = 'already logged in';
    echo json_encode($return);//echo return array in json format
    die();
}

/* Als n of p niet bestaat, geef een foutmelding */
if(isset($_POST['n'])){
    $name = htmlentities($_POST['n']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['errnr'] = '602';
    $return['error'] = 'variable missing: name';
    echo json_encode($return);
    die();
}

if(isset($_POST['p'])){
    $password = htmlentities($_POST['p']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['errnr'] = '602';
    $return['error'] = 'variable missing: password';
    echo json_encode($return);
    die();
}
/* check variables END*/

//maak een nieuw user object
$user = new user($db);
//echo de login response van het user object
echo json_encode($user->login($name, $password));