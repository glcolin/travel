<?php
class ModelCommonContactUs extends Model {	
	
	public function getContactUs() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='contact_us'");
		
		$row=$query->row;
		
		$result="";
		
		if($row){
			$result=$row['option_value'];
		}
		
		return $result;
	}
	
}
?>