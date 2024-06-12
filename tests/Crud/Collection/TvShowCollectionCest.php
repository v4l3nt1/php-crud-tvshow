<?php
namespace Tests\Crud\Collection;
use Entity\Collection\TvShowCollection;
use Entity\TvShow;
use Tests\CrudTester;
class TvShowCollectionCest
{
    public function findAll(CrudTester $I)
    {
        $expectedTvShows = [
            [
                'id' => 3,
                'name' => 'Friends',
                'originalName' => 'Friends',
                'homepage' => 'https://www.netflix.com/title/70153404',
                'overview' => 'Les péripéties de 6 jeunes newyorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori...',
                'posterId' => 15
            ],
            [
                'id' => 25,
                'name' => 'Futurama',
                'originalName' => 'Futurama',
                'homepage' => 'http://www.comedycentral.com/shows/futurama',
                'overview' => 'Accidentellement cryogénisé le 31 décembre 1999 alors qu\'il livrait une pizza, Fry se réveille 1000 ans plus tard à New York. À l\'aube de l\'an 3000, le monde a bien changé, peuplé de robots et d\'extraterrestres. Le jeune homme retrouve l\'un de ses descendants qui l\'engage lui et ses nouveaux amis, Leela et Bender, au Planet Express, une entreprise de livraison. Ensemble, ils vont devoir faire face à de périlleuses et délirantes missions dans un monde des plus surprenants.',
                'posterId' => 231
            ],
            [
                'id' => 57,
                'name' => 'Good Omens',
                'originalName' => 'Good Omens',
                'homepage' => 'https://www.amazon.com/dp/B07FMHTRFF',
                'overview' => 'Suit les aventures de Crowley et Aziraphale, un démon et un ange, qui décident de saborder l’Apocalypse car ils se sont trop habitués à la vie sur Terre.',
                'posterId' => 466
            ],
            [
                'id' => 70,
                'name' => 'Hunters',
                'originalName' => 'Hunters',
                'homepage' => 'https://www.amazon.com/dp/B07ZPGMH1B',
                'overview' => 'En 1977 à New York, une bande de chasseurs de nazis découvrent que des centaines de hauts dignitaires du régime déchu vivent incognito parmi eux et complotent pour instaurer un IVe Reich aux États-Unis. L’équipe hétéroclite de Hunters se lance alors dans une sanglante quête visant à faire traduire ces criminels en justice et à contrecarrer leur projet de génocide.',
                'posterId' => 536
            ],
            [
                'id' => 40,
                'name' => 'La caravane de l\'étrange',
                'originalName' => 'Carnivàle',
                'homepage' => 'http://hbo.com/carnivale/',
                'overview' => 'La série se déroule aux Etats-Unis en 1934, durant la Grande Dépression de l\'entre deux guerres. Nous y suivons deux personnages : Ben Hawkins, jeune fermier recueilli par le Carnivàle, un cirque ambulant où se côtoient femme à barbe, sœurs siamoises, homme-lézard et autres télépathes et dirigé par le mystérieux \"Patron\". Ainsi que Justin Crowe, un révérend officiant dans la petite paroisse de Mintern et aidé par sa sœur Iris.\n\nOn découvre vite que ces deux hommes sont liés par quelque mystérieux destin... qui sont-ils réellement et quelle est cette destinée ?',
                'posterId' => 370
            ]
        ];

        $tvshows = TvShowCollection::findAll();
        $I->assertCount(count($expectedTvShows), $tvshows);
        $I->assertContainsOnlyInstancesOf(TvShow::class, $tvshows);
        foreach ($tvshows as $index => $tvshow) {
            $expectedTvShow = $expectedTvShows[$index];
            $I->assertEquals($expectedTvShow['id'], $tvshow->getId());
            $I->assertEquals($expectedTvShow['name'], $tvshow->getName());
            $I->assertEquals($expectedTvShow['originalName'], $tvshow->getOriginalName());
            $I->assertEquals($expectedTvShow['homepage'], $tvshow->getHomepage());
            $I->assertEquals($expectedTvShow['overview'], $tvshow->getOverview());
            $I->assertEquals($expectedTvShow['posterId'], $tvshow->getPosterId());
        }
    }
}
