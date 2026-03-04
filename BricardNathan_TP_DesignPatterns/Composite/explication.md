# Composite

## Problèmes que résout le composite

Le composite résout le problème où on manipule des objets simples et des groupes d’objets de la même manière.
Dans certains cas, on a une structure en arbre avec des objets qui contiennent d'autres objets.
On peut parcourir chaque objets et faire une exécution sur chaque objet mais le code aurait un couplage fort avec les objets de la liste et serait
difficile à maintenir.

Le composite permet de traiter ses objets de la même manière peut importe leur type et qu'ils soient simple ou complexe.

## Principe de fonctionnement

Le **composite** repose sur une interface commune appelée (généralement) **Component**.
Cette interface est implémentée par des objets simples **Leaf**, des objets composés **Composite** et ces objets composés contiennent
une collection de **Component**, ce qui permet de créer une arborescence.
Quand on appelle une méthode sur un **composite**, il va appeler cette même méthode sur tous les éléments qu’il contient (il délègue le boulot).
Le client ne fait aucune différence entre un objet simple et un objet composé, il manipule toujours l’interface commune.

## Structure

**Component** :
Interface qui définit le comportement commun à tous les objets, qu’ils soient simples ou composés.

**Leaf** :
Objet simple qui implémente l’interface Component.
Il ne contient pas d’autres objets et gère souvent le traitement de la méthode appelée par le composite.

**Composite** :
Objet qui implémente aussi Component mais qui contient une collection de Component.
Il peut ajouter ou retirer des éléments et déléguer les appels à ses enfants.

**Client** :
Travaille uniquement avec l’interface Component.
Il ne connaît pas la différence entre Leaf et Composite.

## Avantages

- Permet de traiter de la manière des objets complexes et simple
- Respect de l’open-close principle, facile d'ajouter des nouveaux types d'objets via l'interface Component
- Structure claire pour représenter des arbres
- Couplage faible côté client

## inconvénients

- Augmente la complexité temporelle (durée d'exécution) en fonction de la profondeur de l'arbre
- Peut être overkill pour des structures simples
- Certaines méthodes peuvent ne pas avoir de sens pour tous les composants, si certaines classes diffèrent trop alors l'interface est compliqué à mettre en place
- Peut être plus difficile à debugger dans des structures avec beaucoup de components

## Cas d'usage réel

Sur un site e-commerce, pour représenter les catégories et les sous-catégories on utilise (en tout cas sur PrestaShop) une structure arborescente.
Donc le Composite est le choix idéal pour représenter une catégorie, ses sous-catégories et ses produits (les produits sont donc les Leafs).