<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Kenneth P. Vallejos
 * @version 1.0.0
 * 
 */
class Payment_gateway {
    
    public $Error;
    
    public function __construct() {
        echo 'Initialising Payment Gateway Class...';
        $this->Error = null;
    }
    
    public function config($params) {
        /**
         * paytype = 1 (processor) | 2 (cr/dr card)
         * processor 
         *      - email
         *      - full name
         *      - processor name
         * gateway
         *      - first name
         *      - last name
         *      - address
         *      - zip code
         *      - card number
         *      - card name
         *      - security number
         * 
         * sample code:
         *      $params['paytpe'] = 1 | 2;
         *      $params['processor'] = array('email' => 'kenn_vall@yahoo.com', 'fullname' => 'Kenneth Vallejos', 'processorname' => 'paypal');
         *      $params['gateway'] = array  (
         *                                      'firstname' => 'Kenneth',
         *                                      'lastname' => 'Vallejos',
         *                                      'address' => 'some address', // optional
         *                                      'zipcode' => '1234',
         *                                      'cardnumber' => '370000000000002',
         *                                      'cardnameholder' => 'Kenneth Vallejos',
         *                                      'securitynumber' => '101'
         *                                  );
         */
        if(empty ($params))
            return FALSE;
        
        if(!array_key_exists('paytype', $params))
            return FALSE;    
        
        if($params['paytype'] == 1) {
            if(!array_key_exists('processor', $params))
                return FALSE;
        } else if($params['paytype'] == 2) {
            if(!array_key_exists('gateway', $params))
                return FALSE;
        }
        
        // @ci_todo: check for validity of the values of the $params array.
        
        return TRUE;
    }
    
    public function validate() {
        
        // codes here for querying from the processor/payment gateway
        
        return TRUE;
    }
    
}