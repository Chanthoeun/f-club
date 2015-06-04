<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author Chanthoeun
 */
class Categories extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('category_model', 'category');
        $this->lang->load('category');
        
        // message
        $this->validation_errors = $this->session->flashdata('validation_errors');
        $this->data['message'] = empty($this->validation_errors['errors']) ? $this->session->flashdata('message') : $this->validation_errors['errors'];
    }
    
    public function _remap($method, $params = array())
    {   
        $get_method = str_replace('-', '_', $method);
        
        if (method_exists($this, $get_method))
        {
            return call_user_func_array(array($this, $get_method), $params);
        }
        show_404();
    }
    
    public function index()
    {
        parent::check_login();
        $this->data['categories'] = $this->get_all();
        // process template
        $title = $this->lang->line('index_cagetory_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/plugins/dataTables.bootstrap.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/plugins/dataTables/jquery.dataTables.js', 
                                        'js/plugins/dataTables/dataTables.bootstrap.js',
                                        'js/sb-admin-2.js',
                                        );
        $layout_property['script']  = '$(document).ready(function() {$(\'#dataTables-example\').dataTable();});';
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['category_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // create
    public function create()
    {
        parent::check_login();
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'placeholder'=> 'Enter caption',
            'value' => empty($this->validation_errors['post_data']['caption']) ? NULL : $this->validation_errors['post_data']['caption']
        );
        
        // process template
        $title = $this->lang->line('form_cagetory_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js'
                                        );        
        $layout_property['breadcrumb'] = array('categories' => $this->lang->line('index_cagetory_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['category_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // save
    public function store()
    {
        parent::check_login();
        $data = array(
            'caption'   => ucwords(strtolower(trim($this->input->post('caption')))),
            'slug'      => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
            'order'     => $this->get_next_order('order', array('parent_id' => trim($this->input->post('parent'))))
        );

        if(($cid = $this->insert($data)) != FALSE)
        {
            // set log
            array_unshift($data, $cid);
            set_log('Created Category', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_cagetory_report_success'));
            redirect('categories', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'categories/create');
        }
    }

    // edit
    public function edit($id)
    {
        parent::check_login();
        
        // get category
        $category = $this->get($id);
        
        $this->data['category_id'] = array('category_id' => $category->id);
        
        // display form
        $this->data['caption'] = array(
            'name'  => 'caption',
            'id'    => 'caption',
            'class' => 'form-control',
            'placeholder'=> 'Enter caption',
            'value' => empty($this->validation_errors['post_data']['caption']) ? $category->caption : $this->validation_errors['post_data']['caption']
        );
        
        // process template
        $title = $this->lang->line('form_cagetory_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js'
                                        );        
        $layout_property['breadcrumb'] = array('categories' => $this->lang->line('index_cagetory_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['setting_menu'] = TRUE; $this->data['category_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }

    // update
    public function modify()
    {
        parent::check_login();
        $id = $this->input->post('category_id');
        
        $data = array(
            'caption'   => ucwords(strtolower(trim($this->input->post('caption')))),
            'slug'      => str_replace(' ', '-', strtolower(trim($this->input->post('caption')))),
        );
        
        $this->category->validate[0]['rules'] = 'trim|required|xss_clean';

        if($this->update($id, $data))
        {
            // set log
            array_unshift($data, $id);
            set_log('Updated Category',$data);

            $this->session->set_flashdata('message', $this->lang->line('form_cagetory_report_success'));

            redirect('categories', 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'categories/edit/'.$id);
        }
    }

    // delete
    public function destroy($id)
    {
        parent::check_login();       
        $category = $this->get($id);
        
        // delete category
        if($this->delete($id))
        {
            // set log
            set_log('Deleted Category', $category);
            
            $this->session->set_flashdata('message', $this->lang->line('del_cagetory_report_success'));
            redirect('categories', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', $this->lang->line('del_cagetory_report_error'));
            redirect('categories', 'refresh');
        }
    }
    
    // activate
    public function activate($id)
    {
        parent::check_login();
        $category = $this->get($id);
        if($this->update($category->id, array('status' => 1), TRUE))
        {
            // set log
            set_log('Activated Category', array($category->id, 1));
            $this->session->set_flashdata('message', 'Category activated successful!');
            redirect('categories', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', 'Category activated unsuccessful!');
            redirect('categories', 'refresh');
        }
    }
    
    // Deactivate
    public function deactivate($id)
    {
        parent::check_login();
        $category = $this->get($id);
        if($this->update($category->id, array('status' => 0), TRUE))
        {
            // set log
            set_log('Deactivated Category', array($category->id, 0));
            $this->session->set_flashdata('message', 'Category deactivated successful!');
            redirect('categories', 'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', 'Category deactivated unsuccessful!');
            redirect('categories', 'refresh');
        }
    }
    
    public function get($id, $array = FALSE)
    {
        if($array == TRUE){
            return $this->category->as_array()->get($id);
        }
        return $this->category->as_object()->get($id);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->category->as_array()->get_by($where);
        }
        return $this->category->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->category->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->category->limit($limit, $offset);
        }
        return $this->category->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->category->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->category->limit($limit, $offset);
        }
        return $this->category->get_many_by($where);
    }
    
    public function get_dropdown($where = FALSE)
    {
        return $this->category->get_dropdown($where);
    }
    
    public function get_list($where = FALSE)
    {
        return $this->category->get_list($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->category->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->category->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->category->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->category->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->category->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->category->count_all();
    }
    
    public function count_by($where)
    {
        return $this->category->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->category->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->category->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->category->get_next_order($field, $where);
    }
}