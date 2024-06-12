# Présentation

Voici le dépot git pour la **SAE201** `php-crud-tvshow` par
**Elias Richarme** (rich0190) et **Valentin Fortier** (fort0050).

# Installation

Pour garantir le bon fonctionnement de notre projet,
**Composer** doit être installé sur votre machine. Il peut
être installé facilement avec [ce tutoriel](http://cutrona/installation-configuration/composer/) de **Jérôme Cutrona**.


Clonez le dépôt avec :
```bash
git clone https://iut-info.univ-reims.fr/gitlab/rich0190/php-crud-tvshow.git
```

Et, installez les extensions nécessaires avec :
```bash
composer install
```

Si vous avez une version de PHP différente de la notre (v8.1.29),
vous devrez ajuster les versions des extensions pour qu'elles
corespondent à votre version de PHP :
```bash
composer update 
```

Le projet est maintenant opérationnel, Le serveur local peut être
exécuté sur **Windows** ou **linux** via ces scripts  :
```bash
composer start:windows
```
```bash
composer start:linux
#ou
composer start
```

# PHP CS Fixer

Pour homogénéiser notre code source, nous suivons la
recommandation [PSR-12](https://www.php-fig.org/psr/psr-12/)
en utilisant **PHP CS Fixer**, un outil permettant de détecter
et corriger les erreurs de codage.

Pour détecter les problèmes :
```bash
composer test:cs
```

Pour les corriger :
```bash
composer fix:cs
```

# Tests

Nous avons implémenté différents tests pour notre projet, ceux-ci permettant de vérifier le bon
fonctionnement de nos classes de type Collection (EpisodeCollection, GenreCollection, SeasonCollection et TvShowCollection),
ainsi que les méthodes de la classe TvShow.

Pour vérifier le bon fonctionnement de ces classes, les tests peuvent être lancés sur votre
machine avec la commande Composer :
```bash
composer test
```

# Initialisation de la base de données

Avant de commencer les classes et pages nous devons créer la base de données.

![creation de la table](img/create-bd.png)

Ensuite nous importons la base de données dans notre base à partir du script **sql** fourni dans le [sujet de la SAE](http://cutrona/but/s2/sae2-01/#base-de-donnees).

![import des tables](img/import-into-bd.png)

# Fonctionnement

Notre projet consiste en le listage de **séries télévisées**, de leurs **saisons**
respectives ainsi que les différents **épisodes** de ces saisons. Nous utilisons
pour cela une base de données dédiée où toutes les informations utiles à notre
projet y sont répertoriées.

Pout traiter ces informations, Nous créons une classe dédiée par élément de
la base de donnée, nous avons donc une classe pour les **TvShow**, les **Season**,
les **Episode**, les **Poster** (de serie et de saison) et les Genres possibles pour les séries.

Pour pouvoir lister nos données dans différentes pages, nous avons besoin de classes **Collection**.
Par exemple, la classe **TvShowCollection** qui récupère toutes les séries de la base de donnée et
crée des instance de **TvShow**, ou encore **EpisodeCollection** qui récupère tous les épisodes
d'une **Season** (à partir de l'identifiant de saison).

Pour la structuration de nos pages web, nous utilisons une classe **WebPage** permettant
l'utilisation de nombreuses fonctionnalités pour faciliter le développement HTML. Couplée à
la classe **AppWebPage**, nous pouvons implémenter un menu interactif très simplement.

Concernant ce menu interactif, nous avons fait en sorte qu'il permette de naviguer dans le site
de la manière la plus simple possible, vous pouvez retourner à la page d'accueil à partir de
toutes les autres pages, Vous pouvez ajouter des séries et des saisons, ainsi que les
modifier et les supprimer. les boutons de modification et de suppression se
trouvent sur leur page dédiée, ils interagissent avec des formulaires que vous pouvez trouvez 
dans les fichiers **SeasonForm.php** et **TvShowForm.php**.

![img.png](img/img.png)

L'affichage du site a été pensé en suivant le concept "**mobile-first**", garantissant un affichage optimal
sur les petits écrans, les affichages pour les écrans plus grands sont gérés à l'aide de **media-queries**.
La plus petite largeur de page possible pour notre site est de **400 pixels**. Les paliers de largeur 
de la page sont **500 pixels**, **600 pixels**, **1000 pixels** et **1200 pixels**