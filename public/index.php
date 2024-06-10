<?php

declare(strict_types=1);
use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();
$webpage->setTitle('Séries TV');

$tvshows = TvShowCollection::findAll();

$webpage->appendContent("<div class='list'>\n");
foreach ($tvshows as $tvshow) {
    $posterId = $tvshow->getPosterId();
    $webpage->appendContent("            <div class='show'>\n");
    $webpage->appendContent(<<<HTML
                                            <div class='poster'>
                                                <img src='poster.php?posterId=$posterId' alt='Affiche de la série'>
                                            </div>\n
                            HTML);
    $webpage->appendContent("                <p class='name'>{$webpage->escapeString($tvshow->getName())}</p>\n");
    $webpage->appendContent("                <p class='overview'>{$webpage->escapeString($tvshow->getOverview())}</p>\n");
    $webpage->appendContent("            </div>\n");
}


$webpage->appendContent("        </div>");

echo $webpage->toHTML();
