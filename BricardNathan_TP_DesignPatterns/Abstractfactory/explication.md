# Abstract factory

## Problèmes que résout abstract factory

Au lieu de dépendre d'implémentation concrète lors de l'instanciation des objets ils dépendent d'une interface.
Quand des classes se rapproches mais ne sont pas pareil on peut se tromper en les instanciant et les utiliser ensemble, avec l'abstact factory on
garantie une cohérence entre les classes utilisées.
Aussi, si il faut changer toute une famille avec chaque variante, il faudrait changer le code de chaque classe, alors que avec l'abstact factory on
peut changer uniquement le code de la factory.
## Principe de fonctionnement

L'abstract factory va permettre des familles d'objet sans connaitre les classes concrètes utilisées.
Une classe abstraite factory va définir les méthodes commune à chaque fabrique concrète pour créer les variantes d'objets.
La fabrique concrète va permettre l'instanciation des variantes d'objets dont elle est responsable, chaque méthode instancie un objet concret mais retourne un objet abstrait.
Les objets concret sont des variantes des objets abstraits qui implémentent les méthodes des objets abstraits.
Les objets abstrait eux définissent ce que l'objet générique est capable de faire pour poser une base commune à chaque variantes.

## Structure

Les **produits abstraits** sont une interface qui déclare le comportement commun à toutes les variantes d'un objet que celles-ci vont implémentées.
les **produits concrets** sont des classes qui implémentent l'interface de leur produit abstrait, chaque variante doit impérativement implémenter l'interface du produit abstrait.
La **fabrique abstraite** est une interface qui déclare toutes les méthodes qui retournent des **produits abstraits**
la **fabrique concrète** va implémenter la fabrique abstraite et retourne des **produits concrets**, elle s'occupe de construire une seule famille d'objet.

## Avantages

- Respect du SRP, chaque fabrique n'est responsable que d'une famille, assure la compatibilité des objets
- couplage entre client et produits concret faible via les interface
- Respect de l'open-close, on peut ajouter de nouvelles variantes sans changer le comportement de la fabrique, donne plus de flexibilité
- Côté client on créer de nouveaux objets sans exposer la logique d'instanciation

## inconvénients

- Ajout d'une nouvelle méthode au produit complexe, si on ajoute une méthode au produit abstrait, il faut l'intégrée pour tout les produits concrets.
- De même du côté des fabriques abstraite et concrètes
- Plus on ajoute de produits, plus il faut ajouter de fabriques, ça devient plus lourd.
- inadapté aux petits projets

## Cas d'usage réel

Sur un site e-commerce, si je vends dans plusieurs pays, le principe de taxe, livraison reste globalement le même, mais chaque pays peut avoir son taux,
un mode livraison particulier (UPS, FedEx, DHL, colissimo, etc...), donc il faut adapter en fonction du pays du client.

Dans ce cas l'abstract factory est une bonne solution car elle permet d'ajuster le comportement dans les variantes mais aussi d'anticiper j'irai vendre dans un autre pays.