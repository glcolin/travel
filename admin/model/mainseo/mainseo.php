<?php
class ModelMainseoMainseo extends Model {
	
	public function getMainSeoKeywords() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='main_seo_keywords'");
		
		$row=$query->row;
		
		return isset($row['option_value'])?$row['option_value']:"";
	}
	
	public function getMainSeoDescription() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='main_seo_description'");
		
		$row=$query->row;
		
		return isset($row['option_value'])?$row['option_value']:"";
	}
	
	public function update_mainseo($data=array()){
		//main seo keywords
		$query = $this->db->query("SELECT option_value from aa_options where option_key='main_seo_keywords'");
		
		$row=$query->row;
		
		if($row){
			$this->db->query("update aa_options set 
				option_value='".$this->db->escape($data['item_main_seo_keywords'])."' 
				where option_key='main_seo_keywords'");
		}
		else{
			$this->db->query("insert into aa_options (option_key,option_value) values ('main_seo_keywords','".$this->db->escape($data['item_main_seo_keywords'])."')");
		}
		
		//main seo description
		$query = $this->db->query("SELECT option_value from aa_options where option_key='item_main_seo_description'");
		
		$row=$query->row;
		
		if($row){
			$this->db->query("update aa_options set 
				option_value='".$this->db->escape($data['item_main_seo_description'])."' 
				where option_key='main_seo_description'");
		}
		else{
			$this->db->query("insert into aa_options (option_key,option_value) values ('main_seo_description','".$this->db->escape($data['item_main_seo_description'])."')");
		}
		
		
	}
}
?>
