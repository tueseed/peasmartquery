<?php 
require_once("vendor/autoload.php"); 

/* Start to develop here. Best regards https://php-download.com/ */
use Dialogflow\Action\Responses\BasicCard;
use Dialogflow\WebhookClient;
use PHPUnit\Framework\TestCase;


$agent = new WebhookClient(json_decode(file_get_contents('php://input'),true));
$intent = $agent->getIntent();
$parameters = $agent->getParameters();
//$agent->reply($parameters['text']);

$card = \Dialogflow\RichMessage\Card::create()
    ->title('This is title')
    ->text('this is text body')
    ->image('https://www.example.com/image.png')
    ->button('This is a button', 'https://docs.dialogflow.com/')
;
$agent->reply($card);




header('Content-type: application/json');
echo json_encode($agent->render());
