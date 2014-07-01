<?php
class ModelCertificatesCertificate extends Model {	
	
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
	
	public function getCertificate($data=array()){
		$query = $this->db->query("SELECT * from aa_certificates where id='".$data['id']."'");
		$row=$query->row;
		
		return $row;
	}
	
	public function getAuthorName($author_id){
		$query = $this->db->query("SELECT username from aa_user where user_id='".$author_id."'");
		$row=$query->row;
		
		return $row;
	}
	
	public function getCategories($data=array()){
		$query = $this->db->query("SELECT * from aa_certificates_categories order by sort asc ");
		$rows=$query->rows;
		
		return $rows;
	}
}
?>