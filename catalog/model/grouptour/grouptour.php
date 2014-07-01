<?php
class ModelGrouptourGrouptour extends Model {	
	
	public function add_grouptour($data=array(),$number){
		$content_str = json_encode($data);

		$query = $this->db->query("insert into aa_grouptours (number,content,create_date) values (
			'".$number."',
			'".$this->db->escape($content_str)."',
			now()
			)");
	}
	
}
?>