<?php
class ModelBoardinglocationsBoardinglocations extends Model {
	
	public function getTotalBoardinglocations($data = array()){
		$query = $this->db->query("SELECT * from aa_boardinglocations order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getBoardinglocation($id) {
		$query = $this->db->query("SELECT * from aa_boardinglocations where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addBoardinglocation($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_boardinglocations (title) values ('".$this->db->escape($data['item_title'])."')");
	}
	
	public function deleteBoardinglocation($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_boardinglocations where id=".$id);
		}
	}
	
	public function update_boardinglocation($data=array()){
			$this->db->query("update aa_boardinglocations set 
			title='".$this->db->escape($data['item_title'])."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_boardinglocations set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
