<?php

echo 'hi';

$to = "troussemaa@gmail.com";
$subject = "My subject";
$txt = "Hello world2!";
$headers = "From: webmaster@example.com" . "\r\n";

if(mail($to,$subject,$txt,$headers))
{echo'good';
}
else
{
echo 'not good';	
}


?>