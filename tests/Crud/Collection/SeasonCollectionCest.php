<?php
namespace Tests\Crud\Collection;
use Entity\Collection\SeasonCollection;
use Entity\Season;
use Tests\CrudTester;
class SeasonCollectionCest
{
    public function findByTvShowId(CrudTester $I)
    {
        $expectedSeasons = [
            [
                'id' => 14,
                'tvShowId' => 3,
                'name' => 'Saison 1',
                'seasonNumber' => 1,
                'posterId' => 17
            ],
            [
                'id' => 15,
                'tvShowId' => 3,
                'name' => 'Saison 2',
                'seasonNumber' => 2,
                'posterId' => 18
            ],
            [
                'id' => 16,
                'tvShowId' => 3,
                'name' => 'Saison 3',
                'seasonNumber' => 3,
                'posterId' => 19
            ],
            [
                'id' => 17,
                'tvShowId' => 3,
                'name' => 'Saison 4',
                'seasonNumber' => 4,
                'posterId' => 20
            ],
            [
                'id' => 18,
                'tvShowId' => 3,
                'name' => 'Saison 5',
                'seasonNumber' => 5,
                'posterId' => 21
            ],
            [
                'id' => 19,
                'tvShowId' => 3,
                'name' => 'Saison 6',
                'seasonNumber' => 6,
                'posterId' => 22
            ],
            [
                'id' => 20,
                'tvShowId' => 3,
                'name' => 'Saison 7',
                'seasonNumber' => 7,
                'posterId' => 23
            ],
            [
                'id' => 21,
                'tvShowId' => 3,
                'name' => 'Saison 8',
                'seasonNumber' => 8,
                'posterId' => 24
            ],
            [
                'id' => 22,
                'tvShowId' => 3,
                'name' => 'Saison 9',
                'seasonNumber' => 9,
                'posterId' => 25
            ],
            [
                'id' => 23,
                'tvShowId' => 3,
                'name' => 'Saison 10',
                'seasonNumber' => 10,
                'posterId' => 26
            ],
            [
                'id' => 13,
                'tvShowId' => 3,
                'name' => 'Épisodes spéciaux',
                'seasonNumber' => 2147483647,
                'posterId' => 16
            ]
        ];


        $seasons = SeasonCollection::findByTvShowId(3);
        $I->assertCount(count($expectedSeasons), $seasons);
        $I->assertContainsOnlyInstancesOf(Season::class, $seasons);
        foreach ($seasons as $index => $season) {
            $expectedSeason = $expectedSeasons[$index];
            $I->assertEquals($expectedSeason['id'], $season->getId());
            $I->assertEquals($expectedSeason['tvShowId'], $season->getTvShowId());
            $I->assertEquals($expectedSeason['name'], $season->getName());
            $I->assertEquals($expectedSeason['seasonNumber'], $season->getSeasonNumber());
            $I->assertEquals($expectedSeason['posterId'], $season->getPosterId());
        }
    }
}