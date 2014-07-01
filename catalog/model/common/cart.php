<?php
class ModelCommonCart extends Model {	
	
	public function getUserUnpaidOrders($data=array()){
		$query = $this->db->query("select * from aa_lines_orders where user_id='".$data['user_id']."' and status='unpaid' order by create_date desc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function deleteOrder($data=array()){
		$query = $this->db->query("delete from aa_lines_orders where id='".$data['id']."'");
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
}
?>