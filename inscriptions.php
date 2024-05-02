<?php 




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'conection/conexion.php';

 function set_response($status,$description,$data){


 	return array('status'=>$status,'description'=>$description,'data'=>$data);


 }



function set_random_str($length = 10)
{
    $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $pieces = [];

    $max = mb_strlen($stringSpace, '8bit') - 1;

    for ($i = 0; $i < $length; ++ $i) {

        $pieces[] = $stringSpace[random_int(0, $max)];

    }

    return implode('', $pieces);
}


function set_comprobante(){


	if(isset($_FILES['comprobante'])) {

    	$archivo = $_FILES['comprobante'];

    	if($archivo['error'] === UPLOAD_ERR_OK) {
        

	        $carpetaDestino = 'comprobantes/';
	        //$nombreArchivo = $archivo['name'];
	        $ubicacionTemporal = $archivo['tmp_name'];

        

        	


        	//


        	$fileName = $_FILES['comprobante']['name'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			$comprobante = set_random_str().'.' . $fileExtension;


	//		


			$rutaDestino = $carpetaDestino . $comprobante;


	        if (move_uploaded_file($ubicacionTemporal, $rutaDestino)) {

	        	return set_response('ok','el archivo se ha movido correctamente',$rutaDestino);

	     

	        } else {

	        	return set_response('error','error al mover el archivo a la carpeta',[]);
	           
	        }

    	} else {

        	return set_response('error','error al subir fichero',[]);
    	}

	} else {

    	return set_response('error','no se ha enviado ningun fichero',[]);
	}



}


function send_email($data,$file){



	$mail = new PHPMailer(true);

	try {
	    
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
	    $mail->isSMTP();                                            
	    $mail->Host       = 'smtp.gmail.com';                     
	    $mail->SMTPAuth   = true;                                   
	    $mail->Username   = 'sistemasrobles23@gmail.com';                     
	    $mail->Password   = 'fsfd tsdg pous pbif';                              
	    $mail->SMTPSecure = 'tls';           
	    $mail->Port       = 587;                                    

	   
		$mail->CharSet = 'UTF-8';

		 $mail->setFrom('sistemasrobles23@gmail.com', 'Gamer National League');


		$mail->addCC('miguel.alfonzo@killyazu.com.pe');
	    $mail->addAddress('gamernationleague@gmail.com');   

	   
	   
	  
	    $mail->addAttachment($file);    

	    
	    $mail->isHTML(true); 

	    $mail->Subject = 'REGISTRO EVENTO GAMER DOTA2';

	    $mail->Body    = 'Nombre del equipo : '.$data["nameTeam"].'<br>'.'Nombre del Capitan : '.$data["NameCapitan"].'<br>'.'Celular del capitan : '.$data["TelCapitan"].'<br>'.'Nombre del Jugador N°2 : '.$data["NamePlayer2"].'<br>'.'Celular del Jugador N°2 : '.$data["TelPlayer2"].'<br>'.'Nombre del Jugador N°3 : '.$data["NamePlayer3"].'<br>'.'Celular del Jugador N°3 : '.$data["TelPlayer3"].'<br>'.'Nombre del Jugador N°4 : '.$data["NamePlayer4"].'<br>'.'Celular del Jugador N°4 : '.$data["TelPlayer4"].'<br>'.'Nombre del Jugador N°5 : '.$data["NamePlayer5"].'<br>'.'Celular del Jugador N°5 : '.$data["TelPlayer5"].'<br>';
	   


	    $mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
		);



	    if($mail->send()){


	    	return set_response('ok','correo enviado de forma correcta',[]);


	    }else{


	    	return set_response('error','no se pudo enviar el correo',[]);
	    }

	    


	} catch (Exception $e) {


		return set_response('error',$e->getMessage(),[]);


	    
	}


}


$is_valid_fichero = set_comprobante();


if ($is_valid_fichero["status"] == "ok" ) {

	

  $nameTeam    = $_POST['nameTeam'];
  $NameCapitan = $_POST['NameCapitan'];
  $TelCapitan = $_POST['TelCapitan'];
  $NamePlayer2 = $_POST['NamePlayer2'];
  $TelPlayer2 = $_POST['TelPlayer2'];
  $NamePlayer3 = $_POST['NamePlayer3'];
  $TelPlayer3 = $_POST['TelPlayer3'];
  $NamePlayer4 = $_POST['NamePlayer4'];
  $TelPlayer4 = $_POST['TelPlayer4'];
  $NamePlayer5 = $_POST['NamePlayer5'];
  $TelPlayer5 = $_POST['TelPlayer5'];

  $protocolo =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ?'https://':'http://';

  $comprobante  = $protocolo.$_SERVER['SERVER_NAME'].'/'.$is_valid_fichero["data"];


  date_default_timezone_set('America/Lima');


  $now  = date('Y-m-d H:i:s');


  		$sql = "INSERT INTO inscriptions(team,capitan,phone_capitan,player_2,phone_player_2,player_3,phone_player_3,player_4,phone_player_4,player_5,phone_player_5,comprobante,created_at)VALUES(:team,:capitan,:phone_capitan,:player_2,:phone_player_2,:player_3,:phone_player_3,:player_4,:phone_player_4,:player_5,:phone_player_5,:comprobante,:created_at)";


        $statement = $pdo->prepare($sql);
        $statement->bindParam(':team', $nameTeam, \PDO::PARAM_STR,1000);
        $statement->bindParam(':capitan', $NameCapitan, \PDO::PARAM_STR,1000);
        $statement->bindParam(':phone_capitan', $TelCapitan, \PDO::PARAM_STR,1000);
        $statement->bindParam(':player_2', $NamePlayer2, \PDO::PARAM_STR,1000);
        $statement->bindParam(':phone_player_2', $TelPlayer2, \PDO::PARAM_STR,1000);
        $statement->bindParam(':player_3', $NamePlayer3, \PDO::PARAM_STR,1000);
        $statement->bindParam(':phone_player_3', $TelPlayer3, \PDO::PARAM_STR,1000);
        $statement->bindParam(':player_4', $NamePlayer4, \PDO::PARAM_STR,1000);
        $statement->bindParam(':phone_player_4', $TelPlayer4, \PDO::PARAM_STR,1000);
        $statement->bindParam(':player_5', $NamePlayer5, \PDO::PARAM_STR,1000);
        $statement->bindParam(':phone_player_5', $TelPlayer5, \PDO::PARAM_STR,1000);
        $statement->bindParam(':comprobante', $comprobante, \PDO::PARAM_STR,1000);
        $statement->bindParam(':created_at', $now, \PDO::PARAM_STR,1000);
        $statement->execute();


        $rowsAffected = $statement->rowCount();


        if ($rowsAffected == 1) {
    		
    		

        	$middleSend = send_email($_POST,$is_valid_fichero["data"]);

        	var_dump($middleSend);
        	
        	die();

        	$response = set_response('ok','se procesó correctamente el registro',[]);

		} else {
		 	

			$response = set_response('error','no se pudo agregar el registro',[]);
		}


       
        echo  json_encode($response); 




}else{

	

	$response = set_response('error','no se pudo agregar el registro , intentelo mas tarde',[]);
	echo json_encode($response); 
   
}





