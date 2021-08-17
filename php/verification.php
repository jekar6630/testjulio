<?php
session_start();
require_once("connection.php");

if(isset($_POST['user']) && isset($_POST['pass'])){
	$_SESSION['login'] = false;
	
	if(isset($_POST['reg'])){
		$fetchx = $conn->prepare("SELECT * from admin_account where admin_user = :usg");
		$fetchx->execute(array(
			':usg'   => $_POST['user'],
		));
		$ck_int = $fetchx->rowCount();
		if($ck_int!=0){
			echo "{";
			echo '"status" : "invalid",';
			echo '"msg" : "The user is already registered"';
			echo "}";
		}
		else{
			$fetchx = $conn->prepare("INSERT INTO admin_account (admin_user, admin_pass) VALUES (:user, :pass)");
			$fetchx->bindParam(':user', $_POST['user']);
			$fetchx->bindParam(':pass', $_POST['pass']);

			if($fetchx->execute()){
				$_SESSION['login'] = true;
				echo "{";
				echo '"status" : "done",';
				echo '"next" : "http://localhost/dashboard/"';
				echo "}";
			}else{
				echo "{";
				echo '"status" : "invalid",';
				echo '"msg" : "An error occurred while registering the user"';
				echo "}";
			}
		}
	}else{
		$fetchx = $conn->prepare("SELECT * from admin_account where admin_user = :usg and admin_pass = :pwd");
		$fetchx->execute(array(
			':usg'   => $_POST['user'],
			':pwd'   => $_POST['pass']
		));

		$ck_int = $fetchx->rowCount();
		if($ck_int!=0){
			$_SESSION['login'] = true;
			echo "{";
			echo '"status" : "done",';
			echo '"next" : "http://localhost/dashboard/"';
			echo "}";
		}
		else{
			echo "{";
			echo '"status" : "invalid",';
			echo '"msg" : "Wrong credentials"';
			echo "}";
		}
	}
}
else{
	echo "{";
	echo '"status" : "invalid",';
	echo '"msg" : "Invalid request"';
	echo "}";
}
?>