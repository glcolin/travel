<?php
class ModelCommonPayment extends Model {	
	
	public function getUserUnpaidOrders($data=array()){
		$order_ids_str =implode("','",$data['order_ids']);
		$query = $this->db->query("select * from aa_lines_orders where id in ('".$order_ids_str."') order by create_date desc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function updateUserUnpaidOrders($data=array()){
		$order_ids_str =implode("','",$data['order_ids']);
		$this->db->query("update aa_lines_orders set status='paid' where id in ('".$order_ids_str."') ");
	}
	
	public function getLine($data=array()){
		$query = $this->db->query("SELECT * from aa_lines where id='".$data['id']."'");
		$row=$query->row;
		
		return $row;
	}
	
	public function getAttractions(){
		$query = $this->db->query("SELECT * from aa_attractions where 1 order by sort asc");
		$rows=$query->rows;
		
		$result = array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}
		
		return $result;
	}
	
	public function getFromcitys(){
		$query = $this->db->query("SELECT * from aa_fromcitys order by sort asc,title asc");
		$rows=$query->rows;

		$result=array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}

		return $result;
	}
	
	public function getEndcitys(){
		$query = $this->db->query("SELECT * from aa_endcitys order by sort asc,title asc");
		$rows=$query->rows;

		$result=array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}

		return $result;
	}
	
	public function updateUserIntegral($data=array()){
		$query = $this->db->query("update aa_user set integral='".$data['integral']."' where user_id=".$data['user_id']);
	}
}
?>