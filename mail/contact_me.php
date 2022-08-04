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


require '../vendor/autoload.php';
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;

$access_token = 'EAAHi8qZB4ZAl8BABezVNs1q18lUSKvwYF3JgDKghZBkQuCivDElLwFPDbhTmw7lLPcbcZCeSF1ZBdjxesqcmDGRJg566BVZBQzd13ZAACkeEP1mnaZBvnPzRSYdkhr2WrYCUsRZAKzSrg4WBXXbbZASsAZBXtzbZClSqvPbM5ttO1EcgVPpb0VUT6uosTSe3LFr64ZA0ZD';

$pixel_id = '1947551268767297';

$api = Api::init(null, null, $access_token);
$api->setLogger(new CurlLogger());

$user_data = (new UserData())
    ->setEmails(array($email_address))
    // It is recommended to send Client IP and User Agent for Conversions API Events.
    ->setClientIpAddress($_SERVER['REMOTE_ADDR'])
    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
    ->setFbc('fb.1.1554763741205.AbCdEfGhIjKlMnOpQrStUvWxYz1234567890')
    ->setFbp('fb.1.1558571054389.1098115397');

$content = (new Content())
    ->setProductId('product123')
    ->setQuantity(1)
    ->setDeliveryCategory(DeliveryCategory::HOME_DELIVERY);


$event = (new Event())
    ->setEventName('Api Facebook')
    ->setEventTime(time())
    ->setEventSourceUrl('Persicor.com.co')
    ->setUserData($user_data)
    ->setActionSource(ActionSource::WEBSITE);

$events = array();
array_push($events, $event);

$request = (new EventRequest($pixel_id))
    ->setEvents($events);
$response = $request->execute();
echo "<script>console.log('Llega hasta aqui2')</script>";
?>