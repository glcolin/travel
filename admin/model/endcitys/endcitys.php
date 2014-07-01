<?php
class ModelEndcitysEndcitys extends Model {
	
	public function getTotalEndcitys($data = array()){
		$query = $this->db->query("SELECT * from aa_endcitys order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getEndcity($id) {
		$query = $this->db->query("SELECT * from aa_endcitys where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addEndcity($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_endcitys (title) values ('".$this->db->escape($data['item_title'])."')");
	}
	
	public function deleteEndcity($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_endcitys where id=".$id);
		}
	}
	
	public function update_endcity($data=array()){
			$this->db->query("update aa_endcitys set 
			title='".$this->db->escape($data['item_title'])."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_endcitys set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
