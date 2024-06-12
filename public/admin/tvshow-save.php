<?php

declare(strict_types=1);

use Exception\ParameterException;
use Html\Form\TvShowForm;

try {
    $tvShowForm = new TvShowForm();
    $tvShowForm->setEntityFromQueryString();
    $tvShowForm->getTvShow()->save();
    http_response_code(302);
    header("Location: /tvshow.php?tvShowId={$tvShowForm->getTvShow()->getId()}");
    exit();
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
