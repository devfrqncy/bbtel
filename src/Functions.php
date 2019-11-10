<?php
class Functions{
  public function sendChatAction(array $data){
    return $this->curl("sendChatAction",$data);
    /*
    "typing"=> text messages,
    "upload_photo"=> photos,
    "record_video" or "upload_video"=> videos,
    "record_audio" or "upload_audio"=> audio files,
    "upload_document"=> general files,
    "find_location"=> location data,
    "record_video_note" or "upload_video_note"=> video notes.*/
  }
  public function sendMessage(array $data){
    $this->sendChatAction(["chat_id"=>$data["chat_id"],"action"=>"typing"]);
    return $this->curl("sendMessage",$data);
  }
  public function editMessageText(array $data){
    return $this->curl("editMessageText",$data);
  }
  public function answerCallbackQuery(array $data){
    return $this->curl("answerCallbackQuery",$data);//["callback_query_id"=>$cqid, "text"=>$text]
  }
  public function forwardMessage(array $data){
    return $this->curl("forwardMessage",$data);//["chat_id"=>$chatid, "from_chat_id"=>$from_chat_id, "message_id"=>$msgid]
  }
  public function sendPhoto(array $data){
    $this->sendChatAction(["chat_id"=>$data["chat_id"],"action"=>"upload_photo"]);
    return $this->curl("sendPhoto",$data);
  }
  public function sendSticker(array $data){
    $this->sendChatAction(["chat_id"=>$data["chat_id"],"action"=>"typing"]);
    return $this->curl("sendSticker",$data);
  }
  public function deleteMessage(array $data){
    return $this->curl("deleteMessage",$data);//["chat_id"=>$chatid, "message_id"=>$msgid]
  }
  public function getChat(array $data,string $chat_id){
    $get = $this->curl("getChat",$data);
    $this->sendMessage([
      "chat_id"=>$chat_id,
      "text"=>$get,
      "parse_mode"=>"HTML"
    ]);
  }
}
/*DOCUMENTAZIONE*//*

-----sendMessage-----
$bot->sendMessage([
  "chat_id"=>$chatid,   //destinatario
  "text"=>$text,        //messaggio da inviare
  "parse_mode"=>"HTML", //HTML o Markdown
  "reply_markup"=>[     //Tastiera
    "inline_keyboard"=>$kb  //Inline o "Keyboard" non inline
    ],
  "disable_web_page_preview"=>true //anteprima disabilitata
]);
-----------------

-----editMessageText-----
$bot->editMessageText([
  "chat_id"=>$chatid,
  "message_id"=>$msgid, 
  "text"=>$text, 
  "parse_mode"=>"HTML", 
  "disable_web_page_preview"=>true, 
  "reply_markup"=>[
    "keyboard"=>$kb,
    "resize_keyboard"=>true, //aggiorna la tastiera
  ]]);
-----------------

-----getChat-----
$bot->getChat(["chat_id"=>{ID DELLA CHAT}],$bot->chat_id);
-----------------


*/