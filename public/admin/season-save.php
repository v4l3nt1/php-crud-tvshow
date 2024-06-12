<?php

declare(strict_types=1);

use Exception\ParameterException;
use Html\Form\SeasonForm;

try {
    $seasonForm = new SeasonForm();
    $seasonForm->setEntityFromQueryString();
    $seasonForm->getSeason()->save();
    http_response_code(302);
    header("Location: /season.php?seasonId={$seasonForm->getSeason()->getId()}");
    exit();
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
