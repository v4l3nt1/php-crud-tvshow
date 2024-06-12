<?php
namespace Tests\Crud;
use Entity\Exception\EntityNotFoundException;
use Entity\TvShow;
use Tests\CrudTester;
class TvShowCest
{
    public function findById(CrudTester $I)
    {
        $tvShow = TvShow::findById(3);
        $I->assertSame(3, $tvShow->getId());
        $I->assertSame('Friends', $tvShow->getName());
        $I->assertSame('Friends', $tvShow->getOriginalName());
        $I->assertSame('https://www.netflix.com/title/70153404', $tvShow->getHomepage());
        $I->assertSame('Les péripéties de 6 jeunes newyorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori...', $tvShow->getOverview());
        $I->assertSame(15, $tvShow->getPosterId());
    }

    public function findByIdThrowsExceptionIfTvShowDoesNotExist(CrudTester $I)
    {
        $I->expectThrowable(EntityNotFoundException::class, function () {
            TvShow::findById(PHP_INT_MAX);
        });
    }

    public function delete(CrudTester $I)
    {
        $tvshow = TvShow::findById(25);
        $tvshow->delete();
        $I->cantSeeInDatabase('tvshow', ['id' => 25]);
        $I->cantSeeInDatabase('tvshow', ['name' => 'Futurama']);
        $I->assertNull($tvshow->getId());
        $I->assertSame('Futurama', $tvshow->getName());
    }

    public function update(CrudTester $I)
    {
        $tvshow = TvShow::findById(70);
        $tvshow->setName('Goth');
        $tvshow->save();
        $I->canSeeNumRecords(1, 'tvshow', [
            'id' => 70,
            'name' => 'Goth'
        ]);
        $I->assertSame(70, $tvshow->getId());
        $I->assertSame('Goth', $tvshow->getName());
    }


}
