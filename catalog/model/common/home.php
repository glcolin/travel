<?php
class ModelCommonHome extends Model {	
	
	public function getInformations($data = array()){
		$where = "";
		$limit = "";
		
		if(isset($data['wonderful'])){
			$where .= " and wonderful='".$data['wonderful']."'";
		}
		
		if(isset($data['category'])){
			$where .= " and category='".$data['category']."'";
		}
		
		if($where){
			$where = "where 1 ".$where;
		}
		
		if(isset($data['limit'])){
			$limit .= " limit 0,".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_informations ".$where." order by sort asc,title asc".$limit);
		$rows=$query->rows;

		return $rows;
	}
	
	public function getSpecialAreas(){
		$query = $this->db->query("SELECT id from aa_areas where special=1 order by sort asc limit 1");
		$row=$query->row;
		return $row['id'];
	}
	
	public function getBanners($data=array()){
		$query = $this->db->query("SELECT * from aa_homebanners where 1 order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getOtherBanners($data=array()){
		$query = $this->db->query("SELECT * from aa_otherbanners where type='".$data['type']."' order by sort asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getTotalFriendlinks($data = array()){
		$query = $this->db->query("SELECT * from aa_friendlinks order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
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
	
	public function getLines($data=array()){
		$where = "";
		$limit = "";
		$order = " order by sort asc ";
		
		$query = $this->db->query("SELECT id from aa_areas where special=1 order by sort asc limit 1");
		$area=$query->row;
		$where .= "and area!='".$area['id']."'";
		
		if(isset($data['sale_price'])){
			$where .= " and original_price!='0'";
		}
		
		if(isset($data['latest'])){
			$order = " order by create_date desc ";
		}
		
		if(isset($data['hot'])){
			$where .= " and hot='".$data['hot']."'";
		}
		
		if($where){
			$where = "where 1 ".$where;
		}
		
		if(isset($data['limit'])){
			$limit .= " limit 0,".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_lines ".$where.$order.$limit);
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getSpecialLines($data=array()){
		$where = "";
		$limit = "";
		
		$query = $this->db->query("SELECT id from aa_areas where special=1 order by sort asc limit 1");
		$area=$query->row;
		
		
		$where .= " area='".$area['id']."'";
		
		if($where){
			$where = "where ".$where;
		}
		
		if(isset($data['limit'])){
			$limit .= " limit 0,".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_lines ".$where." order by sort asc ".$limit);
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getCertificates($data = array()){
		$where = "";
		$limit = "";
		
		if($where){
			$where = "where 1 ".$where;
		}
		
		if(isset($data['limit'])){
			$limit .= " limit 0,".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_certificates ".$where." order by sort asc,title asc".$limit);
		$rows=$query->rows;

		return $rows;
	}
	
	public function getFromcitys(){
		$query = $this->db->query("SELECT * from aa_fromcitys order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getEndcitys(){
		$query = $this->db->query("SELECT * from aa_endcitys order by sort asc");
		$rows=$query->rows;
		
		return $rows;
	}
	
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
	
}
?>