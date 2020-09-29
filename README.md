# bbtel
Simple basis for Telegram bots in php
#PHP7 #PDO #Telegram

## Download or Clone

Use git to clone repository or [download here](https://github.com/devfrqncy/bbtel/archive/master.zip).

```bash
git clone https://github.com/devfrqncy/bbtel.git
```

## Installation

Sets the WebHook editing this File: [setwebhook.php](https://github.com/devfrqncy/bbtel/blob/master/setwebhook.php)
```php
$WEBHOOK_URL = 'https://url/index.php';  //write url of index.php (must be HTTPS)
$BOT_TOKEN = '910434493:AAFm0b68g-OaXLCVHgp4L4ASnqVdq_tOrA7';  //write your bot token
```
After open with your browser on the page setwebhooks.php hosted on your web server
If you did everything correctly, you should have this result


![Browser Result](https://xpcommunity.it/bot/bbtel/img/setwebhook.PNG)

## Usage
Now you can start

Import PHPBOT class
Edit File: [index.php](https://github.com/devfrqncy/bbtel/blob/master/index.php)

```php
require_once('src/PHPBOT.php');
$bot = new PHPBOT('910434493:AAFm0b68g-OaXLCVHgp4L4ASnqVdq_tOrA7'); //write your bot token
```

Write here the answers of the bot based on the message or callback_query it receives

Example:

```php
if(!empty($update["message"])){
  if($bot->text=="/start"){
//      ....response...
  }
}
else if(!empty($update["callback_query"])){  
   if($bot->data=="example"){
//     ....response....
   }
}
```

*sendMessage* [telegram api](https://core.telegram.org/bots/api#sendmessage)

Example:

```php
$btn1 = ["text"=>"Button 1","callback_data"=>"button_1"];
$btn2 = ["text"=>"Button 2","callback_data"=>"button_2"];
$btn3 = ["text"=>"Button 3","callback_data"=>"button_3"];

$kb = [[$btn1, $btn2], [$btn3]];

$bot->sendMessage([
  "chat_id"=>$bot->chat_id,
  "text"=>"Example", 
  "parse_mode"=>"HTML",
  "disable_web_page_preview"=>true,
  "reply_markup"=>[
    "inline_keyboard"=>$kb
   ]
]);
```

*editMessageText* [telegram api](https://core.telegram.org/bots/api#editmessagetext)

Example:

```php
$bot->editMessageText([
  "chat_id"=>$bot->chat_id,
  "message_id"=>$bot->message_id,
  "text"=>"Edit example",
  "parse_mode"=>"HTML",
  "disable_web_page_preview"=>true,
]);

```

In [Functions.php](https://github.com/devfrqncy/bbtel/blob/master/src/Functions.php) there are the main functions of the telegram API


## License
[MIT](https://choosealicense.com/licenses/mit/)
