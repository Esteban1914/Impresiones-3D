<?php
$token="6949146329:AAFLTxfxEjZMxmhXUot4UKRv3FoRtOZb1f8";
$path="https://api.telegram.org/bot".$token;

$update=json_decode(file_get_contents("php://input"),true);
$message=$update["message"]['text'];
$chatId = $update["message"]["chat"]["id"];

file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Hola Mundo");

?>
