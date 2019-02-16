<?php
/////////////////////////////////////////////////
// Vars
/////////////////////////////////////////////////
/*$name2 = $_POST["contact_name"];
$phone2 = $_POST["contact_phone"];
$email2 = $_POST["contact_email"];
$type2 = $_POST["contact_city"];
$preMessage2 = $_POST["contact_message"];*/
/////////////////////////////////////////////////
// Safety
/////////////////////////////////////////////////
function _filterEmail($email){
    $rule = array("\r" => '',
                  "\n" => '',
                  "\t" => '',
                  '"'  => '',
                  ','  => '',
                  '<'  => '',
                  '>'  => '',
    );

    return strtr($email, $rule);
}
function _filterName($name){
    $rule = array("\r" => '',
                  "\n" => '',
                  "\t" => '',
                  '"'  => "'",
                  '<'  => '[',
                  '>'  => ']',
    );

    return trim(strtr($name, $rule));
}
function _filterOther($data){
    $rule = array("\r" => '',
                  "\n" => '',
                  "\t" => '',
    );

    return strtr($data, $rule);
}
/////////////////////////////////////////////////
// Send Email
/////////////////////////////////////////////////
function sendEmail(){
	$name = _filterName($_POST["name"]);
	$email = _filterEmail($_POST["email"]);
	//$phone = _filterOther($_POST["contact_phone"]);
	// $type = _filterOther($_POST["city"]);
	$preMessage = _filterOther($_POST["message"]);

	$message = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body style="width:615px;margin:auto">
		<div style="clear:both;margin-top:10px"><img src="http://www.artecmanizales.com/portal-orion/images/logo-final-portal-de-orion.png"></div>
		<div style="margin-top:20px;width:100%;background-color:#ddd;float:left;font-size:25px;font-family:\'Arial\';color:#666;border-radius:20px">
			<div style="padding:10px 20px">
				<div style="color:#555">Mensaje Recibido de <strong>'.$name.'</strong></span>
				<div style="width:100%;height:2px;background-color:#aaa;margin-top:10px;margin-bottom:10px"></div>
				<div style="font-size:16px;text-align:justify">
					<span>'.$preMessage.'</span>
				</div>
				<div style="width:100%;height:2px;background-color:#aaa;margin-top:10px;margin-bottom:10px"></div>
				<div style="height:25px;font-size:20px">
					<span style="float:right"><strong>Email:</strong> '.$email.'</span>
				</div>
			</div>
		</div>
	</body></html>';

	// $headers = "From: " . $name . " <". $email . ">" . "\r\n";
	$headers = "From: Portal de Orion <portaldeorion@artecmanizales.com>" . "\r\n";
	$headers .= "Reply-To: portaldeorion@artecmanizales.com" . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$recipient = "portaldeorionartecconstructora@gmail.com";
	/*switch($type){
		case "Uno":
			$recipient = "jcoc611@gmail.com";
		break;
		case "Dos":
			$recipient = "dos@something.com";
		break;
		case "Tres":
			$recipient = "tres@something.com";
		break;
		default:
			echo $type;return false;
	}*/

	if($recipient != ""){ return mail($recipient, "Portal de Orion: Contacto En Linea", $message, $headers); }
	return false;
}

/////////////////////////////////////////////////
// Display Message
/////////////////////////////////////////////////
function displayMessage($message = ""){
	echo $message;
}
/////////////////////////////////////////////////
// Function
/////////////////////////////////////////////////
if(isset($_POST["name"]) /*&& isset($_POST["contact_phone"])*/ && isset($_POST["email"]) && isset($_POST["message"])){
	if(sendEmail()){
		displayMessage("Se ha enviado el mensaje.");
	}else{
		displayMessage("Error al enviar el mensaje.");
	}
}else{
	form();
}
?>
