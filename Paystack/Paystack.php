<?php 
include "../DB/DB.php";

class Paystack
{
    
    public $buisness_name;
    protected $bank_code;
    protected $Account_number;
    public $percentage_charge;
    public $currency;


    public function __construct($buisness_name,$bank_code,$Account_number,$percentage_charge,$currency)
    {
        
        $this->buisness_name = $buisness_name;
        $this->bank_code = $bank_code;
        $this->Account_number = $Account_number;
        $this->percentage_charge = $percentage_charge;
        $this->currency = $currency;

    }

    public function getterPaystackInformation()
    {
        return "<br>".$this->buisness_name."<br>".
        $this->bank_code."<br>".$this->Account_number."<br>".
        $this->percentage_charge."<br>".$this->currency;
    }
    public function Split_Initialization()
    {
        $url = "https://api.paystack.co/subaccount";
        $fields = [
        'business_name' => $this->buisness_name,
        'bank_code' => $this->bank_code,
        'account_number' => $this->Account_number,
        'percentage_charge' => $this->percentage_charge,
        'currency' => $this->currency,
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();
    
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer sk_test_b09446cac8d0dbf53da6b5a72410d90d8e49695e",
        "Cache-Control: no-cache",
        ));
    
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
        //execute post
        $result = curl_exec($ch);
        $values  = json_decode($result,true);

        return $values;
    }

    public function Spilt_Payment_initializer($email,$subaccount,$amount)
    {
        //! Add two zeros at the end becuse of the KOBO or CENTS
        
        $url = "https://api.paystack.co/transaction/initialize";
        $fields = [
          'email' => $email,
          'amount' => $amount,
          'subaccount' => $subaccount,
        ];
        $fields_string = http_build_query($fields);
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Authorization: Bearer sk_test_b09446cac8d0dbf53da6b5a72410d90d8e49695e",
          "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        $initialize_data = json_decode($result);
        $ini_url =  $initialize_data->data->authorization_url;
        if($result){
            header("location:".$ini_url);
        }
    }

    public function  Paystack_Basic_Payment(){

    }


}




?>