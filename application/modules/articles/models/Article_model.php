<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article_model
 *
 * @author Chanthoeun
 */
class Article_model extends MY_Model {
    public $_table = 'article';
    public $protected_attributes = array( 'id');
    
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    public $validate = array(
        array(
            'field' => 'title',
            'label' => 'lang:form_article_validation_title_label',
            'rules' => 'trim|required|is_unique[article.title]|xss_clean'
        ),
        array(
            'field' => 'detail',
            'label' => 'lang:form_article_validation_detail_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'publish',
            'label' => 'lang:form_article_validation_publish_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'source',
            'label' => 'lang:form_article_validation_source_label',
            'rules' => 'trim|xss_clean'
        ),
        array(
            'field' => 'category',
            'label' => 'lang:form_article_validation_category_label',
            'rules' => 'trim|xss_clean'
        ),
    );
    
    public function get_with($where)
    {
        $this->db->select($this->_table.'.*, category.caption as catcaption');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        if(is_numeric($where))
        {
            $where = array($this->_table.'.id' => $where);
        }
        return parent::get_by($where);
    }
    
    public function get_all()
    {
        $this->db->select($this->_table.'.*, category.caption as catcaption');
        $this->db->join('category', $this->_table.'.category_id = category.id', 'left');
        return parent::get_all();
    }
    
    public function get_like($like)
    {
        $this->db->like($like);
        return $this->get_all();
    }
}
