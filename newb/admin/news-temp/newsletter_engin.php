<?php
class Newsletter {
	private $pdo = null;
	private $stmt = null;
	private $headers = "";
	private $subject = "";

	function __construct(){
		try {
			$this->pdo = new PDO(
				"mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET, 
				DB_USER, DB_PASSWORD, [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_EMULATE_PREPARES => false,
				]
			);
		} catch (Exception $ex) {
      die($ex->getMessage());
		}
	}

	function __destruct(){
		if ($this->stmt!==null) { $this->stmt = null; }
		if ($this->pdo!==null) { $this->pdo = null; }
	}

	function count(){
		$sql = "SELECT COUNT(*) `cnt` FROM `customer_info`";
		$this->stmt = $this->pdo->prepare($sql);
		$this->stmt->execute();
		$result = $this->stmt->fetchAll();
		return $result[0]['cnt'];
	}

	function get($start=0, $end=10){
		$sql = "SELECT * FROM `customer_info` LIMIT ?,?";
		$this->stmt = $this->pdo->prepare($sql);
		$this->stmt->execute([$start, $end]);
		return $this->stmt->fetchAll();
	}

	function prime($headers="", $subject=""){
		$this->headers = $headers;
		$this->subject = $subject;
	}

	function send($to, $message){
		mail($to, $this->subject, $message, $this->headers);
	}
}
?>