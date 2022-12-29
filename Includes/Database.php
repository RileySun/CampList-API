<?php 

class Database {
	protected $dsn;
	
	public function __construct() {
		$this->$dsn = 'mysql:dbname='.DB_DATABASE_NAME.';host='.DB_HOST;
	}
	
	public function getData() {
		$pdo = new PDO($this->$dsn, DB_USERNAME, DB_PASSWORD);
		$newQuery = 'SELECT * FROM list;';
		$query = $pdo->prepare($newQuery);
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		$pdo = NULL;
		return json_encode($result);
	}
	
	public function setData($id, $complete) {		
		$pdo = new PDO($this->$dsn, DB_USERNAME, DB_PASSWORD);
		$newQuery = 'UPDATE list SET complete = :complete WHERE id = :id';
		$query = $pdo->prepare($newQuery);
		
		$query->bindParam(':complete', $complete);
		$query->bindParam(':id', $id);
		
		$result = $query->execute();
		return json_encode($result);
	}
	
	public function resetData() {		
		$pdo = new PDO($this->$dsn, DB_USERNAME, DB_PASSWORD);
		$newQuery = 'UPDATE list SET complete = 0;';
		$query = $pdo->prepare($newQuery);
		$result = $query->execute();
		return json_encode($result);
	}
}

?>