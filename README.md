# Design patterns en PHP

Ce repository Git contient des exemples de design patterns simple en PHP que j'ai compris.

## Structure du repository

Le repo est construit de la manière suivante :
- Un dossier pour chaque design pattern qui possède:
  - **explication.md** : explication du design pattern en suivant la structure :
    - Nom du design pattern
    - problème qu'il résout
    - Principe de fonctionnement
    - Structure (rôles des classes)
    - Avantages
    - Inconvénients
    - Cas d'usage (repris dans l'exemple)
  - **exemple.php** : exemple d'utilisation du design pattern dans un contexte e-commerce

**Le but** est de montrer que j'ai compris les principes de base de chaque design pattern en les expliquant avec
mes mots.

## Langage

PHP 7.4+ (les propriétés typées sont apparus avec PHP 7.4)

C'est de la POO, les exemples respectent le principe de SOLID.

Aucune dépendance externe nécessaire pour exécuter les exemples.

## Exécuter les exemples

Vérifier la version de PHP : `php -v`

Depuis la racine du projet : `cd nomDesignPattern/`
Puis : `php exemple.php`

Ou

Depuis la racine du projet : `php nomDesignPattern/exemple.php`

Chaque script affiche juste un résultat simple qui montre le comportement du design pattern.