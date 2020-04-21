<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../core/Database.php';

class UserModel extends Database {

	protected $connection;

	public function __construct() {

		$this->connection = $this->dbConnect();
	}

	public function validate($email,$password) {

		$sql = "SELECT * FROM users WHERE email='$email' AND password=(md5('$password'))";
		$query = $this->connection->query($sql);
		$count = $query->num_rows;
		if ($count > 0) {
			return true;
		}
		return false;

	}

}