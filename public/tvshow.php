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
$webpage->appendToMenu("./admin/tvshow-form.php?tvShowId={$tvshow->getId()}", 'Modifier');
$webpage->appendToMenu("./admin/tvshow-delete.php?tvShowId={$tvshow->getId()}", 'Supprimer');

if ($tvshow->getPosterId() == null)
{
    $jpeg = 'img/default.png';
}else{
    $jpeg = "poster.php?posterId={$tvshow->getPosterId()}";
}

$webpage->appendContent(<<<HTML
<div class="main">
            <div class='poster'>
                <img src='$jpeg' alt='Affiche de la série'>
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
    if ($season->getPosterId() == null)
    {
        $jpeg = 'img/default.png';
    }else{
        $jpeg = "poster.php?posterId={$season->getPosterId()}";
    }
    $webpage->appendContent(<<<HTML
            <a class="season" href="season.php?seasonId={$season->getId()}">
                <div class="seasonPoster">
                    <img src=$jpeg alt='Affiche de la saison'>
                </div>
                <div class="seasonName">
                    <p>{$webpage->escapeString($season->getName())}</p>
                </div>
            </a>\n\n
HTML);
}
$webpage->appendContent("        </div>");
echo $webpage->toHTML();
