<?php
class ControllerCommonFooter extends Controller {   
	protected function index() {
		
		$this->template = 'common/footer.tpl';
	
    	$this->render();
  	}
}
?>