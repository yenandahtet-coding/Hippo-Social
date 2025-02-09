<?php

class User
{

	protected $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function checkInput($data)
	{
		$data = htmlspecialchars($data);
		$data = trim($data);
		$data = stripcslashes($data);
		return $data;
	}

	public function preventAccess($request, $currentFile, $currently)
	{
		if ($request == 'GET' && $currentFile == $currently) {
			header('Location:' . BASE_URL . 'index.php');
		}
	}

	public function search($search)
	{
		$stmt = $this->pdo->prepare("SELECT `user_id`,`username`,`screenName`,`profileImage`,`profileCover` FROM `users` WHERE `username` LIKE ? OR `screenName` LIKE ?");
		$stmt->bindValue(1, $search . '%', PDO::PARAM_STR);
		$stmt->bindValue(2, $search . '%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function login($email, $password)
	{
		$passwordHash = md5($password);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `isAdmin` FROM `users` WHERE `email` = :email AND `password` = :password');
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		$user = $stmt->fetch(PDO::FETCH_OBJ);

		if ($count > 0) {
			$_SESSION['user_id'] = $user->user_id;

			if ($user->isAdmin == 1) {
				$_SESSION['is_admin'] = true;
				header('Location: includes/admin_part/admindashboard.php'); // Redirect to admin dashboard
			} else {
				$_SESSION['is_admin'] = false;
				header('Location: index1.php'); // Redirect to user home page
			}
		} else {
			return false;
		}
	}

	public function register($email, $password, $screenName)
	{
		$passwordHash = md5($password);
		$stmt = $this->pdo->prepare("INSERT INTO `users` (`email`, `password`, `screenName`, `profileImage`, `profileCover`) VALUES (:email, :password, :screenName, 'assets/images/defaultprofileimage.png', 'assets/images/defaultCoverImage.png')");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password", $passwordHash, PDO::PARAM_STR);
		$stmt->bindParam(":screenName", $screenName, PDO::PARAM_STR);
		$stmt->execute();

		$user_id = $this->pdo->lastInsertId();
		$_SESSION['user_id'] = $user_id;
	}


	public function userData($user_id)
	{
		$stmt = $this->pdo->prepare('SELECT * FROM `users` WHERE `user_id` = :user_id');
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function logout()
	{
		$_SESSION = array();
		session_destroy();
		header('Location: ../index.php');
	}

	public function create($table, $fields = array())
	{
		$columns = implode(',', array_keys($fields));
		$values  = ':' . implode(', :', array_keys($fields));
		$sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

		if ($stmt = $this->pdo->prepare($sql)) {
			foreach ($fields as $key => $data) {
				$stmt->bindValue(':' . $key, $data);
			}
			$stmt->execute();
			return $this->pdo->lastInsertId();
		}
	}

	public function update($table, $user_id, $fields)
	{
		$columns = '';
		$i       = 1;

		foreach ($fields as $name => $value) {
			$columns .= "`{$name}` = :{$name} ";
			if ($i < count($fields)) {
				$columns .= ', ';
			}
			$i++;
		}
		$sql = "UPDATE {$table} SET {$columns} WHERE `user_id` = {$user_id}";
		if ($stmt = $this->pdo->prepare($sql)) {
			foreach ($fields as $key => $value) {
				$stmt->bindValue(':' . $key, $value);
			}
			$stmt->execute();
		}
	}

	public function delete($table, $array)
	{
		$sql   = "DELETE FROM " . $table;
		$where = " WHERE ";

		foreach ($array as $key => $value) {
			$sql .= $where . $key . " = '" . $value . "'";
			$where = " AND ";
		}
		$sql .= ";";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
	}

	public function checkUsername($username)
	{
		$stmt = $this->pdo->prepare("SELECT `username` FROM `users` WHERE `username` = :username");
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function checkPassword($password)
	{
		$stmt = $this->pdo->prepare("SELECT `password` FROM `users` WHERE `password` = :password");
		$md5 = md5($password);
		$stmt->bindParam(':password', $md5, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function checkEmail($email)
	{
		$stmt = $this->pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function loggedIn()
	{
		return (isset($_SESSION['user_id'])) ? true : false;
	}

	public function userIdbyUsername($username)
	{
		$stmt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE (`username`  = :username)");
		$stmt->bindParam("username", $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_OBJ);
		return $user->user_id;
	}

	public function uploadImage($file)
	{
		$filename   = $file['name'];
		$fileTmp    = $file['tmp_name'];
		$fileSize   = $file['size'];
		$errors     = $file['error'];

		$ext = explode('.', $filename);
		$ext = strtolower(end($ext));

		$allowed_extensions  = array('jpg', 'png', 'jpeg');

		if (in_array($ext, $allowed_extensions)) {

			if ($errors === 0) {

				if ($fileSize <= 2097152) {

					$root = 'users/' . $filename;
					move_uploaded_file($fileTmp, $_SERVER['DOCUMENT_ROOT'] . '/twitter/' . $root);
					return $root;
				} else {
					$GLOBALS['imgError'] = "File Size is too large";
				}
			}
		} else {
			$GLOBALS['imgError'] = "Only allowed JPG, PNG JPEG extensions";
		}
	}


	public function timeAgo($datetime)
	{
		$time    = strtotime($datetime);
		$current = time();
		$seconds = $current - $time;
		$minutes = round($seconds / 60);
		$hours   = round($seconds / 3600);
		$months  = round($seconds / 2600640);

		if ($seconds <= 60) {
			if ($seconds == 0) {
				return 'now';
			} else {
				return $seconds . 's';
			}
		} else if ($minutes <= 60) {

			return $minutes . 'm';
		} else if ($hours <= 24) {

			return $hours . 'h';
		} else if ($months <= 12) {

			return date('M j', $time);
		} else {
			return date('j M Y', $time);
		}
	}

	public function readUser()
	{
		$sql = "SELECT * FROM users";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	// delete by id
	public function deleteUser($id)
	{
		$sql = "DELETE FROM users WHERE user_id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->rowCount();
	}

	public function countUser(){
		$sql = "SELECT COUNT(*) as total FROM users";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		// $result = $stmt->fetch(PDO::FETCH_OBJ);
		return $stmt->fetch(PDO::FETCH_OBJ);;
	}

	//ban user form database and not access to login
	public function banUser($userId){
		$sql = "UPDATE users SET isBanded = 1 WHERE user_id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':id', $userId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->rowCount();
	}
	//unban user from database and access to login
	public function unbanUser($userId){
		$sql = "UPDATE users SET isBanded = 0 WHERE user_id = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':id', $userId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->rowCount();
	}

	public function getAdmin(){
		$sql = "SELECT * FROM users WHERE isAdmin = 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function getAdminProfile($admin_id)
{
    $sql = "SELECT * FROM users WHERE user_id = :admin_id AND isAdmin = 1";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}

	public function updateAdmin($admin_id, $name, $email, $Password, $profileImagePath){
		$passwordHash = md5($Password);
		$sql = "UPDATE users SET username = :name, email = :email, password = :Password, profileImage = :profileImage WHERE user_id = :admin_id AND isAdmin = 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':Password', $passwordHash, PDO::PARAM_STR);
		$stmt->bindParam(':profileImage', $profileImagePath, PDO::PARAM_STR);
		return $stmt->execute();
	}
}
