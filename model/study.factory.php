<?php
namespace userstudy;
require_once 'userstudy.class.php';


final class StudyFactory {
	public function getStudy($subjects): Study {
		static $study = null;

		if ( null === $study ) {
			$study = new Userstudy($subjects);
		}

		return $study;
	}
}

/*
final class StudyProxy {
	public static function getStudy(): Study {
		static $study = null;

		if ( null === $study ) {
			$study = new Userstudy();
		}

		return $study;
	}

	public function getNumberOfSubjects()
	{
      // Forward call to actual implementation.
		self::get_study()->getNumberOfSubjects();
	}
	public function getFirstSiteURL() {
		self::get_study()->getFirstSiteURL();
	}
}*/
// TODO final  syntax error?

?>