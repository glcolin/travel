<?php
class ModelGrouptoursGrouptours extends Model {
	
	public function getTotalGrouptours($data = array()){
		$limit = "";
		$where = "";
		if(isset($data['filter_number']) && $data['filter_number']){
			$where = " where number like '%".$data['filter_number']."%'";
		}
		
		if(isset($data['start']) && isset($data['limit'])){
			$limit .= " limit ".$data['start'].",".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_grouptours ".$where." order by create_date desc ".$limit);
		$rows=$query->rows;

		return $rows;
	}
	
	public function getGrouptour($id) {
		$query = $this->db->query("SELECT * from aa_grouptours where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
}
?>
