<?php
    include_once "../includes/bot.php";
    //header('Content-Type: application/json');
    $bot=new Bot();
    // $response=$bot->sendCommand("deleteWebhook");
    // echo json_encode([$response])."<br>"; 
    // $response=$bot->sendCommand("setWebhook?url=".getenv('DB_DOMINIE')."/impresiones3d/bot/bot.php");
    // echo json_encode([$response])."<br>"; 

    // $data = [
    //     'commands' => [
    //         [
    //             'command' => 'Command 1',
    //             'description' => 'Command 1 Description.'
    //         ],
    //         [
    //             'command' => 'Command 2',
    //             'description' => 'Command 2 Description.'
    //         ]
    //     ],
    //     'scope' => ["type" => "all_private_chats"],
    //     'language_code' => "en"
    // ];
    
    // $options = [
    // 'http' => [
    //     'header' => "Content-type: application/json\r\n",
    //     'method' => 'GET',
    //     'content' => json_encode($data),
    // ],
    // ];

    // $context = stream_context_create($options);

    // $response=$bot->sendCommandJson("setMyCommands",$context);
    // echo json_encode([$response])."<br>";
?>