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
            <div class="info">
                <div class="name">Titre série : {$webpage->escapeString($tvshow->getName())}</div>
                <div class="ogName">Titre original : {$webpage->escapeString($tvshow->getOriginalName())}</div>
                <div class="desc"> Description : <br> {$webpage->escapeString($tvshow->getOverview())}</div>
            </div>
        </div>                       
        <div class='list'>\n
HTML);
$seasons = $tvshow->getSeasons();
foreach ($seasons as $season) {
    $webpage->appendContent(<<<HTML
            <a class="season" href="season.php?seasonId={$season->getId()}">
                <div class="seasonPoster">
                    <img src='poster.php?posterId={$season->getPosterId()}' alt='Affiche de la saison'>
                </div>
                <div class="seasonName">
                    <p>{$webpage->escapeString($season->getName())}</p>
                </div>
            </a>\n\n
HTML);
}
$webpage->appendContent("        </div>");
echo $webpage->toHTML();
