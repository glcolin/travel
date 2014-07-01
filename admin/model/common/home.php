<?php
class ModelCommonHome extends Model {

	public function getLatesetUsers(){
	
		$query = $this->db->query("SELECT username,create_date FROM aa_user where belong='front' and status=1 order by create_date desc limit 0,9");
		
		return $query->rows;
	
	}
	
	public function getLatesetOrders(){
	
		$query = $this->db->query("SELECT number,status,create_date FROM aa_lines_orders order by create_date desc limit 0,9");
		
		return $query->rows;
	
	}
}