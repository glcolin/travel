<?php
class ModelInformationsInformations extends Model {
	
	public function getTotalInformations($data = array()){
		$query = $this->db->query("SELECT * from aa_informations order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getInformation($id) {
		$query = $this->db->query("SELECT * from aa_informations where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function getCategories() {
		$query = $this->db->query("SELECT * from aa_informations_categories order by sort asc,title asc");
		$rows=$query->rows;
				
		$result = array();
		
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}		
				
		return $result;
	}
	
	public function addInformation($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_informations (title,wonderful,content,image_url,author,category,update_date,create_date,seo_keywords,seo_description) values ('".$this->db->escape($data['item_title'])."','".$data['item_wonderful']."','".$this->db->escape($data['item_content'])."','".$data['item_image']."','".$this->user->getUserId()."','".$data['item_category']."',now(),now(),'".$this->db->escape($data['item_seo_keywords'])."','".$this->db->escape($data['item_seo_description'])."')");
	}
	
	public function deleteInformation($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_informations where id=".$id);
		}
	}
	
	public function update_information($data=array()){
			$this->db->query("update aa_informations set 
			title='".$this->db->escape($data['item_title'])."',
			wonderful='".$this->db->escape($data['item_wonderful'])."',
			content='".$this->db->escape($data['item_content'])."',
			image_url='".$data['item_image']."',
			category='".$data['item_category']."',
			update_date = now(),
			seo_keywords='".$this->db->escape($data['item_seo_keywords'])."',
			seo_description='".$this->db->escape($data['item_seo_description'])."' 
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_informations set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
