<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of copy
 *
 * @author Chanthoeun
 */
class Home_page extends Front_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->lang->load('home'); 
        $this->load->helper('text');
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
        $pagination = get_pagination('videos/page', count(Modules::run('articles/get_all')), 20, 5, 3);
        $articles = Modules::run('articles/get_all', array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['videos'] = $articles;
        
        $this->_default();
                
        // process template
        $title = $this->lang->line('home_headding');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'index';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url());
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function videos($slug = FALSE)
    {
        if(isset($slug) && $slug != FALSE && $slug != 'page')
        {
            $cat = Modules::run('categories/get_by', array('slug' => $slug));
            $pagination = get_pagination('videos/'.$cat->slug.'/page', count(Modules::run('articles/get_many_by', array('category_id' => $cat->id))), 20, 5, 4);
            $articles = Modules::run('articles/get_many_by', array('category_id' => $cat->id), array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        else
        {
            $pagination = get_pagination('videos/page', count(Modules::run('articles/get_all')), 20, 5, 3);
        $articles = Modules::run('articles/get_all', array('article.created_at' => 'desc'), $pagination['per_page'], $this->uri->segment($pagination['uri_segment']));
        }
        
        $this->data['pagination'] = $pagination['v_pagination'];
        $this->data['videos'] = $articles;
        
        $this->_default();
                
        // process template
        $title = isset($cat) && $cat != FALSE ? $cat->caption : $this->lang->line('home_video_list');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = isset($cat) && $cat != FALSE ? array('videos' => $this->lang->line('home_video_list'), $title) : array($title);
         
        $layout_property['content']     = 'video';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, isset($cat) && $cat != FALSE ? site_url('videos/'.$cat->slug) : site_url('videos'));

        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function view($slug)
    {
        $article = Modules::run('articles/get_by', array('article.slug' => $slug));
        $this->data['article'] = $article;
        $this->data['related_articles'] = Modules::run('articles/get_many_by', array('category_id' => $article->category_id), array('created_at' => 'RANDOM'), 5);
        
        video_hit($article->id);
        $this->_default();
        
        // process template
        $title = $article->title;
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'view';
        
        $meta = $this->_generate_meta($title, strip_tags($article->detail), FALSE, youtube_thumbs($article->source, 'hq'), site_url('view/'.$article->id));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function search()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('search', $this->lang->line('home_search_headding'), 'trim|required|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            $search_keywords = $this->input->post('search', TRUE);
            if(empty($search_keywords))
            {
                $this->data['search_result'] = $this->lang->line('home_search_result_found');
            }
            else
            {
                $this->data['result_articles'] = Modules::run('articles/get_like', array('title' => $search_keywords), array('created_at' => 'desc'));
                
                
                $count_all_result = count($this->data['result_articles']);
                
                $this->data['search_result'] = sprintf($this->lang->line('home_search_result_found'), $count_all_result);
            }
        }
        
        if(!isset($search_keywords))
        {
            $this->data['search_result'] = $this->lang->line('home_search_result_found');
        }
        
        $this->_default();
        // process template
        $title = $this->lang->line('home_search_headding');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'search';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('search'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function about_us()
    {
        $this->underconstruction();
    }
    
    public function contact_us()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', $this->lang->line('home_contact_fullname_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('home_contact_email_lable'), 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone', $this->lang->line('home_contact_telephone_label'), 'trim|xss_clean');
        $this->form_validation->set_rules('subject', $this->lang->line('home_contact_subject_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('comment', $this->lang->line('home_contact_comment_label'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('captcha', $this->lang->line('home_signup_validation_captcha'), 'trim|required|xss_clean');
        if($this->form_validation->run() === TRUE)
        {
            if(check_captcha($this->input->post('captcha')) == FALSE)
            {
                $this->session->set_flashdata('message', 'Security Code is not correct!');
            }
            else
            {
                $from   = $this->input->post('email', TRUE);
                $name   = $this->input->post('name', TRUE);
                $to     = array('info@f-club.ga', 'chanthoeunkim@gmail.com');
                $subject= $this->input->post('subject', TRUE);
                $body   = $this->input->post('comment', TRUE).'<br><br>'
                        . 'Sender Contact: <br><br>'
                        . 'Name: '.$name.'<br>'
                        . 'Email: '.$from.'<br>'
                        . 'Telephone: '.$this->input->post('telephone');

                if(ENVIRONMENT == 'production')
                {
                    if(! send_email($from, $name, $to, $subject, $body))
                    {
                        $this->session->set_flashdata('message', $this->lang->line('home_contact_sent_error') );
                        redirect('contact-us', 'refresh');
                    }
                }
                $this->session->set_flashdata('message', $this->lang->line('home_contact_sent_success') );
                redirect('contact-us', 'refresh');
            }
        }
        
        // display form
        $this->data['message'] = validation_errors() == FALSE ? $this->session->flashdata('message') : validation_errors();
        
        $this->data['name'] = array(
            'name'  => 'name',
            'id'    => 'name',
            'class' => 'form-control',
            'value' => set_value('name')
        );
        
        $this->data['email'] = array(
            'name'  => 'email',
            'id'    => 'email',
            'class' => 'form-control',
            'value' => set_value('email')
        );
        
        $this->data['telephone'] = array(
            'name'  => 'telephone',
            'id'    => 'telephone',
            'class' => 'form-control',
            'value' => set_value('telephone')
        );
        
        $this->data['subject'] = array(
            'name'  => 'subject',
            'id'    => 'subject',
            'class' => 'form-control',
            'value' => set_value('subject')
        );
        
        $this->data['comment'] = array(
            'name'  => 'comment',
            'id'    => 'comment',
            'class' => 'form-control',
            'value' => set_value('comment')
        );
        
        $this->data['captcha'] = array(
            'name'  => 'captcha',
            'id'    => 'captcha',
            'class' => 'form-control',
            'placeholder' => $this->lang->line('home_signup_placeholder_captcha'),
            'autocomplete' => 'off'
        );
        
        $this->_default();
        // process template
        $title = $this->lang->line('home_menu_contact_us');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'contact_us';
        
        $this->data['menu_contact_us'] = TRUE; 
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('contact-us'));
        
        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function policy()
    {
        $this->underconstruction();
    }
    
    public function condition()
    {
        $this->underconstruction();
    }

    public function blank()
    {
        $this->_default();
        // process template
        $title = $this->lang->line('home_blank');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'blank';
        
        $meta = $this->_generate_meta($title, FALSE, FALSE, FALSE, site_url('blank'));

        generate_template($this->data, $layout_property, FALSE, $meta);
    }
    
    public function underconstruction()
    {
        $this->_default();
        // process template
        $title = $this->lang->line('home_underconstruction');
        $this->data['title'] = $title;
        $layout_property['css'] = array(
                                        'css/bootstrap.min.css',
                                        'css/fontawsome.min.css',
                                        'css/style.min.css'
                                    );
        $layout_property['js']  = array('js/bootstrap.min.js');
        
        $layout_property['breadcrumb'] = array($title);
        
        $layout_property['content']     = 'underconstruction';
        
        generate_template($this->data, $layout_property);
    }
    
    public function _generate_meta($title, $description = FALSE, $keyword = FALSE, $image = FALSE, $url = FALSE)
    {
        // meta
        return $meta = array(
            array('name' => 'description', 'content' => character_limiter($description == FALSE ? $this->lang->line('home_meta_description') : $description, 150)),
            array('name' => 'keywords', 'content' => $keyword == FALSE ? $this->lang->line('home_meta_keyword') : $keyword),
            // Facebook Meta 
            array('name' => 'og:title', 'content' => $title, 'type' => 'property'),
            array('name' => 'og:type', 'content' => "Agriculture Magazine", 'type' => 'property'),
            array('name' => 'og:image', 'content' => $image == FALSE ? get_image('logo-white.png') : $image, 'type' => 'property'),
            array('name' => 'og:url', 'content' => $url == FALSE ? site_url() : $url, 'type' => 'property'),
            array('name' => 'og:description', 'content' => character_limiter($description == FALSE ? $this->lang->line('home_meta_description') : $description, 150), 'type' => 'property'),
            array('name' => 'og:site_name', 'content' => site_name(), 'type' => 'property'),
            array('name' => 'og:admins', 'content' => "1534352553487668", 'type' => 'property'),
        );
    }
    
    public function _default()
    {
        $this->data['categories'] = Modules::run('categories/get_all');
        $this->data['populars'] = Modules::run('articles/get_many_by', array('view !=' => 0), array('view' => 'desc'), 20);
    }
    
}