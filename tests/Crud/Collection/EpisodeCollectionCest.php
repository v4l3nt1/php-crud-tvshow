<?php
namespace Tests\Crud\Collection;
use Entity\Collection\EpisodeCollection;
use Entity\Episode;
use Tests\CrudTester;
class EpisodeCollectionCest
{
    public function findBySeasonId(CrudTester $I)
    {
        $expectedEpisodes = [
            ['id' => 211, 'seasonId' => 14, 'name' => 'Celui qui déménage', 'overview' => 'Après avoir quitté son fiancé le jour de leur mariage, Rachel tombe sur de vieux amis dans un café, parmi lesquels Ross, qui tente de surmonter son récent divorce.', 'episodeNumber' => 1],
            ['id' => 212, 'seasonId' => 14, 'name' => 'Celui qui est perdu', 'overview' => 'Alors que son ex est enceinte de son enfant et en couple avec une autre femme, Ross désapprouve le prénom qu\'elle a choisi pour le bébé.', 'episodeNumber' => 2],
            ['id' => 213, 'seasonId' => 14, 'name' => 'Celui qui a un rôle', 'overview' => 'Phoebe se voit offrir un chèque de 7 000 $ par un fabricant de sodas après avoir trouvé un pouce dans l\'une de leurs canettes.', 'episodeNumber' => 3],
            ['id' => 214, 'seasonId' => 14, 'name' => 'Celui avec Georges', 'overview' => 'Un livreur apporte par erreur aux filles une pizza destinée à un célèbre politicien vivant dans l\'immeuble d\'en face.', 'episodeNumber' => 4],
            ['id' => 215, 'seasonId' => 14, 'name' => 'Celui qui lave plus blanc', 'overview' => 'Ross aide Rachel à faire la lessive et considère cette soirée comme un premier rencard, tandis que Joey demande à Monica de se faire passer pour sa nouvelle petite-amie.', 'episodeNumber' => 5],
            ['id' => 216, 'seasonId' => 14, 'name' => 'Celui qui est verni', 'overview' => 'Joey perce enfin dans le show-business en décrochant le rôle de doublure des fesses d\'Al Pacino.', 'episodeNumber' => 6],
            ['id' => 217, 'seasonId' => 14, 'name' => 'Celui qui a du jus', 'overview' => 'Ross tente de profiter d\'une coupure de courant générale pour avouer ses sentiments à Rachel.', 'episodeNumber' => 7],
            ['id' => 218, 'seasonId' => 14, 'name' => 'Celui qui hallucine', 'overview' => 'Pendant que Monica et Ross pleurent la disparition de leur grand-mère, Chandler s\'interroge sur sa sexualité.', 'episodeNumber' => 8],
            ['id' => 219, 'seasonId' => 14, 'name' => 'Celui qui parle au ventre de sa femme', 'overview' => 'Le premier dîner de Thanksgiving que Monica a cuisiné pour ses amis part en fumée quand le groupe décide d\'admirer la parade de rue depuis le toit.', 'episodeNumber' => 9],
            ['id' => 220, 'seasonId' => 14, 'name' => 'Celui qui singeait', 'overview' => 'Après avoir promis de ne plus ramener de rencard à la fête du Nouvel An, la petite équipe rompt finalement son pacte, tandis que Ross adopte un petit singe.', 'episodeNumber' => 10],
            ['id' => 221, 'seasonId' => 14, 'name' => 'Celui qui était comme tous les autres', 'overview' => 'Alors que la mère de Chandler rend visite à son fils, Joey la surprend en train d\'embrasser Ross.', 'episodeNumber' => 11],
            ['id' => 222, 'seasonId' => 14, 'name' => 'Celui qui aime les lasagnes', 'overview' => 'Pour écouler le stock de lasagnes qui lui est resté sur les bras, Monica décide d\'en donner un peu à Paolo.', 'episodeNumber' => 12],
            ['id' => 223, 'seasonId' => 14, 'name' => 'Celui qui fait des descentes dans les douches', 'overview' => 'Après avoir été surprise par Chandler à la sortie de la douche, Rachel tente d\'égaliser les scores.', 'episodeNumber' => 13],
            ['id' => 224, 'seasonId' => 14, 'name' => 'Celui qui avait un coeur d\'artichaut', 'overview' => 'Pour la Saint-Valentin, Joey tente de rabibocher Chandler et Janice, et Ross tombe sur Carol et Susan en plein rendez-vous galant.', 'episodeNumber' => 14],
            ['id' => 225, 'seasonId' => 14, 'name' => 'Celui qui pète les plombs', 'overview' => 'Monica tente d\'impressionner un restaurateur en lui préparant un repas digne d\'un chef étoilé, mais le cuisinier n\'a pas vraiment l\'air dans son assiette.', 'episodeNumber' => 15],
            ['id' => 226, 'seasonId' => 14, 'name' => 'Celui qui devient papa (1/2)', 'overview' => 'Phoebe se sent négligée depuis que Joey est tombé amoureux de sa sœur jumelle. Ross participe aux cours de préparation à l\'accouchement avec Carol et Susan.', 'episodeNumber' => 16],
            ['id' => 227, 'seasonId' => 14, 'name' => 'Celui qui devient papa (2/2)', 'overview' => 'Après s\'être foulé la cheville, Rachel réussit à convaincre Monica d\'échanger d\'identité pour pouvoir bénéficier de la couverture médicale de son amie.', 'episodeNumber' => 17],
            ['id' => 228, 'seasonId' => 14, 'name' => 'Celui qui gagnait au poker', 'overview' => 'Rachel passe un entretien pour un poste dans un grand magasin. Les filles affrontent les garçons lors d\'une partie de poker peu amicale.', 'episodeNumber' => 18],
            ['id' => 229, 'seasonId' => 14, 'name' => 'Celui qui a perdu son singe', 'overview' => 'Les amis se lancent à la recherche de Marcel qui s\'est enfui de l\'appartement après avoir échappé à la surveillance de Rachel.', 'episodeNumber' => 19],
            ['id' => 230, 'seasonId' => 14, 'name' => 'Celui qui a un dentiste carié', 'overview' => 'Rachel et Barry ressortent ensemble, bien que ce dernier soit fiancé à Mindy dont Rachel est la témoin de mariage.', 'episodeNumber' => 20],
            ['id' => 231, 'seasonId' => 14, 'name' => 'Celui qui avait un singe', 'overview' => 'Monica décide de prendre les choses en main et de retrouver elle-même son voleur de carte bancaire.', 'episodeNumber' => 21],
            ['id' => 232, 'seasonId' => 14, 'name' => 'Celui qui rêve par procuration', 'overview' => 'Après avoir perdu sa virginité avec Monica, son jeune amant lui révèle qu\'il est encore au lycée. Pendant ce temps, Phoebe remplace la secrétaire de Chandler.', 'episodeNumber' => 22],
            ['id' => 233, 'seasonId' => 14, 'name' => 'Celui qui failli rater l\'accouchement', 'overview' => 'Alors que Ross, Phoebe et Susan sont enfermés dans un placard, Carol est prise de contractions.', 'episodeNumber' => 23],
            ['id' => 234, 'seasonId' => 14, 'name' => 'Celui qui fait craquer Rachel', 'overview' => 'Lors de la fête d\'anniversaire de Rachel, Chandler laisse accidentellement entendre que Ross est toujours amoureux de son amie.', 'episodeNumber' => 24]
        ];


        $episodes = EpisodeCollection::findBySeasonId(14);
        $I->assertCount(count($expectedEpisodes), $episodes);
        $I->assertContainsOnlyInstancesOf(Episode::class, $episodes);
        foreach ($episodes as $index => $episode) {
            $expectedEpisode = $expectedEpisodes[$index];
            $I->assertEquals($expectedEpisode['id'], $episode->getId());
            $I->assertEquals($expectedEpisode['seasonId'], $episode->getSeasonId());
            $I->assertEquals($expectedEpisode['name'], $episode->getName());
            $I->assertEquals($expectedEpisode['overview'], $episode->getOverview());
            $I->assertEquals($expectedEpisode['episodeNumber'], $episode->getEpisodeNumber());
        }
    }
}