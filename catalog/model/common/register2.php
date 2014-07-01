<?php
class ModelCommonRegister2 extends Model {	
	
	public function getUser($user_id) {
		$query = $this->db->query("select user_id,email,activation_code from aa_user where user_id='".$user_id."' and belong='front'");
		return $query->row;
	}
}
?>