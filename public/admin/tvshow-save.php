<?php

declare(strict_types=1);

use Exception\ParameterException;
use Html\Form\TvShowForm;

try {
    $tvShowForm = new TvShowForm();
    $tvShowForm->setEntityFromQueryString();
    $tvShowForm->getTvShow()->save();
    http_response_code(302);
    header("Location: /index.php");
    exit();
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
