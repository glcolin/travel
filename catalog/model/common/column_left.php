<?php
class ModelCommonColumnLeft extends Model {	
	
	public function getContactUs() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='contact_us'");
		
		$row=$query->row;
		
		$result="";
		
		if($row){
			$result=$row['option_value'];
		}
		
		return $result;
	}
	
	public function getAreas(){
		$query = $this->db->query("SELECT * from aa_areas order by sort asc,title asc");
		$rows=$query->rows;
		
		$result=array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}

		return $result;
	}
	
	public function getSpecialAreas(){
		$query = $this->db->query("SELECT id from aa_areas where special=1 order by sort asc limit 1");
		$row=$query->row;
		return $row['id'];
	}
	
	public function getLines($data=array()){
		$where = "";
		if(isset($data['hot'])){
			$where .= " hot='".$data['hot']."'";
		}
		
		if($where){
			$where = "where ".$where;
		}
	
		$query = $this->db->query("SELECT * from aa_lines ".$where." order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getFromcitys(){
		$query = $this->db->query("SELECT * from aa_fromcitys order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getEndcitys(){
		$query = $this->db->query("SELECT * from aa_endcitys order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
}
?>