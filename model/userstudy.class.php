<?php
namespace userstudy;

//TODO refactor to UserVideoStudy?
require_once 'study.interface.php';
 /**
 * Class Userstudy
 */
class Userstudy implements Study
{
	
	private $videocount = 0;
	private $shuffled_video_list = array();
	//private $videosites = array();

	/**
	 * Userstudy constructor
	 * params: subjects String array of study subjects (e.g. list of videos)
	 *
	 * @return void
	 **/
	function __construct($subjects)
	{
		//$this->createVideoSites(shuffle($video_list));
		if (!is_array($subjects)) {
			// error handling
			// TODO define invalidarexc
			throw new Exception();
		}
		$this->videocount = count($subjects);
		if (shuffle($subjects)) {
			$this->shuffled_video_list = $subjects;
		}
	}


	/*
	public function createVideoSites($video_list)
	{
		for ($i=0; $i < count($video_list); $i++) {
			$this->videosites[$i] = new VideoSite($i, $video_list[$i]);
		}
	}*/

	public function getNumberOfSubjects()
	{
		return $this->videocount;
	}

	public function getSubjects() {
		return $this->shuffled_video_list;
	}

	public function getSubject($num) {
		return $this->shuffled_video_list[$num];
	}

	public function getFirstSiteURL()
	{
		return "site.php?sitenum=0";
	}
}
?>