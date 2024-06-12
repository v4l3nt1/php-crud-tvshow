<?php

declare(strict_types=1);

use Entity\Season;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;

try {
    if (!isset($_GET["seasonId"])) {
        throw new ParameterException();
    } elseif (!ctype_digit($_GET["seasonId"])) {
        throw new ParameterException();
    } else {
        $season = Season::findById((int)$_GET["seasonId"]);
        $season->delete();
        header("Location: /tvshow.php?tvShowId={$season->getTvShowId()}");
        exit();
    }

} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
