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


}
