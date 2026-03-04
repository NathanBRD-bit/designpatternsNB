📌 Nom du pattern
🎯 Problème qu’il résout
🧠 Principe de fonctionnement
🏗 Structure (rôles des classes)
📈 Avantages
⚠️ Inconvénients
🧩 Cas d’usage réel possible

✅ Obligations
Inventer un scénario original
Justifier pourquoi le pattern est pertinent
Respecter les principes SOLID
Produire un code propre et structuré
Mettre des commentaires explicatifs

# Builder

## Problèmes que résout le builder

Le builder évite de créer des objets avec beaucoup de paramètres dans son constructeur, avec le builder on peut build seulement une partie de l'objet.
Permet de ne pas faire de sous-classes, car on va pouvoir créer des variantes en ne buildant que les parties qui nous intéressent.

## Principe de fonctionnement

Le Builder sépare la construction d’un objet complexe en plusieurs blocks de construction.
Au lieu d’instancier directement un objet avec un constructeur lourd, une classe intermédiaire **Builder** va construire l’objet étape par étape.

Le **Builder** possède des méthodes pour configurer les différentes parties de l’objet.

Le client ne connaît donc pas les détails internes à la construction, il sait seulement qu’il configure un **Builder** puis récupère un objet prêt à être utilisé.

On a aussi un **Director** qui permet d'ordonner la création des objets avec des méthode du style make() ou makeWith..() 
qui appelle les différentes méthodes de configuration pour créer des objets avec tel ou tel attributs de configurés.

## Structure

Le **produit** est l’objet complexe que l’on souhaite construire.
Il peut contenir plusieurs attributs et une logique interne.

Le **Builder** est une classe qui contient :

Un attribut du type du **produit**.

des méthodes de configuration qui build des parties du **produit**.

une méthode finale build() qui retourne le **produit** final

On peut avoir un **director**.
Le **director** est une classe qui définit un ordre précis de construction.
Il utilise le builder pour créer des variantes spécifiques d’un objet.

On peut très se servir des builders sans le director.
## Avantages

- évite les constructeurs lourds
- contrôle la construction de l'objet
- Respect du SRP, la construction est séparé du métier
- Plusieurs variantes sans héritage
- Code plus lisible

## inconvénients

- plus de code = plus de classe = plus de complexité
- inutile pour les projets simples
- le builder doit suivre les mise à jour de l'objet

## Cas d'usage réel

Sur un site e-commerce, une commande possède beaucoup de paramètre qu'il faut prendre en compte, comme : 
- un client
- une adresse
- un paiement
- un livraison
- un statut
- un prix total
- un code promo

Avoir un constructeur énorme pour faire la commande peut être très lourd, donc on veut pouvoir construire la commande étape par étape et vérifier les données,
afin que la commande finale soit correcte.