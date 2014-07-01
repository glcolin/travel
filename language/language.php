<?php

/* 
This file is in grobal level 
Variable Names such as TXT() $LANGUAGE EN CN are reserved.
*/

define('EN',1);
define('CN',2);
define('CT',3);

$session->data['languages']=array ( 
						'1' => array ( 'language_id' => 1, 'name' => 'English', 'code' => 'EN', 'image'=>'gb.png'),
						'2' => array ( 'language_id' => 2, 'name' => 'Chinese', 'code' => 'CN', 'image'=>'cn.png'),
						'3' => array ( 'language_id' => 3, 'name' => 'Chinese Traditional', 'code' => 'CT', 'image'=>'cn.png')
						) ;

if(!isset($session->data['language'])){
	//Give it a default value:
	$session->data['language'] = EN;
}

switch($session->data['language']){
	case EN:
		require_once(DIR_HOME . 'language/EN.php');
		break;
	case CN:
		require_once(DIR_HOME . 'language/CN.php');
		break;
	case CT:
		require_once(DIR_HOME . 'language/CT.php');
		break;	
	default:
		//echo 'Error: failed to load language dictionary!';
		//exit();
		$session->data['language'] = EN;
		require_once(DIR_HOME . 'language/EN.php');
		break;
}

function TXT($key){
	global $LANGUAGE;
	return isset($LANGUAGE[$key])?$LANGUAGE[$key]:'<font style="color:red;">'.$key.'</font>'; 
}