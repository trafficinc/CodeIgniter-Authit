<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Authit Authentication Library
 *
 * @package Authentication
 * @category Libraries
 * @author Ron Bailey
 * @version 1.0
 */

class Authit {

	private $CI;
	protected $PasswordHash;
	
	public function __construct()
	{
		$this->CI =& get_instance();

		$this->CI->load->database();
		$this->CI->load->library('session');
		$this->CI->load->model('authit_model');
		$this->CI->config->load('authit');
	}
	
	public function logged_in()
	{
		return $this->CI->session->userdata('logged_in');
	}
	
	public function login($email, $password)
	{
		$user = $this->CI->authit_model->get_user_by_email($email);
		if($user){
			if(password_verify($password, $user->password)){
				unset($user->password);
				$this->CI->session->set_userdata(array(
					'logged_in' => true,
					'user' => $user
				));
				$this->CI->authit_model->update_user($user->id, array('last_login' => date('Y-m-d H:i:s')));
				return true;
			}
		}
		 
		return false;
	}
	
	public function logout($redirect = false)
	{
		$this->CI->session->sess_destroy();
		if($redirect){
			$this->CI->load->helper('url');
			redirect($redirect, 'refresh');
		}
	}
	
	public function signup($email, $password)
	{
		$user = $this->CI->authit_model->get_user_by_email($email);
		if($user) return false;
		 
		$password = password_hash($password, PASSWORD_DEFAULT);
		$this->CI->authit_model->create_user($email, $password);
		return true;
	}
	
	public function reset_password($user_id, $new_password)
	{
		$new_password = password_hash($new_password, PASSWORD_DEFAULT);
		$this->CI->authit_model->update_user($user_id, array('password' => $new_password));
	}
	
}

/* End of file: Authit.php */
/* Location: application/libraries/Authit.php */