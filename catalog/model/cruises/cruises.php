<?php
class ModelCruisesCruises extends Model {	
	
	public function getCruises($data=array()){
		$where = "";
		$limit = "";
		
		$query = $this->db->query("SELECT id from aa_areas where special=1 order by sort asc limit 1");
		$area=$query->row;
		
		$where .= " and area='".$area['id']."'";
		
		if(isset($data['start']) && isset($data['limit'])){
			$limit .= " limit ".$data['start'].",".$data['limit'];
		}
		
		if(isset($data['hot'])){
			$where .= " and hot='".$data['hot']."'";
		}
		if(isset($data['from_city'])){
			if($data['from_city']){
				$where .= " and from_city='".$data['from_city']."'";
			}
		}
		if(isset($data['end_city'])){
			if($data['end_city']){
				$where .= " and end_city='".$data['end_city']."'";
			}
		}
		if(isset($data['days'])){
			if($data['days']){
				$where .= " and days='".$data['days']."'";
			}
		}
		if(isset($data['area'])){
			if($data['area']){
				$where .= " and area='".$data['area']."'";
			}
		}
		if(isset($data['attraction'])){
			if($data['attraction']){
				$iquery = $this->db->query("SELECT id,main_attractions from aa_lines where main_attractions!=''");
				$irows=$iquery->rows;
				$main_attractions_id = array();
				foreach($irows as $irow){
					$main_attractions_arr = json_decode($irow['main_attractions']);
					if(in_array($data['attraction'],$main_attractions_arr)){
						$main_attractions_id[] = $irow['id'];
					}
				}
				$main_attractions_id_str = implode("','",$main_attractions_id);
				$where .= " and id in ('".$main_attractions_id_str."')";
			}
		}
		if($where){
			$where = "where 1 ".$where;
		}
	
		$query = $this->db->query("SELECT * from aa_lines ".$where." order by sort asc ".$limit);
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getCruisesCount(){
	
		$query = $this->db->query("SELECT count(id) from aa_lines");
		$row=$query->row;
		
		return $row['count(id)'];
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
		$query = $this->db->query("SELECT * from aa_fromcitys order by sort asc");
		$rows=$query->rows;
		
		$result = array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}
		
		return $result;
	}
	
	public function getAlldays(){
		$query = $this->db->query("SELECT distinct(days) from aa_lines order by sort asc");
		$rows=$query->rows;
		
		$result = array();
		foreach($rows as $row){
			$result[] = $row['days'];
		}
		sort($result);
		return $result;
	}
	
	public function getEndcitys(){
		$query = $this->db->query("SELECT * from aa_endcitys order by sort asc");
		$rows=$query->rows;
		
		$result = array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}
		
		return $result;
	}
}
?>