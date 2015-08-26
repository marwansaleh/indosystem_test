<?php

/**
 * Description of guest_m
 *
 * @author marwansaleh
 */
class guest_m extends MY_Model {
    protected $_table_name = 'guest';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'name';
    protected $_timestamps = FALSE;
    
    public $rules = array(
            'name'  => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required'
        ),
        'address' => array(
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim'
        ),
        'phone' => array(
            'field' => 'phone',
            'label' => 'phone',
            'rules' => 'trim'
        ),
        'note' => array(
            'field' => 'note',
            'label' => 'Address',
            'rules' => 'trim'
        ),
    );
}
