<?php
class User {
	private $user_id;
	private $username;
  	private $password;
	private $level;
	private $authority;
	private $email;
	private $integral;

  	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');
  	}

  	public function logout() {

		$this->username = '';
		$this->password = '';
		
		session_destroy();
  	}
  
  	public function isLogged($belong="admin") {
		if($belong=="admin"){
			if(isset($this->session->data['username']) && isset($this->session->data['password']) && !empty($this->session->data['username']) && !empty($this->session->data['password'])){
				$username=$this->session->data['username'];
				$password=$this->session->data['password'];
				if($username && $password){
				
					$user_query = $this->db->query("SELECT * FROM aa_user WHERE username = '" . $this->db->escape($username) . "' and belong='".$belong."' and status=1");
					$user_info=$user_query->row;
	
					if($user_info){
						if(md5($password)==($user_info['password'])){
							$this->setUser($user_info);
							return true;
						}	
					}	
				}
				$this->session->data['warning'] = '你的账号或密码输入错误';
				return false;
			}
		}
		else{
			if(isset($this->session->data['username_f']) && isset($this->session->data['password_f']) && !empty($this->session->data['username_f']) && !empty($this->session->data['password_f'])){
				$username=$this->session->data['username_f'];
				$password=$this->session->data['password_f'];
				if($username && $password){
				
					$user_query = $this->db->query("SELECT * FROM aa_user WHERE username = '" . $this->db->escape($username) . "' and belong='".$belong."' and status=1");
					$user_info=$user_query->row;
	
					if($user_info){
						if(md5($password)==($user_info['password'])){
							$this->setUser($user_info);
							return true;
						}	
					}	
				}
				$this->session->data['warning'] = '你的账号或密码输入错误';
				return false;
			}
		}
		return false;
  	}
	
	private function setUser($user_info){
		$this->user_id=$user_info['user_id'];
		$this->username=$user_info['username'];
		$this->password=$user_info['password'];
		$this->level=$user_info['level'];
		$this->authority=$user_info['authority'];
		$this->email=$user_info['email'];
		$this->integral=$user_info['integral'];
	}
	
	public function updatePassword($password){
		$this->db->query("UPDATE aa_user SET password = '".md5($password)."' WHERE user_id = '".$this->user_id."'" );
	}
	
	public function isManager(){
		if($this->level>=5){
			return true;
		}
		return false;
	}
	
	public function isBoss(){
		if($this->level>=10){
			return true;
		}
		return false;
	}
	
	public function getUserId(){
		return $this->user_id;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function getPassword(){
		return $this->password;
	}
	
	public function getIntegral(){
		return $this->integral;
	}
	
	public function setIntegral($integral){
		$this->db->query("UPDATE aa_user SET integral = '".$integral."' WHERE user_id = '".$this->user_id."'" );
	}
}
?>