<?php
class ModelInformationsCategories extends Model {
	
	public function getTotalCategories($data = array()){
		$query = $this->db->query("SELECT * from  aa_informations_categories order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getCategory($id) {
		$query = $this->db->query("SELECT * from aa_informations_categories where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addCategory($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_informations_categories (title) values ('".$this->db->escape($data['item_title'])."')");
	}
	
	public function deleteCategory($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_informations_categories where id=".$id);
		}
	}
	
	public function update_category($data=array()){
			$this->db->query("update aa_informations_categories set 
			title='".$this->db->escape($data['item_title'])."'
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_informations_categories set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
