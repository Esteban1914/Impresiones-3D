<?php
class DB
{
    private $host,$db,$user,$password,$charset;

    public function __construct()
    {
        $this->host=getenv('DB_HOST');
        $this->db="impresiones3D";
        $this->user=getenv('DB_USER');
        $this->password=getenv('DB_PASSWORD');
        if($this->password==" ")
            $this->password="";
        $this->charset='utf8mb4';
        if(session_status() === PHP_SESSION_NONE) 
            session_start();

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