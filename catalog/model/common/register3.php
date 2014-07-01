<?php
class ModelCommonRegister3 extends Model {	
	
	public function getActivationCode($user_id) {
		$query = $this->db->query("select activation_code from aa_user where user_id='".$user_id."' and belong='front'");
		return $query->row;
		
	}
	
	public function setUserStatus($user_id) {
		$query = $this->db->query("update aa_user set status='1',create_date=now() where user_id='".$user_id."' and belong='front'");
		
	}
}
?>