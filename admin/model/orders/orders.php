<?php
class ModelOrdersOrders extends Model {
	
	public function getTotalOrders($data = array()){
		$limit = "";
		$where = "";
		if(isset($data['filter_number']) && $data['filter_number']){
			$where = " where number like '%".$data['filter_number']."%'";
		}
		
		if(isset($data['start']) && isset($data['limit'])){
			$limit .= " limit ".$data['start'].",".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_lines_orders ".$where." order by create_date desc ".$limit);
		$rows=$query->rows;

		return $rows;
	}
	
	public function getTotalLines(){
		$query = $this->db->query("SELECT * from aa_lines");
		$rows=$query->rows;
		
		$result = array();
		foreach($rows as $row){
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	//order detail
	public function getOrder($id) {
		$query = $this->db->query("SELECT * from aa_lines_orders where id=".$id);
		$row=$query->row;
				
		return $row;
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
