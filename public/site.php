<?php
namespace userstudy;
session_start();
require_once '../model/videosite.class.php';
require_once '../model/db/userstudydb.class.php';
require_once '../util.php';

if (!isset($_GET['sitenum'])) {
	goto_index();
}

$sitenum = test_input($_GET['sitenum']);
if (!is_numeric($sitenum)) {
	goto_index();
}


if (isset($_SESSION['userstudy'])) {
	$userstudy = unserialize($_SESSION['userstudy']);
	if ($userstudy != false) {
		//TODO proper error-handling
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sitenum']) && $_POST['sitenum'] == $sitenum - 1) {
			if (empty($_POST["video_rating"])) {
				$nameErr = "Bitte gib eine Bewertung ab!";
				$sitenum = $sitenum - 1;
		 	} else {
				$udb = new UserstudyDB();

				//could be done better, but no time atm
				$videosite = new VideoSite($sitenum -1, $userstudy->getSubject($sitenum -1));
				$udb->writeRating(session_id(), $videosite->getVideoId(), $_POST['video_rating']);
			}
		}

		if ($sitenum == $userstudy->getNumberOfSubjects()) {
			header("Location: thank-you.php");
			exit();
		}
		$video_name = $userstudy->getSubject($sitenum);
	} else {
		goto_index();
	}
	try {
		$videosite = new VideoSite($sitenum, $video_name);
	} catch (\Exception $e) {
		//echo "Error constructing VideoSite" . PHP_EOL;
		goto_index();
	}
	/* catch (\InvalidArgumentException $iae) {
		goto_index();
	}*/

} else {
	echo "Error restoring Userstudy object from SESSION; please enable cookies for this site!";
	exit();
	//goto_index();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="site.css">

	<title>BA Benutzerstudie - Vergleich <?=$sitenum +1 ?></title>
</head>
<body>
	<div class="">
		<h1>Vergleich <?=$sitenum +1 ?></h1>
	</div>
	<div class="ratevideo">
		<video class="video" loop controls="" src="<?= $videosite->getVideoURL()?>">&nbsp;</video>


		<p><strong>Wie empfindest du die Qualität der Sprachanimation im Vergleich?</strong></p>
		<br/>
		<span class="<?=(empty($nameErr)) ? 'error-hidden' : 'error';?>">* <?= $nameErr;?></span>
		<form name="video_comparison" action="site.php?sitenum=<?=$sitenum +1?>" method="post">

			<!-- //TODO show selection on 'previous'-->
			<a class="button" href="<?=($sitenum == 0) ? get_uri_dir().'index.php' : 'site.php?sitenum='.($sitenum - 1);?>">Zurück</a>
			
		    <input class="input_radio" type="radio" name="video_rating" value="1" /> A (links) viel besser
		    <input class="input_radio" type="radio" name="video_rating" value="2" /> A (links) etwas besser
		    <input class="input_radio" type="radio" name="video_rating" value="3" /> Beide gleich gut
		    <input class="input_radio" type="radio" name="video_rating" value="4" /> B (rechts) etwas besser
		    <input class="input_radio" type="radio" name="video_rating" value="5" /> B (rechts) viel besser
			<input class="input_radio" type="hidden" name="sitenum" value=<?=$sitenum;?> />
		   
			<input class="btn-gradient blue" type="submit" value="Weiter" />
			<!-- <a href="site.php?sitenum=<?=$sitenum +1;?>"> </a>-->
		</form>

	</div>
	<div id="footer">
	</div>
</body>
</html>
