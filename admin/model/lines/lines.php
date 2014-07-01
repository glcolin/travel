<?php
class ModelLinesLines extends Model {
	
	public function getTotalLines($data = array()){
		$where = "where 1";
		if(isset($data['filter_area'])){
			if($data['filter_area']){
				$where .= " and area='".$data['filter_area']."'";
			}
		}
	
		$query = $this->db->query("SELECT * from aa_lines ".$where." order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getLine($id) {
		$query = $this->db->query("SELECT * from aa_lines where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function addLine($data=array()){
		$accommodation_fee_arr = array(
			1=>array(
				0=>$data['fee_1_0'],
				1=>0
				),
			2=>array(
				0=>$data['fee_2_0'],
				1=>$data['fee_2_1']
				),
			3=>array(
				0=>$data['fee_3_0'],
				1=>$data['fee_3_1']
				),
			4=>array(
				0=>$data['fee_4_0'],
				1=>$data['fee_4_1']
				)
		);
		$accommodation_fee_str = json_encode($accommodation_fee_arr);
		
		$boardinglocations_str = isset($data['item_boardinglocations'])?json_encode($data['item_boardinglocations']):'';
		
		$informations_str = isset($data['item_main_attractions'])?json_encode($data['item_main_attractions']):'';
		
		$query = $this->db->query("insert into aa_lines (title,hot,area,content,otherfee,image_url,serial_number,from_city,departure_dates,boarding_locations,main_attractions,end_city,active_date,days,integral,original_price,price,images,accommodation_fee,create_date,update_date,seo_keywords,seo_description) values (
					'".$this->db->escape($data['item_title'])."',
					'".$data['item_hot']."',
					'".$data['item_area']."',
					'".$this->db->escape($data['item_content'])."',
					'".$this->db->escape($data['item_otherfee'])."',
					'".$data['item_image']."',
					'".$data['item_serial_number']."',
					'".$data['item_from_city']."',
					'".$data['item_departuredates']."',
					'".$boardinglocations_str."',
					'".$informations_str."',
					'".$data['item_end_city']."',
					'".$data['item_active_date']."',
					'".$data['item_days']."',
					'".$data['item_integral']."',
					'".$data['item_original_price']."',
					'".$data['item_price']."',
					'".$this->db->escape($data['item_images'])."',
					'".$this->db->escape($accommodation_fee_str)."',
					now(),
					now(),
					'".$this->db->escape($data['item_seo_keywords'])."',
					'".$this->db->escape($data['item_seo_description'])."'
					)"
				 );
	}
	
	public function deleteLine($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_lines where id=".$id);
		}
	}
	
	public function update_line($data=array()){
		$accommodation_fee_arr = array(
			1=>array(
				0=>$data['fee_1_0'],
				1=>0
				),
			2=>array(
				0=>$data['fee_2_0'],
				1=>$data['fee_2_1']
				),
			3=>array(
				0=>$data['fee_3_0'],
				1=>$data['fee_3_1']
				),
			4=>array(
				0=>$data['fee_4_0'],
				1=>$data['fee_4_1']
				)
		);
		$accommodation_fee_str = json_encode($accommodation_fee_arr);
		
		$boardinglocations_str = isset($data['item_boardinglocations'])?json_encode($data['item_boardinglocations']):'';
		
		$informations_str = isset($data['item_main_attractions'])?json_encode($data['item_main_attractions']):'';
	
		$this->db->query("update aa_lines set 
		title='".$this->db->escape($data['item_title'])."',
		hot='".$data['item_hot']."',
		area='".$data['item_area']."',
		content='".$this->db->escape($data['item_content'])."',
		otherfee='".$this->db->escape($data['item_otherfee'])."',
		image_url='".$data['item_image']."',
		serial_number='".$data['item_serial_number']."',
		from_city='".$data['item_from_city']."',
		departure_dates='".$data['item_departuredates']."',
		boarding_locations='".$boardinglocations_str."',
		main_attractions='".$informations_str."',
		end_city='".$data['item_end_city']."',
		active_date='".$data['item_active_date']."',
		days='".$data['item_days']."',
		integral='".$data['item_integral']."',
		original_price='".$data['item_original_price']."',
		price='".$data['item_price']."',
		images='".$this->db->escape($data['item_images'])."',
		accommodation_fee='".$accommodation_fee_str."',
		update_date=now(),
		seo_keywords='".$this->db->escape($data['item_seo_keywords'])."',
		seo_description='".$this->db->escape($data['item_seo_description'])."'
		where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_lines set sort='".$key."' where id='".$id."'");
		
		}
	}
	
	public function getAreas(){
		$query = $this->db->query("SELECT * from aa_areas order by sort asc,title asc");
		$rows=$query->rows;
		
		$result=array();
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
	
	public function getBoardingLocations(){
		$query = $this->db->query("SELECT * from aa_boardinglocations order by sort,title asc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getAttractions(){
		$query = $this->db->query("SELECT * from aa_attractions  where 1 order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
}
?>
