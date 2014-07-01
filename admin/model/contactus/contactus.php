<?php
class ModelContactusContactus extends Model {
	
	public function getContactUs() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='contact_us'");
		
		$row=$query->row;
		
		$result="";
		
		if($row){
			$result=$row['option_value'];
		}
		
		return $result;
	}
	
	public function getQQInformation() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='qq_information'");
		
		$row=$query->row;
		
		$result="";
		
		if($row){
			$result=$row['option_value'];
		}
		
		return $result;
	}
	
	public function update_banner($data=array()){
		//contact us
		$query = $this->db->query("SELECT option_value from aa_options where option_key='contact_us'");
		
		$row=$query->row;
		
		if($row){
			$this->db->query("update aa_options set 
				option_value='".$this->db->escape($data['item_content'])."' 
				where option_key='contact_us'");
		}
		else{
			$this->db->query("insert into aa_options (option_key,option_value) values ('contact_us','".$this->db->escape($data['item_content'])."')");
		}
		
		//QQ information
		$query = $this->db->query("SELECT option_value from aa_options where option_key='qq_information'");
		
		$row=$query->row;
		
		if($row){
			$this->db->query("update aa_options set 
				option_value='".$this->db->escape($data['item_qq_information'])."' 
				where option_key='qq_information'");
		}
		else{
			$this->db->query("insert into aa_options (option_key,option_value) values ('qq_information','".$this->db->escape($data['item_qq_information'])."')");
		}
		
	}
}
?>
