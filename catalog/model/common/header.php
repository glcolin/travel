<?php
class ModelCommonHeader extends Model {	
	
	public function getTopBanner($data=array()){
		$query = $this->db->query("SELECT image_url from aa_".$data['class_type']."_banners where language_id='".$data['language_id']."' and position='top' order by sort asc limit 1");
		$row=$query->row;

		return $row;
	}
	
}
?>