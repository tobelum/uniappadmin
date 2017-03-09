<?php
     include_once("adb.php");
     
     /**
	*Variables used in all the functions for Students
	*@param int schoolid
	*@param string name
	*@param enum open 
	*@param string username
	*@param string pword
  *@param string street
  *@param string town
  *@param string region
	*/

class schools extends adb{
     function schools(){

     }

     function getSchools($applicantid){
          $strQuery="select * from school where schoolid not in( select schoolid from application where applicantid = '$applicantid')";
          
          return $this->query($strQuery);
     }

     function login($username,$pword){
          $strQuery="select schoolid from school where username='$username' and pword='$pword'";
          
          return $this->query($strQuery);
     }


   }


