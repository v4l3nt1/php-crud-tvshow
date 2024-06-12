<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Season;
use Entity\TvShow;
use Html\AppWebPage;

$webpage = new AppWebPage();
$webpage->setTitle('Episodes de la saison');

if (!isset($_GET["seasonId"]) or !ctype_digit($_GET["seasonId"])) {
    http_response_code(302);
    header("Location: /index.php");
    exit();
}

$webpage = new AppWebPage();
$season = Season::findById((int)$_GET["seasonId"]);
$tvShow = TvShow::findById($season->getTvShowId());
$episodes = $season->getEpisodes();

$webpage->setTitle($tvShow->getName()." : ".$season->getName());
$webpage->appendToMenu('./index.php', 'Accueil');
$webpage->appendToMenu("./tvshow.php?tvShowId={$tvShow->getId()}", 'Page de la série');
$webpage->appendToMenu("./admin/season-form.php?seasonId={$season->getId()}&tvShowId={$tvShow->getId()}", 'Modifier la Saison');
$webpage->appendToMenu("./admin/season-delete.php?seasonId={$season->getId()}", 'Supprimer la Saison');

if ($season->getPosterId() == null)
{
    $jpeg = 'img/default.png';
}else{
    $jpeg = "poster.php?posterId={$tvShow->getPosterId()}";
}

$webpage->appendContent(<<<HTML
                            <div class="main">
                                <div class="seasonPoster">
                                    <img src='$jpeg' alt='Affiche de la saison'>
                                </div>
                                <div class="info">
                                    <div class="name tvShow">
                                        <div class="name"><a href="{$webpage->escapeString($tvShow->getHomepage())}">{$webpage->escapeString($tvShow->getName())}</a></div>
                                    </div>
                                    <div class="name season">
                                        {$webpage->escapeString($season->getName())}
                                    </div>
                                 </div>
                            </div>
                            <div class="list">
                                                           

HTML);

foreach ($episodes as $episode) {
    $webpage->appendContent(<<<HTML

                                <div class="episode">
                                    <p>Episode {$episode->getEpisodeNumber()} : {$episode->getName()}</p>
                                    <p>{$episode->getOverview()}</p>
                                </div>

HTML
    );
}
$webpage->appendContent(<<<HTML
                            </div>
HTML
);

echo $webpage->toHTML();
