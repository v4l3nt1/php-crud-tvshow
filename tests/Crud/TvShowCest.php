<?php

namespace Tests\Crud;

use Database\MyPdo;
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

    public function insert(CrudTester $I)
    {
        $tvshow = TvShow::create(null, 'test1', 'test1', 'http://test1.com', 'test1', null);
        $tvshow->save();
        $id = (int)MyPdo::getInstance()->lastInsertId();
        $I->canSeeNumRecords(1, 'tvshow', [
            'id' => $id,
            'name' => 'test1',
            'originalName' => 'test1',
            'homepage' => 'http://test1.com',
            'overview' => 'test1',
            'posterId' => null

        ]);
        $I->assertSame($id, $tvshow->getId());
        $I->assertSame('test1', $tvshow->getName());
        $I->assertSame('test1', $tvshow->getOriginalName());
        $I->assertSame('http://test1.com', $tvshow->getHomepage());
        $I->assertSame('test1', $tvshow->getOverview());
        $I->assertNull($tvshow->getPosterId());
    }

    public function createWithoutId(CrudTester $I)
    {
        $tvshow = TvShow::create(null, 'test2', 'test2', 'http://test2.com', 'test2', null);
        $I->assertNull($tvshow->getId());
        $I->assertSame('test2', $tvshow->getName());
        $I->assertSame('test2', $tvshow->getOriginalName());
        $I->assertSame('http://test2.com', $tvshow->getHomepage());
        $I->assertSame('test2', $tvshow->getOverview());
        $I->assertNull($tvshow->getPosterId());
    }

    public function createWithId(CrudTester $I)
    {
        $tvshow = TvShow::create(8, 'test3', 'test3', 'http://test3.com', 'test3', 6);
        $I->assertSame(8, $tvshow->getId());
        $I->assertSame('test3', $tvshow->getName());
        $I->assertSame('test3', $tvshow->getOriginalName());
        $I->assertSame('http://test3.com', $tvshow->getHomepage());
        $I->assertSame('test3', $tvshow->getOverview());
        $I->assertSame(6, $tvshow->getPosterId());
    }
}
