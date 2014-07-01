<?php
class ModelBookFlight extends Model {	
	
	public function add_ticket($data=array(),$number){
		$content_str = json_encode($data);

		$query = $this->db->query("insert into aa_tickets (number,content,create_date) values (
			'".$number."',
			'".$this->db->escape($content_str)."',
			now()
			)");
	}
	
}
?>