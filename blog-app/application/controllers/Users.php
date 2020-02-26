<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
      //  $this->load->model('comment');
      //  $this->load->model('post');
      $this->load->model('user');
     
    }

    public function register()
    {
        $data['title'] = 'Sing up';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('zipcode', 'Zipcode', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('users/register', $data);
            $this->load->view('templates/footer');
        } else {
            //Encrypt password
            $enc_password = md5($this->input->post('password'));
            $this->user->register($enc_password);
            //Set session message
            $this->session->set_flashdata('user_registered', 'You are now successfuly registered!');
            redirect('posts');
        }

    }

    public function login()
    {
        $data['title'] = 'Sing in';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
      
        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('templates/navbar');
            $this->load->view('users/login', $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $user_id = $this->user->login($username, $password);

            if($user_id){
                //Create session
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now successfuly logged in!');
                redirect('posts');
        
            } else {
                $this->session->set_flashdata('login_failed', 'Login is invalid!');
                redirect('users/login');
            }
            
        }

    }

    public function logout()
    {
        //Unset user data
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
        $this->session->set_flashdata('user_loggedout', 'You are now successfuly logged out!');
        redirect('users/login');
              
    }

    //Check if username exists
    public function check_username_exists($username) {
        $this->form_validation->set_message('check_username_exists', 'That username has been taken');
        if($this->user->check_username_exists($username)) {
            return true;
        }else {
            return false;
        }
    }

    //Check if email exists
     public function check_email_exists($email) {
        $this->form_validation->set_message('check_email_exists', 'That email has been taken');
        if($this->user->check_email_exists($email)) {
            return true;
        }else {
            return false;
        }
    }

}