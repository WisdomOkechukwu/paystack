<?php 
include_once("../Paystack/BankCode.php");
include_once("../Paystack/Paystack.php");
include_once("../DB/DBOperations.php");
include_once("../DB/DB.php");


$user = new BankCode();


$bank_code = $user->getBankCode($_POST['subject']);
$buisness_name = $_POST['name'];
$Account_number = $_POST['account'];
$percentage_charge = 90;

$currency = 'USD';

$subaccount = new Paystack($buisness_name,$bank_code,$Account_number,$percentage_charge,$currency);

$data  = $subaccount->Split_Initialization();

if($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    if($data['message'] == "Account number is invalid"){
        echo "Account Number Does not exsist in ". $_POST['subject'] ." database";
        exit;
    }
    if($data['message'] == "Business name is required"){
        echo "Buisness Name is Required";
        exit;
    }
    if($data['message'] == "Subaccount created"){
        echo "Successfull Created an account";
        $subaccount_code = $data['data']['subaccount_code'];
         echo "<br>".$subaccount_code;
    }


    $host = 'localhost';
    $root = 'root';
    $pass = '';
    $Name = 'paystack_split';

    $Bizname = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subaccount = $subaccount_code;

    
    $user = new DB($host,$root,$pass,$Name);

    $cons = $user->DBConnectionInitializer();


    $DBoperator = new DBoperations();

    $value = $DBoperator->DBInsertion($cons,$Bizname,$email,$phone,$subaccount);

    echo "<br>".$value;
}
else{
    echo "Please connect to the internet to perform this action";
}

   





    








?>