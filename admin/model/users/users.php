<?php
class ModelUsersUsers extends Model {
	
	public function getTotalUsers($data = array()){
		$limit = "";
		if(isset($data['start']) && isset($data['limit'])){
			$limit .= " limit ".$data['start'].",".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_user where belong='front' and status='1' order by create_date desc ".$limit);
		$rows=$query->rows;

		return $rows;
	}
	
	public function getTotalLines(){
		$query = $this->db->query("SELECT * from aa_lines");
		$rows=$query->rows;
		
		$result = array();
		foreach($rows as $row){
			$result[$row['id']] = $row;
		}
		
		return $result;
	}
	
	public function getUser($id) {
		$query = $this->db->query("SELECT * from aa_user where user_id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function getUserOrders($data = array()){
		$query = $this->db->query("SELECT * from aa_lines_orders where user_id='".$data['user_id']."' and status='".$data['status']."' order by create_date desc");
		$rows=$query->rows;

		return $rows;
	}
	
	/*public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_users set sort='".$key."' where id='".$id."'");
		
		}
	}*/
}
?>
