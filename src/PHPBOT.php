<?php
require_once("Methods.php");
class PHPBOT extends Methods{
  private $token = "";

  public function __construct(string $token) {
    $this->token=$token;
  }
  public function Update(){
    $update = json_decode(file_get_contents('php://input'), true);
    if(!empty($update["message"])){
      $this->message_id = $update['message']['message_id'];
      $this->from_id = $update['message']['from']['id'];
      $this->from_first_name = $update['message']['from']['first_name'];
      $this->from_username = $update['message']['from']['username'];
      $this->chat_id = $update['message']['chat']['id'];
      $this->chat_type = $update['message']['chat']['type'];
      if($this->chat_type=="private"){
        $this->chat_first_name = $update['message']['chat']['first_name'];
        $this->chat_username = $update['message']['chat']['username'];
      }else if($this->chat_type=="group"){
        $this->chat_tile = $update['message']['chat']['title'];
      }else if($this->chat_type=="supergroup"){
        $this->chat_username = $update['message']['chat']['username'];
        $this->chat_tile = $update['message']['chat']['title'];
      }else if($this->chat_type=="channel"){
        $this->chat_username = $update['message']['chat']['username'];
        $this->chat_tile = $update['message']['chat']['title'];
      }
      $this->date = $update['message']['date'];
      $this->text = $update["message"]["text"];
    }else if(!empty($update["callback_query"])){
      $this->from_id = $update['callback_query']['from']['id'];
      $this->from_username = $update['callback_query']['from']['username'];
      $this->message_id = $update['callback_query']["message"]['message_id'];
      $this->chat_id = $update['callback_query']['message']['chat']['id'];
      $this->chat_type = $update['callback_query']['message']['chat']['type'];
      if($this->chat_type=="private"){
        $this->chat_first_name = $update['callback_query']['message']['chat']['first_name'];
        $this->chat_username = $update['callback_query']['message']['chat']['username'];
      }else if($this->chat_type=="group"){
        $this->chat_tile = $update['callback_query']['message']['chat']['title'];
      }else if($this->chat_type=="supergroup"){
        $this->chat_username = $update['callback_query']['message']['chat']['username'];
        $this->chat_tile = $update['callback_query']['message']['chat']['title'];
      }else if($this->chat_type=="channel"){
        $this->chat_username = $update['callback_query']['message']['chat']['username'];
        $this->chat_tile = $update['callback_query']['message']['chat']['title'];
      }
      $this->date = $update["callback_query"]['message']['date'];
      $this->data = $update["callback_query"]["data"];
    }
    return $update;
  }
  public function curl(string $method,array $data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$this->token."/$method");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
  }
}