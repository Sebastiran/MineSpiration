<?php

function sendMail($to, $mail, $subject){

ob_start();
include("mails/".$mail["filename"].".php");
$email = ob_get_contents();
ob_end_clean();

$sender = "info@minespiration.nl";
$error = "info@minespiration.nl";

// De headers samenstellen
$headers	 = "From: MineSpiration < $sender > \r\n";
$headers	.= "Reply-To: MineSpiration < $sender > \r\n";
$headers	.= "Return-Path: Mail-Error < $error > \r\n";
$headers	.= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers	.= "X-Priority: Normal \r\n";
$headers	.= "MIME-Version: 1.0 \r\n";
$headers	.= "Content-type: text/html; charset=iso-8859-1 \r\n";

	mail($to, $subject, $email, $headers);
}