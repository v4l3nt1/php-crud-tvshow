<?php

declare(strict_types=1);

use Entity\TvShow;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if (!isset($_GET["tvShowId"])) {
        throw new ParameterException();
    } elseif (!ctype_digit($_GET["tvShowId"])) {
        throw new ParameterException();
    } else {
        $tvShow = TvShow::findById((int)$_GET["tvShowId"]);
        $tvShow->delete();
        header("Location: /index.php");
        exit();
    }

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
