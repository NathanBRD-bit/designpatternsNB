# Strategy

## Problèmes que résout le Strategy

Quand on a plusieurs variantes d'un comportement dans une classe, pour en ajouter un nouveau il faut souvent adapter la classe, c'est lourd et pas maintenable sur le long terme.
De plus, si on choisit les modes de comportement dans la même classe on peut se retrouver avec un gros switch dégueulasse.

Le pattern Strategy résout ça en extrayant la logique métier de chaque comportement dans une autre classe, trasnformant le client simplement en un context qui a beosin d'un algorithme.

## Principe de fonctionnement

Le **Strategy** consiste à définir une interface (**Strategy**) pour déterminer les méthodes communes à chaque variantes du comportement.
Chaque variante de ce comportement implémente cette interface.
Le client possède une référence à l'interface et délègue l’exécution du comportement à la stratégie (référence à l'interface)
, il peut changer la stratégie à tout moment avec un setter (setStrategy par exemple).
On évite donc les conditions, on améliore la maintenabilité, et on respecte les principes SOLID (notamment Open/Closed et Single Responsibility).

## Structure

**Strategy (interface)** :
Déclare une méthode (ou plusieurs) que toutes les stratégies doivent implémenter.

**Concrete Strategy** :
Implémente l’interface Strategy en fournissant un comportement spécifique.

**Context (client)** :
Utilise une stratégie pour exécuter un comportement sans connaitre le type de stratégie.

## Avantages

- Respect du principe Open/Closed : on peut ajouter des stratégies sans modifier le client
- Permet de remplacer des conditions complexes (gros switch, if/else) par une architecture claire
- Découplage des comportements
- Test unitaire de chaque stratégie plus simple à mettre en place

## inconvénients

- Augmente le nombre de classes en fonction du nombre de stratégie
- Le client doit recevoir ou changer la stratégie explicitement
- Si il n'y que quelques variantes et pas complexe alors le pattern est peu utile

## Cas d'usage réel

Sur un site e-commerce, on peut trier dans les catégories les produits, par exemple trier par : 
- ventes
- pertinence
- prix décroissant
- prix croissant
- nom de A à Z
- nom de Z à A

Donc avoir tout les modes de tri dans une classe est lourd, on peut avoir un gros if / else pour changer le tri, ça ne respecte pas les principes SOLID.