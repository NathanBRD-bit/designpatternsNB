# Décorateur

## Problèmes que résout le Décorateur

Le décorateur permet d'étendre la logique d'une classe quand l'héritage direct est compliqué car pas assez souple.
Il permet d'ajouter un comportement à la classe de base sans modifier sa structure.
Évite de dupliquer le code.
Permet de décider du comportement a adopter pendant l'exécution, contrairement à l'héritage qui override à la compilation.

## Principe de fonctionnement

Le **décorateur de base** permet d'étendre les fonctionnalités d'un **concrete component** (un objet) au cours du programme sans casser son fonctionnement et sans hériter directement de lui.

Il implémente le même **component** (interface) que le concrete component et possède un objet qui fait liaison vers un objet de type component.  
Grâce à cette référence le décorateur délègue le travail à l'objet décoré tout en pouvant ajouter un comportement avant ou après l’appel.

Le décorateur de base ne contient pas de logique métier supplémentaire en lui-même, il sert surtout de structure commune aux **concrete decorators**.

Les **concrete decorators** héritent du décorateur de base et redéfinissent les méthodes afin d’ajouter leur propre comportement, tout en continuant d’appeler la logique de l’objet décoré.

## Structure

Le **Component** est l'interface qui sera commune au décorateur et à la classe décorée avec les méthode qu'on veut décorer.
 
Le **concrete component** est simplement la classe qui verra ses objets être décorés, donc avec tout la logique métier classique mais qui peut être
décorée, elle implémente le component.

Le **décorateur de base** implémente le component, possède un attribut du type du component afin de faire le lien entre le **concrete component** et les **concrete decorators**,
il possède donc les mêmes méthode via l'interface mais délègue le travail au **concrete component** via l'attribut.

le **concrete decorator** va hériter du décorateur de base et redéfini les méthodes de ce dernier, grâce à ce fonctionnement, au lieu d'appeler dans le programme
le concrete component, on appelle le concrete decorator, où on veut pendant le traitement.

Les décorateurs font office de couche, on peut donc décorer des décorateurs.

## Avantages

- Étendre le comportement sans faire de classe enfant
- Ajouter dynamiquement des responsabilités peut importe où dans le code
- Faire plusieurs décorateurs pour un objet permet de découpler les responsabilités
- Respect de l'open/closed principle


## inconvénients

- Comme on peut ajouter les comportement dynamiquement on peut avoir plein de petites classes
- difficile à déboguer
- L'ordre des décorateurs a son importance dans le comportement du programme
- Peut devenir complexe à comprendre si beaucoup de décorateurs sont créés

## Cas d'usage réel

Sur un site e-commerce, ce qu'on veut pour les commandes, c'est que l'utilisateur puisse choisir le mode de livraison, le mode de paiement, etc.
et qu'on puisse ajouter dynamiquement des modes de livraison et de paiement, ou alors des nouveautés comme un message cadeau.
Le décorateur permet de faire cela, en emballant une classe commande on peut la décorer pour ajouter au moment de la création de la commande
des modes de livraison et de paiement, un message cadeau, etc.
