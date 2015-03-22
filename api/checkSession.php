<?php
session_start();//zorg dat php de sessies kan bekijken
if(isset($_SESSION['user'])){//als de user sessie bestaat met de meegekregen sessiecookie (gaat automatich)
    echo "[true]";  //laat true zien in JSON format
}
else{ 
    echo "[false]"; //laat false zien in JSON format
}