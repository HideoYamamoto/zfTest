<?php

// アプリケーションパスとオートロードの初期化
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
set_include_path(implode(PATH_SEPARATOR, array(
    APPLICATION_PATH . '/../library',
    get_include_path(),
)));
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
 

$dbFile = "D:/src/zfTest/data/db/guestbook-dev.db";
chmod($dbFile, 0666);
$dsn = "sqlite:" . $dbFile;
$user = null;
$password = null;

print $dsn . "\n";

try{
	$dbh = new PDO($dsn, $user, $password);

//	$rowCount = $dbh->query("SELECT COUNT(*) FROM guestbook;")->fetchColumn(0);
//	echo $rowCount;

	$sql = "SELECT * FROM guestbook;";
	$stmt = $dbh->query($sql);
	while ($result = $stmt->fetch()) {
		echo $result['id'] . "  " . $result['email'] . "\n";
	}

}
catch (PDOException $e){
    print('Connection failed:'.$e->getMessage());
    die();
}

// echo phpinfo();

?>
