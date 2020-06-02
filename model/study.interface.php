<?php
namespace userstudy;
interface Study {
	public function getNumberOfSubjects();
	public function getFirstSiteURL();
	public function getSubjects();
	public function getSubject($num);
}
?>