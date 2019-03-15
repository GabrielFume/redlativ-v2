<?php
	
	$destination = "redlativ@gmail.com"; // email address of destination
	
	error_reporting (E_ALL ^ E_NOTICE);

	function validate_email($email)
	{
		$regex = '/([a-z0-9_.-]+)'. 
		'@'. 
		'([a-z0-9.-]+){2,255}'. 
		'.'. 
		'([a-z]+){2,10}/i'; 
		
		if($email == '') 
			return false;
		else
			$eregi = preg_replace($regex, '', $email);
		return empty($eregi) ? true : false;
	}

	$post = (!empty($_POST)) ? true : false;
	
	if($post)
	{
		$name 	 = stripslashes($_POST['name']);
		$email 	 = trim($_POST['email']);
		$subject = trim($_POST['subject']);
		$message = stripslashes($_POST['message']);
	
		$error = '';
	
		if(!$name)
			$error .= 'Nombre requerido!';
	
		if(!$email)
			$error .= 'Correo requerido!';
	
		if($email && !validate_email($email))
			$error .= 'Correo electronico no es valido';
	
		if(!$message)
			$error .= "¡Por favor ingrese su mensaje!";
	
		if(!$error)
		{
			$mail = @mail($destination, $subject, $message,
				 "From: ".$name."\r\n"
				."Reply-To: ".$email."\r\n"
				."Return-Path: " .$email. "\r\n"
				."MIME-Version: 1.0\r\n"	
				."Content-type: text/html; charset=UTF-8\r\n");
			
			if($mail){
				echo 'OK';
			}else{
				echo 'No se pudo enviar el correo electrónico!';
			}
		}
		else
			echo $error;
	}

?>