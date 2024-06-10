# Présentation

Voici le dépot git pour la SAE201 `php-crud-tvshow` par 
Elias Richarme (rich0190) et Valentin Fortier (fort0050).

# Installation

Pour garantir le bon fonctionnement de notre projet, 
Composer doit être installé sur votre machine. Il peut 
être installé facilement avec [ce tutoriel](http://cutrona/installation-configuration/composer/) de Jérôme Cutrona.


Clonez le dépôt avec :
```bash
git clone https://iut-info.univ-reims.fr/gitlab/rich0190/sae201.git
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
exécuté sur Windows ou linux via ces scripts  :
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
en utilisant PHP CS Fixer, un outil permettant de détecter 
et corriger les erreurs de codage.

Pour détecter les problèmes : 
```bash
composer test:cs
```

Pour les corriger :
```bash
composer fix:cs
```

# Init BD

Avant de commencer les classes et pages nous avons créer la base de données

![creation de la table](../supportSAE/img/create-bd.png)

En suite nous importons la base de données dans notre base

![import des tables](../supportSAE/img/import-into-bd.png)