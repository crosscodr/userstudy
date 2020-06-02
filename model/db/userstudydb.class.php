<?php
namespace userstudy;

class UserstudyDB {

	private const PATH_TO_SQLITE_FILE = __DIR__.'/userstudy.db';
	private $db;
	

	function __construct() {
		$this->db = new \SQLite3(self::PATH_TO_SQLITE_FILE);

	}


	// already created db
	/*
	function createTables() {
		$this->db->exec("CREATE TABLE studyresults(session_id VARCHAR(64) NOT NULL, video_id CHARACTER(32) NOT NULL, rating TINYINT NOT NULL, PRIMARY KEY(session_id, video_id))");
		$this->db->exec("CREATE TABLE videos(video_id CHARACTER(32) PRIMARY KEY, name VARCHAR(128) NOT NULL, inst VARCHAR(32) NOT NULL)");

	}
	*/

	function writeRating($session_id, $video_id, $rating) {
		//TODO fight sql-injections
		//$this->db->exec("INSERT INTO studyresults(session_id, video_id, rating) VALUES ('$session_id', '$video_id', $rating)");
		$stmt = $this->db->prepare("REPLACE INTO studyresults(session_id, video_id, rating) VALUES (:sid, :vid, :rating)");
		if (!$stmt) {
			echo "failed to prepare sql statement";
			echo $this->db->lastErrorMsg();
			exit();
		}
		$stmt->bindValue(':sid', $session_id, SQLITE3_TEXT);
		$stmt->bindValue(':vid', $video_id, SQLITE3_TEXT);
		$stmt->bindValue(':rating', $rating, SQLITE3_INTEGER);

		$result = $stmt->execute();
		if (!$result) {
			echo $this->db->lastErrorMsg();
		}
	}

	

	function getVideoID($name) {
		$stmt = $this->db->prepare("SELECT video_id FROM videos WHERE name = ?");
		$stmt->bindValue(1, $name, SQLITE3_TEXT);
		$stmt = SQLite3::escapeString($stmt);

		$res = $stmt->execute();
		return $res;
	}

}
