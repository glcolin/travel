<?php
class ModelCertificatesCertificates extends Model {	
	
	public function getCertificates($data=array()){
		$limit = "";
		$where = "";
		if(isset($data['category'])){
			if($data['category']){
				$where .= "where category='".$data['category']."'";
			}
		}
		
		if(isset($data['start']) && isset($data['limit'])){
			$limit .= " limit ".$data['start'].",".$data['limit'];
		}
	
		$query = $this->db->query("SELECT * from aa_certificates ".$where." order by sort asc ".$limit);
		$rows=$query->rows;
		
		return $rows;
	}
	
	public function getCertificatesCount(){
	
		$query = $this->db->query("SELECT count(id) from aa_certificates");
		$row=$query->row;
		
		return $row['count(id)'];
	}
	
	public function getCategories($data=array()){
		$query = $this->db->query("SELECT * from aa_certificates_categories order by sort asc ");
		$rows=$query->rows;
		
		return $rows;
	}
}
?>