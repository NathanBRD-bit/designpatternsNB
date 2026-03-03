# Prototype

## Problèmes que résout le Prototype

Le prototype permet d'éviter de recréer à la main un objet qui peut avoir des centaines d'attributs, c'est long et complexe.
Réduis la duplication de code en mettant la création de la copie à un seul endroit.
Rends la création de variantes plus facile.

## Principe de fonctionnement

Le **prototype** va définir une méthode de clonage (généralement clone()) que les **prototypes concret** devront implémenter.

Les **prototypes concret** implémente le prototype pour avoir la méthode de clonage afin de créer des clones de lui-même.
En créant des clones, on obtient un objet du même type que le modèle mais totalement indépendant et créer en une ligne.

On peut ensuite stocker ces clones et modèles dans un registre de prototypes pour les utiliser plus facilement.

## Structure

Le **Prototype** est une interface (en général) ou une classe abstraite qui possède une méthode de clonage.
Ce **prototype** est implémenter par des **Prototype Concret**, ce sont les classes concrètes donc elles servent de modèle pour les clones.
On peut bien sûr, faire des sous-classe du **Prototype Concret** pour faire des clones plus spécifique.

La méthode de clonage se contente d'instancier un nouvel objet du même type de la classe qui appelle la méthode en donnant
en paramètre au constructeur l'objet lui-même. Donc il faut 2 constructeurs, un vide, et un qui va construire l'objet à partir du modèle.

Il exste aussi un **Registre de prototypes** qui stock les prototypes, il permet aussi de récupérer facilement ces prototypes
en lui implémentant des méthodes comme getPrototypeByName(). (peut être ByColor, BySize, etc).

## Avantages

- Créer un objet du même type en une ligne
- Objet cloné indépendant du modèle
- Évite de devoir passer sur chaque attribut du nouvel objet, si ce dernier en a beaucoup on peut en oublier (je pense notamment à certains objets sur Prestashop qui ont beaucoup d'attributs)
- Alternative à l'héritage sans ses inconvénients ( il faut créer plusieurs objets de la même classe mais configuré différemment, ça évite de faire plein de sous-classes)

## inconvénients

- Si l'objet modèle fait référence à d'autres objets, des dépendances complexes alors le clone peut être lourd
- Si quelqu'un modifie le prototype, on pourra avoir des incohérences sur les nouveaux clones compliquée à déboguer

## Cas d'usage réel

Sur un site e-commerce, imaginons qu'on a un produit "Pack largeots" avec 3 largeots de couleur écru dedans, on veut créer une variante de ce produit mais spécialement en noir.

Au lieu de créer le pack à la main et de mettre les 3 largeots les uns après les autres, on pourrait imaginer un bouton "Cloner" où tu choisis les attributs que tu veux changer, ça créer le pack clone
avec les mêmes attributs à l'exception de ceux que tu voulais changer.