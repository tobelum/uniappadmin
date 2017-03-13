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

		case 2:
		getApplicants();
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

function getApplicants() {

	include_once("schools.php");
	$obj = new schools();
	
	// $a = $obj->getSchools();
	$schoolid = $_SESSION['schoolid'];

	$result = $obj->getApplicants($schoolid);



	if (!$result) {
		echo '{"result":0 ,"message": "Could not display applicants"}';
	}
	
	else {
		$row=$obj->fetch();
		echo '{"result":1,"row":[';
		while($row){
			echo json_encode($row);

			$row=$obj->fetch();
			if($row!=false){
				echo ",";
			}
		}
		echo "]}";	
	}
	
}


?>