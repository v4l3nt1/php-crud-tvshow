<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Html\AppWebPage;

$webpage = new AppWebPage();

if (!isset($_GET["seasonId"]) or !ctype_digit($_GET["seasonId"])) {
    http_response_code(302);
    header("Location: /index.php");
    exit();
}

$webpage = new AppWebPage();
try {
    $Episodes = Season::getEpisodes();;
} catch (EntityNotFoundException $e) {
    http_response_code(404);
    exit();
}




