<?php
class ModelCommonRegister extends Model {	
	
	public function addUser($data) {
		$query = $this->db->query("insert into aa_user (username,password,level,authority,email,belong,activation_code,status) values ('".$data['username_f']."','".md5($data['password_f'])."','1','member','".$data['email_f']."','front','".$data['activation_code']."','0')");
		return mysql_insert_id() ;
	}
	
	public function checkUser($data) {
		$query = $this->db->query("select user_id from aa_user where username='".$data['username_f']."' and belong='front'");
		
		if($query->row){
		   return "false";
		}
		return "true";
	}
}
?>