# Singleton

## Problèmes que résout le Singleton

Le singleton vise à résoudre le problème d'instanciation d'une classe trop important.
Toute les instances essentielles mais créées plusieurs fois sont maintenant unique dans le programme, tout comme son code métier.

## Principe de fonctionement

Le fonctionnement du singleton c'est une unique instance pour tout le programme, avec un seul point d'accès.

## Structure

Une **classe** qui fait office de singleton, avec un **constructeur en private** afin de restreindre la création de l'instance.
Un **attribut static private** de la classe qui stock l'instance de la classe, il permet de savoir si l'instance est initialisée ou pas.
Enfin, une **méthode static public** qui permet de récupérer l'instance, ou sinon de la créer en l'initialisant dans l'attribut static private.

Des méthodes en plus contenant toute la logique métier de l'instance du singleton. 

## Avantages

- Une seule instance, partout dans le programme avec un accès unique, ce qui donne un gain de mémoire et de rapidité
- Tout le code métier de l'instance au même endroit

## Inconvénients

- Il ne respecte pas le SRP, il gère l'initialisation unique d'une instance et possède tout le code métier de cette instance.
- Pose problème dans un environnement multithread, potentiellement une instance par canal si mal géré
- Test compliqué, le constructeur privé rends plus difficile les tests unitaire

## Cas d'usage réel

Dans mon cas sur un site e-commerce, un singleton pour gérer les mails de commande client peut être mis en place pour notifier par exemple de l'envoi,
réception de la commande au client, on peut considérer que c'est un smtp donc on crée une seule instance avec les paramètres d'un serveur smtp et les fonctions
d'envoie de mail sont gérés avec.

C'est pertinent car ça va éviter de créer 30 000 instances du serveur et prendre de la mémoire pour rien.