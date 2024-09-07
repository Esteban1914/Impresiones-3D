<?php
include_once "session.php";
class DB extends Session
{
    private $host,$db,$user,$password,$charset;
    protected $session;
    
    
    public static function get_env() {
        $path = __DIR__ . "/../.env";
        if (!file_exists($path)) {
            die ("No .env file");
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $array = [];

        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            $array[$key] = $value;
        }
        return $array;
    }
    public function __construct()
    {

        parent::__construct();
        $env = $this->get_env();
        $this->host = $env['DB_HOST'];
        $this->db = $env["DB_NAME"];
        $this->user = $env['DB_USER'];
        $this->password = $env['DB_PASS'];
        if($this->password==" ")
            $this->password="";
        $this->charset='utf8mb4';
        
    }
    public static function log($message)
    {
        error_log("\n".$message,3,"/var/log/apache2/myerror.log");
    }
    public function connect()
    {
        try{
            $connection="mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $options=[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false];
            return new PDO($connection,$this->user,$this->password,$options);
        }catch(PDOException $e){
            print_r("ERROR Connection:".$e->getMessage());
            exit;
        }
    }
    
    
}
?>