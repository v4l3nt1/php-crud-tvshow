<?php

declare(strict_types=1);

use Entity\Poster;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if(!isset($_GET['posterId'])) {
        throw new ParameterException();
    }
    if(!ctype_digit($posterId = $_GET['posterId'])) {
        throw new ParameterException();
    }
    $poster = poster::FindById(intval($posterId));
    header('Content-type:image/jpeg');
    echo $poster->getJpeg();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
