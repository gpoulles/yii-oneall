<?php

class OneAll extends CApplicationComponent {

  public $subdomain;  

  public $public_key;

  public $private_key;

  protected $api;  
  
  public $domain; 
 
  /**
   * @return OneAllApi
   */
  //public function getOneAllApi() {
  public function getOneAllApi() {    
      if (!$this->api) {
        $this->domain = 'https://' .$this->subdomain. '.api.oneall.com';
        //Yii::import('ext.oneall.vendors.MCAPI', true);
     
        $this->api = new oneall_curly();
        $this->api->set_option ('USERPWD', $this->public_key . ':' . $this->private_key);

        //Change to 1 to display the CURL output
        $this->api->set_option ('VERBOSE', 0);
        
        $this->api->set_subdomain ($this->domain);
        
        return $this->api;
        
    } 
  }

  
}
