<?php
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Max-Age: 86400');

require __DIR__ . "/Includes/Bootstrap.php";

$utils = new Utils();
$uri = $utils->getURIs();

//Use .htaccess to remove index.php from url, if not all $uri indexes must be bumped up by 1
if ((isset($uri[1]) && $uri[1] !== 'item') || !isset($uri[2])) {
    header("HTTP/1.1 404 Not Found");
    $utils->sendOutput('Invalid API Call', $header);
    exit();
}

$database = new Database();
$header = array('Content-Type: application/json', 'HTTP/1.1 200 OK');
$body = '';

switch($uri[2]) {
	case 'get':
		$body = $database->getData();
		break;
	case 'set':
		$queryParams = $utils->getQueryParams();
		$body = $database->setData($queryParams['id'], $queryParams['complete']);
		break;
	case 'reset':
		$body = $database->resetData();
		break;
	default:
		$header = array('Content-Type: application/json', 'HTTP/1.1 500 Internal Server Error');
		$body = 'Error: '.$uri[2].' method of '.$uri[1].' type';
}
$utils->sendOutput($body, $header);
exit();