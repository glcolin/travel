<?php
class ModelAttractionsAttractions extends Model {
	
	public function getTotalAttractions($data = array()){
		$query = $this->db->query("SELECT * from aa_attractions order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getAttraction($id) {
		$query = $this->db->query("SELECT * from aa_attractions where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addAttraction($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_attractions (title,wonderful) values ('".$this->db->escape($data['item_title'])."','".$data['item_wonderful']."')");
	}
	
	public function deleteAttraction($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_attractions where id=".$id);
		}
	}
	
	public function update_attraction($data=array()){
			$this->db->query("update aa_attractions set 
			title='".$this->db->escape($data['item_title'])."',
			wonderful='".$data['item_wonderful']."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_attractions set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
