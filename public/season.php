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

$webpage->setTitle($tvShow->getName()." : ".$season->getName()
);

$webpage->appendContent(<<<HTML
                            <div class="main">
                                <div class="seasonPoster">
                                    <img src='poster.php?posterId={$season->getPosterId()}' alt='Affiche de la saison'>
                                </div>
                                <div class="name tvShow">
                                    {$tvShow->getName()}
                                </div>
                                <div class="name season">
                                    {$season->getName()}
                                </div>
                            </div>
                            <div class="list">
                                                           

HTML);

foreach ($episodes as $episode) {
    $webpage->appendContent(<<<HTML

                                <div class="episode">
                                    <p>{$episode->getEpisodeNumber()}</p>
                                    <p>{$episode->getName()}</p>
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
