<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Controller
 *
 * @author marwansaleh
 */
class MY_Controller extends CI_Controller {
    public $data = array();
    
    function __construct() {
        parent::__construct();
        
        $this->data['active_menu'] = 'home';
    }
}
