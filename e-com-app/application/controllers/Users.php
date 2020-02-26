<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
	    parent::__construct();
		$this->load->model('user_model');
		$this->load->helper('security');
		$this->load->helper('email');
	}

	public function index($flip = false) 
	{
		$data['flip'] = $flip;
		$data['title'] = "Login/Registration";
		$data['headers'] = ['Login','Registration'];
     	$this->load->view('templates/header', $data);
		$this->load->view('index', $data);
	}


	public function register()
    {
		$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean|alpha|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|callback_check_email_exists');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|min_length[3]|max_length[12]|callback_check_username_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[3]|callback_check_password_strength');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'matches[password]');
	
		if($this->form_validation->run() === FALSE) {
			$this->index(true);
		} else {
		    //Encrypt password
			$enc_password = md5($this->input->post('password'));
			$this->user_model->register($enc_password);
			//Set session message
			$this->session->set_flashdata('user_registered', 'You are now successfuly registered!');
			redirect('');
			//$this->index();
		}
	}

	public function login()
    {
        $this->form_validation->set_rules('log-username', 'Username', 'required');
        $this->form_validation->set_rules('log-password', 'Password', 'required');
      
        if($this->form_validation->run() === FALSE) {
			$this->index();
        } else {
            $username = $this->input->post('log-username');
            $password = md5($this->input->post('log-password'));
            $user_id = $this->user_model->login($username, $password);

            if($user_id){
            	//Create session
            	$user_data = array(
            		'user_id' => $user_id,
            	    'username' => $username,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
				//$this->load->view('pages/home'); // To new page
				redirect('home');
        
            } else {
            	$this->session->set_flashdata('login_failed', 'Login is invalid!');
                redirect('');
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
        redirect('');
    }
	
	//Validation functions
	public function check_username_exists($username) 
	{
		$this->form_validation->set_message('check_username_exists', 'That username has been taken');
		if($this->user_model->check_username_exists($username)) {
			return true;
		}else {
			return false;
		}
	}
	public function check_email_exists($email) 
	{
		$this->form_validation->set_message('check_email_exists', 'That email has been taken');
		if($this->user_model->check_email_exists($email)) {
			return true;
		}else {
			return false;
		}
	}
	public function check_password_strength($str) 
	{
	    if (1 !== preg_match("/^.*(?=.{6,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $str)) {
			$this->form_validation->set_message('check_password_strength', 'Must contain one lower, one upper case letter and one digit');
			return FALSE;
		} else {
			return TRUE;
		}
	} 

}
