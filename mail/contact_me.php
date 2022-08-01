<?php

// Verificar campos vacios
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "¡No se proporcionaron argumentos!";
	return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
	
// Crear el correo electrónico y enviar el mensaje
$to = 'santiagors2611@gmail.com'; 
$email_subject = "Formulario de contacto del sitio web:  $name";
$email_body = "Ha recibido un nuevo mensaje del formulario de contacto de su sitio web.\n\n"."Aquí están los detalles:\n\Nombre: $name\n\Correo: $email_address\n\Mensaje:\n$message";
$headers = "From: nocontestar@proinmad.com.co\n";
$headers .= "Reply-To: $email_address";	

$prueba = mail($to,$email_subject,$email_body,$headers);
if($prueba){
   echo '<h1>Mensaje enviado correctamente</h1>';
}
else
{
   echo '<h1>No se envio</h1>';
}
return true;		
?>