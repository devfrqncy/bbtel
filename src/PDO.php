<?php
class PDOdb extends output{
    public $bot = false;
    public $log = "";//inserisci il chat id del gruppo o canale log
    public function connection(string $host,string $username,string $password,string $databaseName,string $bot){
        $this->bot = $bot;
        $dns = "mysql:host=$host;dbname=$databaseName";
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ];
        try {
            $pdo = new PDO($dns, $username, $password, $options);
            //$this->ConsoleLog("Connessione effettuata con successo");
            return $pdo;
        } catch (Exception $e) {
            $this->Exception($e,"C'è qualcosa di strano");
        }
    }
}
class output{
    public function Exception(string $e,string $comment){
        if($this->bot==false){
            error_log($e->getMessage());
            exit($comment);
        }else{
            require_once('PHPBOT.php');
            $bot_db = new PHPBOT();
            $bot_db->sendMessage([
                "chat_id"=>$this->log,   
                "text"=>$comment    
            ]);
        }
    }
    public function ConsoleLog(string $comment){
        if($this->bot==false){
            echo "<script>console.log('" . json_encode($comment) . "');</script>";
        }else{
            require_once('PHPBOT.php');
            $bot_db = new PHPBOT();
            $bot_db->sendMessage([
                "chat_id"=>$this->log,   
                "text"=>$comment    
            ]);
        }
    }
}


/*DOCUMENTAZIONE*//*

##Update
$stmt = $pdo->prepare("UPDATE myTable SET name = :name WHERE id = :id");
$stmt->execute([':name' => 'David', ':id' => $_SESSION['id']]);
$stmt = null;

##Insert
$stmt = $pdo->prepare("INSERT INTO myTable (name, age) VALUES (?, ?)");
$stmt->execute([$_POST['name'], 29]);
$stmt = null;

##Delete
$stmt = $pdo->prepare("DELETE FROM myTable WHERE id = ?");
$stmt->execute([$_SESSION['id']]);
$stmt = null;

##Get Number of Affected Rows
$stmt = $pdo->prepare("UPDATE myTable SET name = ? WHERE id = ?");
$stmt->execute([$_POST['name'], $_SESSION['id']]);
echo $stmt->rowCount();
$stmt = null;

##Get Latest Primary Key Inserted
$stmt = $pdo->prepare("INSERT INTO myTable (name, age) VALUES (?, ?)");
$stmt->execute([$_POST['name'], 29]);
echo $pdo->lastInsertId();
$stmt = null;

##Fetch Associative Array
$stmt = $pdo->prepare("SELECT * FROM myTable WHERE id <= ?");
$stmt->execute([5]);
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(!$arr) exit('No rows');
var_export($arr);
$stmt = null;

##Fetch Single Row
$stmt = $pdo->prepare("SELECT id, name, age FROM myTable WHERE name = ?");
$stmt->execute([$_POST['name']]);
$arr = $stmt->fetch();
if(!$arr) exit('No rows');
var_export($arr);
$stmt = null;


*/
