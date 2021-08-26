<?php 
include_once("../Paystack/Paystack.php");
include_once("../DB/DBOperations.php");
include_once("../DB/DB.php");

$bank_code = "";
$buisness_name = "";
$Account_number = "";
$percentage_charge = 90;

$currency = 'USD';

$email = $_POST['email'];
$subaccount = new Paystack($buisness_name,$bank_code,$Account_number,$percentage_charge,$currency);
// ghvk

$host = 'localhost';
$root = 'root';
$pass = '';
$Name = 'paystack_split';

$user = new DB($host,$root,$pass,$Name);

$cons = $user->DBConnectionInitializer();


$DBoperator = new DBoperations();

$result = array();
$sql = "SELECT * FROM users WHERE id = 4";
$result = $cons->query($sql);
$row = $result->fetch_assoc();

$subaccounted = $row['subaccount'];
echo $subaccounted;

$emailed = $row['email'];
echo $emailed;

$amount_split = 4000000;
$data_value = $subaccount->Spilt_Payment_initializer($emailed,$subaccounted,$amount_split);
               
if($data_value){
    echo "<pre>";
    print_r($data_value);
    echo "</pre>";
}   




?>