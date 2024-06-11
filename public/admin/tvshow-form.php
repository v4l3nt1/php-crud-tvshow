<?php

declare(strict_types=1);

use Entity\TvShow;
use Html\Form\TvShowForm;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\AppWebPage;

try {
    $webpage = new AppWebPage();
    if (!isset($_GET["tvShowId"])) {
        $tvShow = null;
        $webpage->setTitle("Ajout de série");
    } elseif (!ctype_digit($_GET["tvShowId"])) {
        throw new ParameterException();
    } else {
        $tvShow = TvShow::findById((int)$_GET["tvShowId"]);
        $webpage->setTitle("Modification de série : {$tvShow->getName()}");
    }
    $tvShowForm = new TvShowForm($tvShow);
    $webpage->appendContent($tvShowForm->getHtmlForm('tvshow-save.php'));
    echo $webpage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
