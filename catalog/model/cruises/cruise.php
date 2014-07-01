<?php
class ModelCruisesCruise extends Model {	
	
	public function getCruise($data=array()){
		$query = $this->db->query("SELECT * from aa_lines where id='".$data['id']."'");
		$row=$query->row;
		
		return $row;
	}
	
	public function getBoardingLocations(){
		$query = $this->db->query("SELECT * from aa_boardinglocations order by sort,title asc");
		$rows=$query->rows;
		$result = array();
		foreach($rows as $row){
			$result[$row['id']]=$row['title'];
		}
		
		return $result;
	}
	
	public function place_an_order($data=array()){
		$query = $this->db->query("insert into aa_lines_orders (number,user_id,line,departure_date,boarding_location,accommodation,total_price,integral,contact,phone,update_date,create_date) values (
					'LINE".$data['user_id'].date('Ymdhis')."',
					'".$data['user_id']."',
					'".$data['cruise_id']."',
					'".$data['departuredate']."',
					'".$data['boardinglocation']."',
					'".$data['order_rooms_data']."',
					'".$data['total_price']."',
					'".$data['integral']."',
					'".$data['contact']."',
					'".$data['phone']."',
					now(),
					now())"
				 );
	}
	
	public function add_comment($data=array()){

		$query = $this->db->query("insert into aa_lines_comments (user_id,cruise_id,title,content,email,create_date) values (
					'".$data['user_id']."',
					'".$data['cruise_id']."',
					'".$data['comment_title']."',
					'".$data['comment_content']."',
					'".$data['comment_email']."',
					now())"
				 );
				 	 
	}
	
	public function getAttractions(){
		$query = $this->db->query("SELECT * from aa_attractions where 1 order by sort asc");
		$rows=$query->rows;
		
		$result = array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}
		
		return $result;
	}
	
	public function getFromcitys(){
		$query = $this->db->query("SELECT * from aa_fromcitys order by sort asc,title asc");
		$rows=$query->rows;

		$result=array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}

		return $result;
	}
	
	public function getEndcitys(){
		$query = $this->db->query("SELECT * from aa_endcitys order by sort asc,title asc");
		$rows=$query->rows;

		$result=array();
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}

		return $result;
	}
	
	public function getComments($data){
		$query = $this->db->query("SELECT * from aa_lines_comments where line_id='".$data['cruise_id']."' order by create_date desc");
		$rows=$query->rows;

		return $rows;
	}
}
?>