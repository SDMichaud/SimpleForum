<?php
class DBFunctionsClass
{
    private $driver;
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $tablename;
    private $connection;

    public function __construct()
    {
	// Load settings from ini file
	$DBIniFilePath = (__DIR__ . "/../");
	$DBIniFile = $DBIniFilePath . "DBSettings.ini";
	
	$dbSettingsArr = $this->parseDBIni($DBIniFile);
	$this->driver = $dbSettingsArr['driver'];
	$this->servername = $dbSettingsArr['servername'];
	$this->username = $dbSettingsArr['username'];
	$this->password = $dbSettingsArr['password'];
	$this->dbname = $dbSettingsArr['dbname'];
	$this->tablename = $dbSettingsArr['tablename'];
	$this->connection = null;
    }
    
    public function parseDBIni($dbIniFile)
    {
	return parse_ini_file($dbIniFile);
    }
    public function openConnection()
    {
	try
	{
	    $this->connection = new PDO("{$this->driver}:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
	    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return true;
	}
	catch(PDOException $e)
	{
	    return false;
	}
    }
    public function closeConnection()
    {
	$this->connection = null;
    }

    public function getAllOP()
    {
	$SQL = "SELECT * FROM {$this->tablename} WHERE is_op=1 ORDER BY updated DESC";
	$stmt = $this->connection->prepare($SQL);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertOP($author, $subject, $content, $photo)
    {
	$SQL = "INSERT INTO {$this->tablename} (author, subject, content, photo, is_op) VALUES (:author, :subject, :content, :photo, :is_op)";
	$stmt = $this->connection->prepare($SQL);
	$stmt->execute( array(
	    ':author' => $author,
	    ':subject' => $subject,
	    ':content' => $content,
	    ':photo' => $photo,
	    ':is_op' => 1
	    ));
    }
}
?>
