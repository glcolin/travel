<?php
class ModelCommonColumnLeftInformation extends Model {	
	
	public function getInformations($data = array()){
		$where = "";
		if(isset($data['wonderful'])){
			$where .= "wonderful='".$data['wonderful']."'";
		}
		
		if($where){
			$where = "where ".$where;
		}
	
		$query = $this->db->query("SELECT * from aa_informations ".$where." order by sort asc,title asc");
		$rows=$query->rows;

		return $rows;
	}
}
?>