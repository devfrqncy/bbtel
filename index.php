<?php
require_once('src/PHPBOT.php');
//require_once('src/PDO.php');
$bot = new PHPBOT('token');
$update = $bot->Update();
//$db = new PDOdb();
//$pdo = $db->connection('localhost','username','password','dbname',true);

if(!empty($update["callback_query"])){  
    if($bot->data=="button_1"){
        $btn1 = ["text"=>"Indietro","callback_data"=>"/start"];        
        $kb = [[$btn1]];
        $bot->editMessageText([
            "chat_id"=>$bot->chat_id,
            "message_id"=>$bot->message_id,
            "text"=>"Button 1 premuto",
            "parse_mode"=>"HTML",
            "disable_web_page_preview"=>"true",
            "reply_markup"=>[
                "inline_keyboard"=>$kb
            ]
        ]);
    }else if($bot->data=="button_2"){
        $bot->sendMessage([
            "chat_id"=>$bot->chat_id,
            "text"=>"Bottone 2 premuto", 
            "parse_mode"=>"HTML",
            "disable_web_page_preview"=>true
        ]);
    }else if($bot->data=="button_3"){
        $bot->sendMessage([
            "chat_id"=>$bot->chat_id,
            "text"=>"Bottone 3 premuto", 
            "parse_mode"=>"HTML",
            "disable_web_page_preview"=>true
        ]);
    }else if($bot->data=="/start"){
        $btn1 = ["text"=>"Button 1","callback_data"=>"button_1"];
        $btn2 = ["text"=>"Button 2","callback_data"=>"button_2"];
        $btn3 = ["text"=>"Button 3","callback_data"=>"button_3"];
        $kb = [[$btn1, $btn2], [$btn3]];
        $bot->editMessageText([
            "chat_id"=>$bot->chat_id,
            "message_id"=>$bot->message_id,
            "text"=>"prova",
            "parse_mode"=>"HTML",
            "disable_web_page_preview"=>"true",
            "reply_markup"=>[
                "inline_keyboard"=>$kb
            ]
        ]);
    }
}

else if(!empty($update["message"])){
    if($bot->text=="/start"){
        $btn1 = ["text"=>"Button 1","callback_data"=>"button_1"];
        $btn2 = ["text"=>"Button 2","callback_data"=>"button_2"];
        $btn3 = ["text"=>"Button 3","callback_data"=>"button_3"];
        
        
        $kb = [[$btn1, $btn2], [$btn3]];
        
        $bot->sendMessage([
            "chat_id"=>$bot->chat_id,
            "text"=>"prova", 
            "parse_mode"=>"HTML",
            "disable_web_page_preview"=>true,
            "reply_markup"=>[
                "inline_keyboard"=>$kb
            ]
        ]);
    }
    if($bot->text=="/id"){
        $bot->sendMessage([
            "chat_id"=>$bot->chat_id,
            "text"=>"L'id della chat è \n".$bot->chat_id, 
            "parse_mode"=>"HTML",
        ]);
    }    
}





//SEND UPDATE
//$bot->curl("sendMessage",["chat_id"=>$bot->chat_id,"text"=>$update]);
