<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\TvShowCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();
$webpage->setTitle('Séries TV');
$webpage->appendToMenu('./admin/tvshow-form.php', 'Ajouter');

$webpage->appendContent(<<<HTML
                                    <form action="index.php">
                                        <input type="checkbox" id="menu-toggle" class="menu-toggle"> 
                                            <label for="menu-toggle" class="menu-icon">☰ Menu</label>
                                        </input>
                                        <div class="genre-list">
HTML);

$genrelist = GenreCollection::getAll();

foreach ($genrelist as $genre) {
    $webpage->appendContent(<<<HTML
    
                                            <div class="genre">
                                                <input type="checkbox" id="genre{$genre->getName()}" name="genre{$genre->getName()}" class="genre-toggle">
                                                    <label for="genre{$genre->getName()}">{$genre->getName()}</label>
                                                </input>
                                            </div>

HTML);
}

$webpage->appendContent(<<<HTML
                                        <input type="submit" value="Envoyer">
                                        </div>
                                    </form>
HTML);

$genresChose = [];
foreach ($genrelist as $genre) {
    if (isset($_GET["genre{$genre->getName()}"]) && $_GET["genre{$genre->getName()}"] == "on") {
        $genresChose += [$genre->getId()];
    }
}

if(count($genresChose) == 0) {
    $tvshows = TvShowCollection::findAll();
} else {
    $tvshows = TvShowCollection::getTvShowByGenre($genresChose);
}


$webpage->appendContent("<div class='list'>\n");
foreach ($tvshows as $tvshow) {
    if ($tvshow->getPosterId() == null) {
        $jpeg = 'img/default.png';
    } else {
        $jpeg = "poster.php?posterId={$tvshow->getPosterId()}";
    }
    $webpage->appendContent("            <a class='show' href='tvshow.php?tvShowId={$tvshow->getId()}'>\n");
    $webpage->appendContent(<<<HTML
                                            <div class='poster'>
                                                <img src='$jpeg' alt='Affiche de la série'>
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
