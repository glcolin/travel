<?php
class ModelOtherBannersOtherBanners extends Model {
	
	public function getTotalOtherBanners($data = array()){
		$query = $this->db->query("SELECT * from aa_otherbanners order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getOtherBanner($id) {
		$query = $this->db->query("SELECT * from aa_otherbanners where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addOtherBanner($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_otherbanners (title,type,link,image_url) values ('".$this->db->escape($data['item_title'])."','".$data['item_type']."','".$data['item_link']."','".$data['item_image']."')");
	}
	
	public function deleteOtherBanner($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_otherbanners where id=".$id);
		}
	}
	
	public function update_otherBanner($data=array()){
			$this->db->query("update aa_otherbanners set 
			title='".$this->db->escape($data['item_title'])."',
			type='".$data['item_type']."',
			link='".$data['item_link']."',
			image_url='".$data['item_image']."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_otherbanners set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
