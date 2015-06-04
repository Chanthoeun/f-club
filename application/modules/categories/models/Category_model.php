<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category_model
 *
 * @author Chanthoeun
 */
class Category_model extends MY_Model {
    public $_table = 'category';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'caption',
            'label' => 'lang:form_cagetory_validation_caption_label',
            'rules' => 'trim|required|is_unique[category.caption]|xss_clean'
        ),
        array(
            'field' => 'parent',
            'label' => 'lang:form_cagetory_validation_parent_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        ),
        array(
            'field' => 'type',
            'label' => 'lang:form_cagetory_validation_type_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        ),
        array(
            'field' => 'display',
            'label' => 'lang:form_cagetory_validation_display_label',
            'rules' => 'trim|is_natural_no_zero|xss_clean'
        )
    );
    
    function get_dropdown($where = FALSE){
        $this->db->select($this->_table.'.id, '.$this->_table.'.caption');
        if($where != FALSE)
        {
            return parent::as_array()->get_many_by($where);
        }
        return parent::as_array()->get_all();
    }
    
    function get_list($where = FALSE)
    {
        // cache 
        $this->db->cache_on();
        
        $this->db->select($this->_table.'.id, '.$this->_table.'.caption, '.$this->_table.'.slug');
        if($where != FALSE)
        {
            return parent::as_array()->get_many_by($where);
        }
        return parent::as_array()->get_all();
    }
}
