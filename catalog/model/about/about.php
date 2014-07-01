<?php
class ModelAboutAbout extends Model {
	
	public function getAboutLeft() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='contact_left'");
		
		$row=$query->row;
		
		$result="";
		
		if($row){
			$result=$row['option_value'];
		}
		
		return $result;
	}
	
	public function getAboutRight() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='contact_right'");
		
		$row=$query->row;
		
		$result="";
		
		if($row){
			$result=$row['option_value'];
		}
		
		return $result;
	}

}
?>
