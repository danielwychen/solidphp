<?php
// require_once('build.php');

date_default_timezone_set('Pacific/Auckland');

$dbServer = '127.0.0.1';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'assignment';

spl_autoload_register(function($class)
{
  require 'classes/' . $class . '.php';
} );

$db = new SafeDB($dbServer, $dbUsername, $dbPassword, $dbName);

$comment = new Comment($db);

$login = new LoginHandler($db);
$like = new Like($db, $login);

$validator = new Validator();
$user = new User($db, $validator);

$lang = parse_ini_file('lang.ini');
$vocab = parse_ini_file('messages.ini', true);

function translate($content)
{
  global $lang;
  global $vocab;
  
  $langVocab = $lang['lang'];
  return $vocab[$langVocab][$content];
}