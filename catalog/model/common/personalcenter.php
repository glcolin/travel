<?php
class ModelCommonPersonalcenter extends Model {	
	
	public function getUserPaidOrders($data=array()){
		$query = $this->db->query("select * from aa_lines_orders where user_id='".$data['user_id']."' and status='paid' order by create_date desc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getLine($data=array()){
		$query = $this->db->query("SELECT * from aa_lines where id='".$data['id']."'");
		$row=$query->row;

		return $row;
	}
	
}
?>