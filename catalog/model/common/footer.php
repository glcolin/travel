<?php
class ModelCommonFooter extends Model {	
	
	public function getQQInformation() {
		$query = $this->db->query("SELECT option_value from aa_options where option_key='qq_information'");
		
		$row=$query->row;
		
		$result="";
		
		if($row){
			$result=$row['option_value'];
		}
		
		return $result;
	}
}
?>