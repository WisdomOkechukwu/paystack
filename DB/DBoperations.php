<?php 

include_once "DB.php";


class DBoperations extends DB{

    public function __construct()
    {
        
    }

    public function DBInsertion($DBconnection,$name,$email,$phone,$subaccount)
    {
        if($DBconnection->connect_error)
        {
            die("Connection Failed ".$DBconnection->connect_error);
        }

        $stmt = $DBconnection->prepare("INSERT INTO users (name, email, phone, subaccount) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $name, $email,$phone,$subaccount);
        $stmt->execute();
        $stmt->close();
        $DBconnection->close();

        return "Data Inserted";

    }
    public function DBEdit($email,$DBconnection){
        if($DBconnection->connect_error)
        {
            die("Connection Failed ".$DBconnection->connect_error);
        }
        
        $sql = "SELECT * FROM users WHERE email=$email";
        $result = $DBconnection->query($sql);

        if ($result->num_rows > 0) {
        echo "<pre>";
        var_dump($result);
        echo "</pre>";
        } else {
        echo "0 results";
}
    }
}
?>