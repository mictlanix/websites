<?php
error_reporting(0);
$utm_source   = $_GET['utm_source'];
$utm_medium   = $_GET['utm_medium'];
$utm_campaign = $_GET['utm_campaign'];

require_once 'autoload.php';
use UnitedPrototype\GoogleAnalytics;

$tracker  = new GoogleAnalytics\Tracker('UA-36013283-2', 'tinbox.mx');

$visitor = new GoogleAnalytics\Visitor();
$visitor->setIpAddress($_SERVER['REMOTE_ADDR']);
$visitor->setUserAgent($_SERVER['HTTP_USER_AGENT']);
$visitor->setScreenResolution('1024x768');

$session = new GoogleAnalytics\Session();

$page = new GoogleAnalytics\Page('/mailing/views/' . $utm_source);
$page->setTitle('Email Views');

$campaign = new GoogleAnalytics\Campaign(GoogleAnalytics\Campaign::TYPE_DIRECT);
$campaign->setSource($utm_source);
$campaign->setMedium($utm_medium);
$campaign->setName($utm_campaign);

$tracker->setCampaign($campaign);
$tracker->trackPageview($page, $session, $visitor);

$im = @imagecreatetruecolor(1, 1) or die('cannot initialize image stream');
imagealphablending($im, true);
$transparent = imagecolorallocate($im, 0, 0, 0);
imagecolortransparent($im, $transparent);
//imagefilledrectangle($im, 0, 0, 1, 1, imagecolorallocate($im, 255, 0, 0));

header ('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
?>