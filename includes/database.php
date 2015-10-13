<?php
/*
 * Class Database: interface to the movie database from PHP.
 *
 * You must:
 *
 * 1) Change the function userExists so the SQL query is appropriate for your tables.
 * 2) Write more functions.
 *
 */
class Database {
	private $host;
	private $userName;
	private $password;
	private $database;
	private $conn;
	
	/**
	 * Constructs a database object for the specified user.
	 */
	public function __construct($host, $userName, $password, $database) {
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
		$this->database = $database;
	}
	
	/** 
	 * Opens a connection to the database, using the earlier specified user
	 * name and password.
	 *
	 * @return true if the connection succeeded, false if the connection 
	 * couldn't be opened or the supplied user name and password were not 
	 * recognized.
	 */
	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", 
					$this->userName,  $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	/**
	 * Closes the connection to the database.
	 */
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}
	
	/**
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		$this->openConnection();
		try {
			$this->conn->beginTransaction();
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollBack();
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		$this->closeConnection();
		return $result;
	}
	
	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $param = null) {
		$this->openConnection();
		try {
			$this->conn->beginTransaction();
			$stmt = $this->conn->prepare($query);
			$i=1;
			foreach($param as &$par){
				$stmt->bindParam($i, $par);
				$i++;
			}
			$result = $stmt->execute();
			$this->conn->commit();
		} catch (Exception $e) {
			$this->conn->rollBack();
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		$this->closeConnection();
		return $stmt->rowCount();
	}
	
	/**
	 * Check if a user with the specified user id exists in the database.
	 * Queries the Users database table.
	 *
	 * @param userId The user id 
	 * @return true if the user exists, false otherwise.
	 */
	public function userExists($userId) {
		$sql = "SELECT userName FROM users WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userId));
		return count($result) == 1; 
	}
	
	/**
	*Check if the provided password is correct.
	*Verifies hashed passwords.
	*Queries the Users database table.
	*
	*@param userName The userName
	*@param passWord The password
	*
	*@return true if the password is correct, false otherwise.
	*/
	public function checkPassword($userName, $passWord){
		$sql = "SELECT passWord FROM users WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		foreach($result as $pass){
			$result = $pass[0];
		}
		
		if (password_verify($passWord, $result)) {
			return true;
		}
		return false;
	}
	
	/**
	*Create a new user.
	*
	*@param userName the name of the new user.
	*@param password the users password.
	*@userType the type of the user.
	*
	**/
	public function createUser($userName, $password, $address, $email) {
		$sql = "INSERT INTO users(userName, passWord, address, email) VALUES(?, ?, ?, ?)";
		$result = $this->executeUpdate($sql, array($userName, $password, $address, $email));
	}
	
	/**
	*Delete a user.
	*
	**/
	public function deleteUser($userName) {
		$sql = "DELETE FROM users WHERE userName = ?";
		$result = $this->executeUpdate($sql, array($userName));
	}
	
	/**
	*List all users in the system.
	*
	*@return all users with username, in order.
	*/
	public function listUsers() {
		$sql = "SELECT userName FROM users ORDER BY userName";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	/**
	*List 3 promoted products.
	*
	*@return the three promoted products.
	**/
	public function listPromotedProducts() {
		$sql = "SELECT * FROM products LIMIT 3";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	/**
	*List all products.
	*
	*@return all products.
	**/
	public function listAllProducts() {
		$sql = "SELECT * FROM products WHERE productId > 3 ORDER BY productName";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	/**
	*Get products, paginated.
	*
	*@return all products for certain page.
	**/
	public function getProductsPaginate($page, $num_per_page) {
		$start_from = ($page-1) * $num_per_page;
		$sql = "SELECT * FROM products WHERE productId > 3 LIMIT $start_from, $num_per_page";
		$result = $this->executeQuery($sql);
		return $result;
	}
	
	/**
	*Get total number of pages needed for pagination.
	*
	*@return totalt number of pages.
	**/
	public function getPages($num_per_page) {
		$sql = "SELECT productId FROM products WHERE productId > 3";
		$result = $this->executeQuery($sql);
		$total_records = count($result);
		$total_pages = ceil($total_records / $num_per_page);
		return $total_pages;
	}
	
	/**
	*Add product to shopping cart for user.
	**/
	public function addProductToCart($userName, $productId) {
		$sql = "INSERT INTO productsforuser(userName, productId) VALUES (?, ?)";
		$result = $this->executeUpdate($sql, array($userName, $productId));
	}
	
	/**
	*Get all products from active shopping cart for user.
	*
	*
	*@return all products.
	**/
	public function getCart($userName) {
		$sql = "SELECT * FROM productsforuser WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		return $result;
	}
	
	/**
	*Get product info from id.
	*
	*@return the product info.
	**/
	public function getProductInfo($id) {
		$sql = "SELECT * FROM products WHERE productId = ?";
		$result = $this->executeQuery($sql, array($id));
		return $result;
	}
	
	public function getSum($userName) {
		$sql ="SELECT SUM(price) FROM productsforuser NATURAL JOIN products WHERE userName = ?";
		$result = $this->executeQuery($sql, array($userName));
		return $result;
	}
	
	public function deleteCart($userName) {
		$sql = "DELETE FROM productsforuser WHERE userName = ?";
		$result = $this->executeUpdate($sql, array($userName));
	}
	
}

/* General functions */

function echo_array($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function validateTime($date){
    $d = DateTime::createFromFormat("Y-m-d H:i", $date);
    return $d && $d->format("Y-m-d H:i") == $date;
}

function validateDate($date){
    $d = DateTime::createFromFormat("Y-m-d", $date);
    return $d && $d->format("Y-m-d") == $date;
}

function sanitize($input){
	return strip_tags(trim($input));
}

function validateText($text, $min_length, $max_length){
	if(empty($text)){
		return false;
	}
	if(!is_string($text)){
		return false;
	}
	if(strlen($text)<$min_length || strlen($text)>$max_length){
		return false;
	}
	return true;
}

function validateInt($int){
	if(empty($int)){
		return false;
	}
	if(!is_int($int)){
		return false;
	}
	return true;
}

function setPage($input){
	if (!empty($input)){ 
		$page_u = sanitize($input);
		if(validateInt((int)$page_u)){
			return $page_u;
		}
	} 
	return 1;
}

?>
