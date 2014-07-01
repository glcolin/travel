<?php
class ModelAreasAreas extends Model {
	
	public function getTotalAreas($data = array()){
		$query = $this->db->query("SELECT * from aa_areas order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getArea($id) {
		$query = $this->db->query("SELECT * from aa_areas where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addArea($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_areas (title) values ('".$this->db->escape($data['item_title'])."')");
	}
	
	public function deleteArea($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_areas where id=".$id);
		}
	}
	
	public function update_area($data=array()){
			$this->db->query("update aa_areas set 
			title='".$this->db->escape($data['item_title'])."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_areas set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
