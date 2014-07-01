<?php
class ModelFriendlinksFriendlinks extends Model {
	
	public function getTotalFriendlinks($data = array()){
		$query = $this->db->query("SELECT * from aa_friendlinks order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getFriendlink($id) {
		$query = $this->db->query("SELECT * from aa_friendlinks where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addFriendlink($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_friendlinks (title,link,image_url) values ('".$this->db->escape($data['item_title'])."','".$data['item_link']."','".$data['item_image']."')");
	}
	
	public function deleteFriendlink($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_friendlinks where id=".$id);
		}
	}
	
	public function update_friendlink($data=array()){
			$this->db->query("update aa_friendlinks set 
			title='".$this->db->escape($data['item_title'])."',
			link='".$data['item_link']."',
			image_url='".$data['item_image']."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_friendlinks set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
