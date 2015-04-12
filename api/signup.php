<?php

set_include_path('../engine');
require_once('config.php');
require_once('model/user.php');

if(DEBUGMODE){
    $_POST = array_merge($_POST, $_GET);
}

if(isset($_SESSION['user'])){
    $return = array();
    $return['type'] = 'error';
    $return['error'] = 'already logged in';
    echo json_encode($return);
    die();
}

if(isset($_POST['e'])){
    $email = htmlentities($_POST['e']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['error'] = 'variable missing: email';
    echo json_encode($return);
    die();
}

if(isset($_POST['n'])){
    $name = htmlentities($_POST['n']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['error'] = 'variable missing: name';
    echo json_encode($return);
    die();
}
if(isset($_POST['p1'])){
    $password1 = htmlentities($_POST['p1']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['error'] = 'variable missing: password1';
    echo json_encode($return);
    die();
}

if(isset($_POST['p2'])){
    $password2 = htmlentities($_POST['p2']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['error'] = 'variable missing: password2';
    echo json_encode($return);
    die();
}

if(isset($_POST['b'])){
    $birthday = htmlentities($_POST['b']);
}
else{
    $birthday = date("Y-m-d H:i:s",0);
}

if(isset($_POST['c'])){
    $country = htmlentities($_POST['c']);
}
else{
    $country = "unknown";
}

if(isset($_POST['g'])){
    $ign = htmlentities($_POST['g']);
}
else{
    $ign = "unknown";
}

if(isset($_POST['s']) && ( $_POST['s'] == "u" || $_POST['s'] == "f" || $_POST['s'] == "m" || $_POST['s'] == "o"  )){
    $ign = htmlentities($_POST['s']);
}
else{
    $ign = "u";
}

if($password1 !== $password2){
    $return = array();
    $return['type'] = 'error';
    $return['error'] = 'passwords not matching';
    echo json_encode($return);
    die();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $return = array();
    $return['type'] = 'error';
    $return['error'] = 'false email format';
    echo json_encode($return);
    die();
}

$user = new User($db);

echo json_encode($_POST);