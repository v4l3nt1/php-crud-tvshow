<?php

declare(strict_types=1);

use Entity\Season;
use Entity\TvShow;
use Html\Form\SeasonForm;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\AppWebPage;

try {
    $webpage = new AppWebPage();
    if (!isset($_GET["seasonId"])) {
        $season = null;
        $tvShow = TvShow::findById((int)$_GET["tvShowId"])->getName();
        $webpage->setTitle("$tvShow : Ajout de saison");
    } elseif (!ctype_digit($_GET["seasonId"])) {
        throw new ParameterException();
    } else {
        $season = Season::findById((int)$_GET["seasonId"]);
        $tvShow = TvShow::findById((int)$_GET["tvShowId"])->getName();
        $webpage->setTitle(TvShow::findById((int)$_GET["tvShowId"])->getName()." : Modification de la saison n°{$season->getSeasonNumber()}");
    }
    $seasonForm = new SeasonForm($season);
    $webpage->appendContent($seasonForm->getHtmlForm('season-save.php?tvShowId=' . $_GET["tvShowId"]));
    echo $webpage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
