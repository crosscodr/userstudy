<?php
namespace userstudy;
session_start();

require_once '../model/study.factory.php';
require_once '../config.inc.php';


if (!isset($_SESSION['userstudy'])) {
   //echo "Du hast diese Seite noch nicht besucht";
	$videos = array ( "video1", "video2", "video3", "video4", "video5", "video6", "video7", "video8", "video9", "video10", "video11", "video12" );
	$userstudy = ( new StudyFactory )->getStudy($videos);
	$_SESSION['userstudy'] = serialize($userstudy);
} else {
	$userstudy = unserialize($_SESSION['userstudy']);
	if (!$userstudy) {
		echo "Error unserializing Userstudy object from SESSION";
		exit();
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="site.css">
	<title>Startseite BA Benutzerstudie</title>
</head>
<body>
	<h1><?=STUDYNAME?></h1>
	<h3><?=STUDYAUTHOR?></h3>

	<div id="studyintro">
		<p>Wie der Titel schon sagt, geht es in diesem Vergleich um visuelle Sprachsynthese. Visuelle Sprachsynthese bedeutet, dass man mit einem Modell bei Eingabe einer akustischen Sprachaufnahme eine passende Gesichtsanimation erhält.</p>

		<p>Hier sollen zwei Modelle verglichen werden. In den folgenden Videos sind dafür immer die Ausgaben von beiden Modellen zu sehen. Welches Video rechts und welches links zu sehen ist, wird hierbei zufällig erzeugt.</p>

		<p>Als Bewertungsoptionen gibt es „viel besser“, „etwas besser“ und „gleich gut“. Diese findet ihr jeweils unter dem Video.</p>

		<p>Es soll <strong>nicht</strong> die Videoqualität bewertet werden, sondern nur die Qualität der Animation. Hierbei kann besonders auf folgende Punkte eingegangen werden: Synchronität von Video und Audio, das richtige Schließen des Mundes und wie realistisch generell die Animation wirkt.</p>

		<p>Die Videos werden in Dauerschleife gezeigt, sie können also vor der Bewertung gerne mehrfach angeschaut werden.</p>

		<p>Vielen Dank fürs Mitmachen!!</p>

	</div>
	<?php
	if (!isset($userstudy)) {
		echo "Failed initilising userstudy!";
	}
	?>
	<a href="<?= $userstudy->getFirstSiteURL();?>" class="button">Starten</a>


</body>
</html>
