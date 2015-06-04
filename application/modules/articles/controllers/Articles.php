<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of article
 *
 * @author Chanthoeun
 */
class Articles extends Admin_Controller {
    public  $validation_errors =  array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('article_model', 'article');
        $this->lang->load('article');
        
        $this->load->library('upload');
        $this->load->helper('menu');
        $this->load->helper('video');
        
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
        $this->data['articles'] = $this->get_all(array('created_at' => 'desc'), 100);
        
        // process template
        $title = $this->lang->line('index_article_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/plugins/dataTables.bootstrap.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/plugins/dataTables/jquery.dataTables.js', 
                                        'js/plugins/dataTables/dataTables.bootstrap.js',
                                        'js/sb-admin-2.js'
                                        );
        $layout_property['script']  = '$(document).ready(function() {$(\'#dataTables-example\').dataTable({"aaSorting": [[0, "desc"]]});});';
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']  = 'index';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // create
    public function create()
    {
        parent::check_login();
        
        // display form
        $this->data['article_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'placeholder'=> 'Enter article title',
            'value' => empty($this->validation_errors['post_data']['title']) ? NULL : $this->validation_errors['post_data']['title']
        );
        
        $this->data['detail'] = array(
            'name'  => 'detail',
            'id'    => 'detail',
            'class' => 'form-control',
            'placeholder'=> 'Enter article detail',
            'value' => empty($this->validation_errors['post_data']['detail']) ? NULL : $this->validation_errors['post_data']['detail']
        );
        
        $this->data['publish'] = array(
            'name'  => 'publish',
            'id'    => 'publish',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'placeholder'=> 'Select publish date',
            'value' => empty($this->validation_errors['post_data']['publish']) ? NULL : $this->validation_errors['post_data']['publish']
        );
        
        $this->data['source'] = array(
            'name'  => 'source',
            'id'    => 'source',
            'class' => 'form-control',
            'placeholder'=> 'Enter article source',
            'value' => empty($this->validation_errors['post_data']['source']) ? NULL : $this->validation_errors['post_data']['source']
        );
        
        
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id', 'caption', '--- Select Category ---'), empty($this->validation_errors['post_data']['category']) ? NULL : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        // process template
        $title = $this->lang->line('form_article_create_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        $layout_property['script'] = '$(\'#publish\').datepicker()';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'create';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['create_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // save
    public function store()
    {
        parent::check_login();
        $this->load->helper('video');
        $data = array(
            'title'     => trim($this->input->post('title')),
            'slug'      => url_title($this->input->post('title'), '-', TRUE),
            'detail'    => $this->input->post('detail'),
            'published_on'  => $this->input->post('publish'),
            'source'    => $this->input->post('source'),
            'category_id' => $this->input->post('category')
        );
        
        if(($aid = $this->insert($data)) != FALSE)
        {                
            // set log
            array_unshift($data, $aid);
            set_log('Created Article', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_article_report_success'));
            redirect('articles/view/'.$aid, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'articles/create');
        }
    }


    // edit
    public function edit($id)
    {
        parent::check_login();
        $article = $this->get($id);
        $this->data['article_id'] = array('article_id' => $article->id);
        $this->data['article'] = $article;
        
        // display form
        $this->data['article_title'] = array(
            'name'  => 'title',
            'id'    => 'title',
            'class' => 'form-control',
            'placeholder'=> 'Enter article title',
            'value' => empty($this->validation_errors['post_data']['title']) ? $article->title : $this->validation_errors['post_data']['title']
        );
        
        $this->data['publish'] = array(
            'name'  => 'publish',
            'id'    => 'publish',
            'class' => 'form-control',
            'data-date-format' => 'yyyy-mm-dd',
            'data-date' => date('Y-m-d'),
            'placeholder'=> 'Select publish date',
            'value' => empty($this->validation_errors['post_data']['publish']) ? $article->published_on : $this->validation_errors['post_data']['publish']
        );
        
        $this->data['source'] = array(
            'name'  => 'source',
            'id'    => 'source',
            'class' => 'form-control',
            'placeholder'=> 'Enter article source',
            'value' => empty($this->validation_errors['post_data']['source']) ? utf8_decode($article->source) : $this->validation_errors['post_data']['source']
        );
        
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id', 'caption', '--- Select Category ---'), empty($this->validation_errors['post_data']['category']) ? $article->category_id : $this->validation_errors['post_data']['category'], 'class="form-control" id="category"');
        
        // process template
        $title = $this->lang->line('form_article_edit_heading');
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/datepicker.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/bootstrap-datepicker.min.js'
                                        );
        $layout_property['optional_js'] = base_url('assets/ckeditor/ckeditor.js');
        $layout_property['script'] = '$(\'#publish\').datepicker()';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'edit';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }


    // update
    public function modify()
    {
        parent::check_login();
        $id = trim($this->input->post('article_id'));
        $data = array(
            'title'     => trim($this->input->post('title')),
            'slug'      => url_title($this->input->post('title'), '-', TRUE),
            'detail'    => $this->input->post('detail'),
            'published_on'  => $this->input->post('publish'),
            'source'    => trim($this->input->post('source')),
            'category_id' => $this->input->post('category')
        );
        
        $this->article->validate[0]['rules'] = 'trim|required|xss_clean';
        if($this->update($id, $data) != FALSE)
        {                
            // set log
            array_unshift($data, $id);
            set_log('Updated Article', $data);

            $this->session->set_flashdata('message', $this->lang->line('form_article_report_success'));
            redirect('articles/view/'.$id, 'refresh');
        }
        else
        {
            redirect_form_validation(validation_errors(), $this->input->post(), 'articles/edit/'.$id);
        }
    }


    // view
    public function view($id)
    {
        parent::check_login();
        $article = $this->get_with($id);
        $this->data['article'] = $article;
        
        // process template
        $title = $article->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css',
                                        'css/colorbox/colorbox.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/sb-admin-2.js',
                                        'js/jquery.colorbox.min.js'
                                        );
        $layout_property['script'] = '$(document).ready(function(){$(".color-box").colorbox({rel:"color-box",transition:"fade"})});';
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'view';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['recently_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }

    // delete
    public function destroy($id)
    {
         parent::check_login();
        $article = $this->get($id);
        
        // delete article
        if($this->delete($id))
        {
            
            // set log
            set_log('Deleted Article', $article);
            
            $this->session->set_flashdata('message', $this->lang->line('del_article_report_success'));   
        }
        else
        {            
            $this->session->set_flashdata('message', $this->lang->line('del_article_report_error'));
        }
        redirect('articles', 'refresh');
    }
    
    public function search()
    {
        parent::check_login();
        $this->form_validation->set_rules('search', 'Search', 'trim|required|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('search'));
            $this->data['articles'] = $this->get_like(array('title' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['search'] = array(
            'name'  => 'search',
            'id'    => 'search',
            'class' => 'form-control',
            'style' => 'width: 700px;',
            'placeholder' => 'Search article title',
            'value' => set_value('search')
        );
        
        // process template
        $title = 'Search Article';
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/plugins/dataTables.bootstrap.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/plugins/dataTables/jquery.dataTables.js', 
                                        'js/plugins/dataTables/dataTables.bootstrap.js',
                                        'js/sb-admin-2.js'
                                        );
        $layout_property['script']  = '$(document).ready(function() {$(\'#dataTables-example\').dataTable({"aaSorting": [[0, "desc"]]});});';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'search';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['search_menu'] = TRUE;
        generate_template($this->data, $layout_property); 
    }
    
    public function filter_by_category()
    {
        parent::check_login();
        $this->form_validation->set_rules('category', 'Article Category', 'trim|required|xss_clean');
        if($this->form_validation->run() == TRUE)
        {
            $search = trim($this->input->post('category'));
            $this->data['articles'] = $this->get_many_by(array('category_id' => $search)); 
        }
        
        // message error
        $this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
        
        $this->data['category'] = form_dropdown('category', Modules::run('categories/dropdown', 'id', 'caption', '--- Select Category ---'), set_value('category'), 'class="form-control" id="category"');
        
        // process template
        $title = 'Filter Article by Category';
        $this->data['title'] = $title;
        $layout_property['css'] = array('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' => FALSE,
                                        'css/plugins/metisMenu/metisMenu.min.css',
                                        'css/plugins/dataTables.bootstrap.css',
                                        'css/sb-admin-2.css',
                                        'font-awesome-4.1.0/css/font-awesome.min.css'
                                        );
        $layout_property['js']  = array('https://code.jquery.com/jquery-1.11.1.min.js' => FALSE,
                                        'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js' => FALSE,
                                        'js/plugins/metisMenu/metisMenu.min.js',
                                        'js/plugins/dataTables/jquery.dataTables.js', 
                                        'js/plugins/dataTables/dataTables.bootstrap.js',
                                        'js/sb-admin-2.js'
                                        );
        $layout_property['script']  = '$(document).ready(function() {$(\'#dataTables-example\').dataTable({"aaSorting": [[0, "desc"]]});});';
        
        $layout_property['breadcrumb'] = array('articles' => $this->lang->line('index_article_heading'), $title);
        
        $layout_property['content']  = 'filter_by_category';
        
        // menu
        $this->data['article_group_menu'] = TRUE; $this->data['filter_category_menu'] = TRUE;
        generate_template($this->data, $layout_property);
    }
    
    public function get($id)
    {
        return $this->article->as_object()->get($id);
    }
    
    public function get_with($where)
    {
        return $this->article->get_with($where);
    }
    
    public function get_by($where, $array = FALSE)
    {
        if($array == TRUE){
            return $this->article->as_array()->get_by($where);
        }
        return $this->article->as_object()->get_by($where);
    }
    
    public function get_all($order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->article->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article->limit($limit, $offset);
        }
        
        return $this->article->get_all();
    }
    
    public function get_many_by($where, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article->limit($limit, $offset);
        }
        
        return $this->article->get_many_by($where);
    }
    
    public function insert($data, $skip_validation = FALSE)
    {
        return $this->article->insert($data, $skip_validation);
    }
    
    public function insert_many($data, $skip_validation = FALSE)
    {
        return $this->article->insert_many($data, $skip_validation);
    }
    
    public function update($id, $data, $skip_validation = FALSE)
    {
        return $this->article->update($id, $data, $skip_validation);
    }
    
    public function delete($id)
    {
        return $this->article->delete($id);
    }
    
    public function delete_by($where)
    {
        return $this->article->delete_by($where);
    }
    
    public function count_all()
    {
        return $this->article->count_all();
    }
    
    public function count_by($where)
    {
        return $this->article->count_by($where);
    }
    
    public function dropdown($key, $value, $option_label = NULL, $where = NULL)
    {
        if($where != NULL){
            $this->db->where($where);
        }
        
        return $this->article->dropdown($key, $value,$option_label);
    }
    
    public function order_by($criteria, $order = NULL)
    {
        $this->article->order_by($criteria,$order);
    }
    
    public function get_next_order($field, $where)
    {
        return $this->article->get_next_order($field, $where);
    }
    
    public function get_like($like, $order_by = FALSE, $limit = FALSE, $offset = 0)
    {
        if($order_by != FALSE)
        {
            $this->order_by($order_by);
        }
        
        if($limit != FALSE)
        {
            $this->article->limit($limit, $offset);
        }
        
        return $this->article->get_like($like);
    }
}