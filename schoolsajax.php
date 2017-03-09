<?php
	
	session_start();	

	if (!isset($_REQUEST['cmd'])) {
		echo '{"result": 0, "message": "Command not entered"}';
	}
	$command = $_REQUEST['cmd'];
	switch($command) {
		case 1:
		login();
		break;

		default:
		echo "wrong cmd";
		break;
	}



function login(){
	if (($_REQUEST['username']=="") || ($_REQUEST['pword']=="")) {
		echo '{"result":0, "message": "All information required was not given"}';
		return;
	}
	
	include_once("schools.php");
	$obj = new schools();
	$username = $_REQUEST['username'];
	$pword = $_REQUEST['pword'];
	
	$result = $obj->login($username,$pword);
	$row=$obj->fetch();
	
	if (!$row) {
		echo '{"result":0 ,"message": "Login Failed"}';
	}
	
	else {

	 echo '{"result":1, "message": "Login Successful"}';
	
	 $_SESSION['schoolid']=$row['schoolid'];

	}
}

?>