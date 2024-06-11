<?php

declare(strict_types=1);
use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();
$webpage->setTitle('Séries TV');

$tvshows = TvShowCollection::findAll();

$webpage->appendContent("<div class='list'>\n");
foreach ($tvshows as $tvshow) {
    $webpage->appendContent("            <a class='show' href='tvshow.php?tvShowId={$tvshow->getId()}'>\n");
    $webpage->appendContent(<<<HTML
                                            <div class='poster'>
                                                <img src='poster.php?posterId={$tvshow->getPosterId()}' alt='Affiche de la série'>
                                            </div>\n
                            HTML);
    $webpage->appendContent(<<<HTML
                                            <div class="info">
                                                <p class='name'>{$webpage->escapeString($tvshow->getName())}</p>
                                                <p class='overview'>{$webpage->escapeString($tvshow->getOverview())}</p>
                                            </div>\n
                            HTML);
    $webpage->appendContent("            </a>\n\n");
}


$webpage->appendContent("        </div>");

echo $webpage->toHTML();
