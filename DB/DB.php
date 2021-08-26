<?php 
 class DB{
     protected $DBhost;
     protected $DBroot;
     protected $DBpass;
     protected $DBName;

     public function __construct($DBhost,$DBroot,$DBpass,$DBName)
     {
        $this->DBhost = $DBhost;
        $this->DBroot = $DBroot;
        $this->DBpass = $DBpass;
        $this->DBName = $DBName;
     }

     public function DBConnectionInitializer()
     {
        $conn = new mysqli($this->DBhost,$this->DBroot,$this->DBpass,$this->DBName);
        return $conn;
        
     }


 }

    $host = 'localhost';
    $root = 'root';
    $pass = '';
    $Name = 'paystack_split';

    
    $user = new DB($host,$root,$pass,$Name);

    $cons = $user->DBConnectionInitializer();

    if($cons->connect_error){
        die("Not Connected Please Check Server ".$cons->connect_error);
    }
    // else{
    //     echo "connected";
    // }

?>