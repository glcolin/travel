<?php
class ModelFromcitysFromcitys extends Model {
	
	public function getTotalFromcitys($data = array()){
		$query = $this->db->query("SELECT * from aa_fromcitys order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getFromcity($id) {
		$query = $this->db->query("SELECT * from aa_fromcitys where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addFromcity($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_fromcitys (title) values ('".$this->db->escape($data['item_title'])."')");
	}
	
	public function deleteFromcity($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_fromcitys where id=".$id);
		}
	}
	
	public function update_fromcity($data=array()){
			$this->db->query("update aa_fromcitys set 
			title='".$this->db->escape($data['item_title'])."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_fromcitys set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
