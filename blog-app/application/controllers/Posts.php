<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('post');
        $this->load->model('comment');
    }

	public function index()
    {
        $data['title'] = 'Lastest Posts';
        $data['posts'] = $this->post->get_posts();
   
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = FALSE)
    {
        $data['post'] = $this->post->get_posts($slug);
        $post_id = $data['post']['id'];
        $data['comments'] = $this->comment->get_comments($post_id);

        if(empty($data['post'])) {
            show_404();
        }

        $data['title'] = $data['post']['title'];
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        //Check login
      
        if(!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }


        $data['title'] = 'Create Post';
        $data['categories'] = $this->post->get_categories();


        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');
        
        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('posts/create', $data);
            $this->load->view('templates/footer');
        } else {
            //Upload image
            $config['upload_path']   = './assets/images/posts';
            $config['allowed_types'] = 'git|jpg|png';
            $config['max_size']      = '2048';
            $config['max_width']     = '2000';
            $config['max_height']    = '2000';

            $this->load->library('upload', $config);
            if(!$this->upload->do_upload()) {
                $errors = array('error' => $this->upload->display_errors());
                $post_image = 'noimage.jpg';
            }else {
                $data = array('upload_data' => $this->upload->data());
                $post_image = trim(addslashes($_FILES['userfile']['name']));
                $post_image = preg_replace('/\s+/', '_', $post_image);
            }

            $this->post->create_post($post_image);
            //Set session message
            $this->session->set_flashdata('post_created', 'Your post has been created!');
            redirect('/posts');
        }
        
    }

    public function delete($id)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->post->delete_post($id);
        $this->session->set_flashdata('post_deleted', 'Your post has been deleted!');
        redirect('/posts');
    }

    public function edit($slug)
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['post'] = $this->post->get_posts($slug);
        //Check user
        if($this->session->userdata('user_id') !== $this->post->get_posts($slug)['user_id'] ){
            redirect('posts');
        }
        $data['categories'] = $this->post->get_categories();
        if(empty($data['post'])) {
            show_404();
        }

        $data['title'] = 'Edit Post';
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('posts/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        if(!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->post->update_post();
        //Set session message
        $this->session->set_flashdata('post_update', 'Your post has been update!');
        redirect('/posts');
    }

}
