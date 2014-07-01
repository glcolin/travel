<?php
class ModelCommonForgotten extends Model {

	public function getUserInfo($email){
	
		$query = $this->db->query("SELECT * FROM aa_user WHERE email = '".$email."'");
		
		return $query->row;
	
	}
	
	public function getTotalUserInfo($email) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM aa_user WHERE email = '".$email."'");
		
		return $query->row['total'];
	}
	
	public function getTotalUserInfoByIDandPassword($id,$password) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM aa_user WHERE user_id = '".$id."' AND password = '".$password."'");
		
		return $query->row['total'];
	}

	public function updatePassword($id,$oldpassword,$newpassword) {
      	$query = $this->db->query("UPDATE aa_user SET password = '".md5($newpassword)."' WHERE user_id = '".$id."' AND password = '".$oldpassword."'");
	}
	
	public function isLinkInfoValid($id,$password){
	
		$query = $this->db->query("SELECT * FROM aa_user WHERE id = '".$id."' AND password = '".$password."'");
		
		return $query->row;
	
	}

}