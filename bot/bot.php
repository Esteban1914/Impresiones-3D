<?php
    include_once "../includes/bot.php";
    $bot=new Bot();
    $update=$bot->reciveMessage();
    $message=$update["message"]['text'];
    $chatID = $update["message"]["chat"]["id"];
    $bot->sendMessage($chatID,$message);
?>
