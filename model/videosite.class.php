<?php
namespace userstudy;
require_once 'db/userstudydb.class.php';
require_once 'userstudy.class.php';

class VideoSite {
	
	//TODO static?
	public const VIDEO_PATH = "videos";
	private $sitenum = -1;
	private $video_id = "";
	private $video_title = "";
	private $video_full_name = "";
	private $video_file_format = "";

	function __construct($sitenum, $video_title, $video_file_format="mp4") {
		if (isset($_SESSION['userstudy'])) {
			$userstudy = unserialize($_SESSION['userstudy']);
		} else {
			throw new \Exception("Error: Can't restore userstudy from SESSION");
		}
		if ($sitenum > $userstudy->getNumberOfSubjects()) {
			throw new \InvalidArgumentException("The current userstudy does not have that much subjects");
		}
		$this->sitenum = $sitenum;
		$this->video_title = $video_title;
		$this->video_file_format = strtolower($video_file_format);
		$this->selectVideo();
		if ($this->video_full_name != "") {
			//$this->video_id = md5($this->video_full_name);
			// TODO better solution than fixed paths?
			$this->video_id = md5_file('../public/videos/'.$this->video_full_name);
		} else {
			echo "Error: Video-id could not be generated" . PHP_EOL;
		}
	}

	// choose between tnt and voca video on this site
	// Constraint: A: voca left, B: tnt left
	private function selectVideo()
	{
		$coin = mt_rand(0,1);
		$this->video_full_name = $this->video_title . ($coin ? "_A" : "_B") . "." .$this->video_file_format;
	}

	public function getVideoURL() {
		return self::VIDEO_PATH."/".$this->video_full_name;
	}

	public function saveVideoRating() 
	{
		//TODO
		if ($_POST['video_rating'] >= 0 || $_POST['video_rating'] <= 5) {
		    // just save the rating to db:
		    $udb = UserstudyDB::getDB();
		    $udb->writeRating(session_id(), $this->video_id, $_POST['video_rating']);
		} else {
		    // TODO error-handling
		    return;
		}
	}

	public function getSiteURL() {
		return "site.php";
	}

	public function getVideoId() {
		return $this->video_id;
	}
}
