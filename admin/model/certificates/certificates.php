<?php
class ModelCertificatesCertificates extends Model {
	
	public function getTotalCertificates($data = array()){
		$query = $this->db->query("SELECT * from aa_certificates order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
	
	public function getCertificate($id) {
		$query = $this->db->query("SELECT * from aa_certificates where id=".$id);
		$row=$query->row;
				
		return $row;
	}
	
	public function getCategories() {
		$query = $this->db->query("SELECT * from aa_certificates_categories order by sort asc,title asc");
		$rows=$query->rows;
				
		$result = array();
		
		foreach($rows as $row){
			$result[$row['id']] = $row['title'];
		}		
				
		return $result;
	}
	
	public function addCertificate($data=array()){
	// print_r($data);
		
		$query = $this->db->query("insert into aa_certificates (title,content,image_url,author,category,update_date,create_date,seo_keywords,seo_description) values ('".$this->db->escape($data['item_title'])."','".$this->db->escape($data['item_content'])."','".$data['item_image']."','".$this->user->getUserId()."','".$data['item_category']."',now(),now(),'".$this->db->escape($data['item_seo_keywords'])."','".$this->db->escape($data['item_seo_description'])."')");
	}
	
	public function deleteCertificate($data=array()){
		foreach($data['selected'] as $id){
			$this->db->query("delete from aa_certificates where id=".$id);
		}
	}
	
	public function update_certificate($data=array()){
			$this->db->query("update aa_certificates set 
			title='".$this->db->escape($data['item_title'])."',
			content='".$this->db->escape($data['item_content'])."',
			image_url='".$data['item_image']."',
			category='".$data['item_category']."',
			update_date = now(),
			seo_keywords='".$this->db->escape($data['item_seo_keywords'])."',
			seo_description='".$this->db->escape($data['item_seo_description'])."'  
			where id=".$data['item_id']);
	}
	
	public function saveSort($data=array()){
		$sort_arr=json_decode(htmlspecialchars_decode($data['sort_string']));

		foreach($sort_arr as $key=>$id){
			$query=$this->db->query("update aa_certificates set sort='".$key."' where id='".$id."'");
		
		}
	}
}
?>
