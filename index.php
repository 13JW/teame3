<?php
require 'vendor/autoload.php';
date_default_timezone_set('America/New_York');

// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

// $log = new Logger('name');
// $log->pushHandler(new StreamHandler('app.txt', Logger::WARNING));
// $log->addWarning('Oh Noes.');

// echo 'Hello World!';

// $app->get('/hello/:name', function ($name) {
//     echo "Hello, $name";
// });

// $app = new \Slim\Slim();

// $app->get('/', function () {
//     echo 'Hello, this is the home page.';
// });

// $app->get('/tcontact', function () {
//     echo 'Feel free to contact us.';
// });

// $app->run();


$app = new \Slim\Slim( array(
  'view' => new \Slim\Views\Twig()
));

$view = $app->view();
$view->parserOptions = array(
    'debug' => true
);
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

$app->get('/', function() use($app){
  $app->render('gallery.twig');
})->name('home');

$app->get('/next', function() use($app){
  $app->render('next.twig');
})->name('next');
// })->name('home');

$app->get('/contactus', function() use($app){
  $app->render('contactus.twig');
})->name('contactus');

$app->post('/contactus', function() use($app){
  // var_dump($app->request->post());
	$name = $app->request->post('name');
	$email = $app->request->post('email');
	$msg = $app->request->post('msg');

	if(!empty($name) && !empty($email) && !empty($msg)) {
    $cleanName = filter_var($name, FILTER_SANITIZE_STRING);
    $cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $cleanMsg = filter_var($msg, FILTER_SANITIZE_STRING);
} else {

	//message to alert user of problem
	$app->redirect('/TeamE3/contactus');
}


$transport = Swift_MailTransport::newInstance('/usr/sbin/sendmail -bs');
// $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail');
// $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
// $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -t');

$mailer = \Swift_Mailer::newInstance($transport);
// $mailer = Swift_Mailer::newInstance($transport);

$message = \Swift_Message::newInstance();
// $message = Swift_Message::newInstance();

$message->setSubject('Email from our website');
$message->setFrom(array(
$cleanEmail => $cleanName
  ));
$message->setTo(array('jw-2001@lycos.com'));
$message->setBody($cleanMsg);

$result = $mailer->send($message);

if($result > 0) {
//send user a thank-you message
  $app->redirect('/');

} else {
//alert user that the message failed to xmit
// log that there was an error
$app->redirect('/TeamE3/contactus');
}

});

$app->run();

