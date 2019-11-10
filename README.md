# bbtel
Simple base for telegram bots in php
#PHP7 #PDO #Telegram

## Installation

Use git to clone repository.

```bash
git clone https://github.com/devfrqncy/bbtel.git
```

## Usage

Sets the WebHook editing this File: [setwebhook.php](https://github.com/devfrqncy/bbtel/blob/master/setwebhook.php)
```php
$WEBHOOK_URL = 'https://url/index.php';  //write url of index.php (must be HTTPS)
$BOT_TOKEN = '910434493:AAFm0b68g-OaXLCVHgp4L4ASnqVdq_tOrA7';  //write your bot token
```
After open with your browser on the page setwebhooks.php hosted on your web server
If you did everything correctly, you should have this result


![Browser Result](https://xpcommunity.it/bot/bbtel/img/setwebhook.PNG)

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



## License
[MIT](https://choosealicense.com/licenses/mit/)
