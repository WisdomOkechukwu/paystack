<?php
    /**
     * !Needed Variables
     * @param bizName
     * @param bank_code
     * @param account_number
     * @param percentage_charge
     * @param currency 
     * ! 0.2 = 20% = 20/100
     */


    $url = "https://api.paystack.co/subaccount";
    $fields = [
    'business_name' => "Cheese Sticks",
    'bank_code' => "058",
    'account_number' => "0137472047",
    'percentage_charge' => 0.2,
    'currency' => "USD"
    ];
    $fields_string = http_build_query($fields);
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer SECRET_KEY",
    "Cache-Control: no-cache",
    ));

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

    //execute post
    $result = curl_exec($ch);
    echo $result;

?>


<?php
  $url = "https://api.paystack.co/transaction/initialize";
  $fields = [
    'email' => "customer@email.com",
    'amount' => "20000",
    'subaccount' => "ACCT_xxxxxxxxx"
  ];
  $fields_string = http_build_query($fields);
  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer SECRET_KEY",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
  echo $result;
?>