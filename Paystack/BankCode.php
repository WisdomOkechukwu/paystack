<?php 

include_once "../Paystack/Paystack.php";

class BankCode extends Paystack{

    public function __construct()
    {
        
    }

    static function bankCodes()
    {
       $string = file_get_contents("../Paystack/bank/bankcode.json");
       $json_data = json_decode($string,true);

       return $json_data;
    }

    public function getBankNames()
    {
        $names = array();
        $banks = $this->bankCodes();

        foreach ($banks as $key => $value) 
        {
        
            array_push($names,$value["name"]);  
            
        }
        return $names;
    }

    public function getBankCode($bankName)
    {
        $banks = $this->bankCodes();

        foreach ($banks as $key => $value) 
        {
        
            if( $value["name"]== $bankName)
            {
                return $value["code"];
            }   
            
        }
    }
}

?>