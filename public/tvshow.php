<?php

declare(strict_types=1);
use Entity\Exception\EntityNotFoundException;
use Entity\TvShow;
use Html\AppWebPage;

if (!isset($_GET["tvShowId"]) or !ctype_digit($_GET["tvShowId"])) {
    http_response_code(302);
    header("Location: /index.php");
    exit();
}

$webpage = new AppWebPage();
try {
    $tvshow = TvShow::findById((int)$_GET["tvShowId"]);
} catch (EntityNotFoundException $e) {
    http_response_code(404);
    exit();
}

$webpage->setTitle("{$webpage->escapeString($tvshow->getName())}");

$webpage->appendContent(<<<HTML
                        <div class="main">
                            <div class='poster'>
                                <img src='poster.php?posterId={$tvshow->getPosterId()}' alt='Affiche de la série'>
                            </div>
                        </div>                       
                        <div class='list'>                                              
                        HTML);
$seasons = ...;
foreach ($seasons as $season) {
}
$webpage->appendContent("</div>");
echo $webpage->toHTML();
