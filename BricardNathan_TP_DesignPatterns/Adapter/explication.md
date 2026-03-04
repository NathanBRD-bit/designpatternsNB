# Adapter

## Problèmes que résout l'adapter

L’adapter résout le problème où deux classes doivent collaborer mais leurs interfaces ne sont pas compatibles.
Notamment quand on utilise un service externe où qu'il faut faire cohabiter plusieurs systèmes différents.
Avec l'adapter on va traduire l'interface d'une classe vers une autre qui a besoin de ces données.

## Principe de fonctionnement

Le ****client**** dépend d’une interface qu’il connaît, le **client** possède la logique métier qui a besoin de l'adaptateur.
La classe **Adaptee** (celle que le client veut utiliser) et le **client** ne peuvent pas communiquer,
alors on crée une classe **Adapter** qui :
implémente l’interface du **client** ou étend du client directement (override la méthode du client qui pose problème)
contient une instance de l’**adaptee**
traduit les appels du **client** vers les méthodes spécifiques de l’adaptee
Le **client** continue donc d’utiliser l’interface sans savoir qu’un système différent est utilisé en arrière-plan.
L’adapter joue donc le rôle de traducteur entre deux interfaces incompatibles.
## Structure

**Client interface** : Interface attendue par le client.
Elle définit les méthodes que le client peut appeler.

**Adaptee** : Classe existante avec une interface incompatible.
Elle possède sa propre logique mais ses méthodes ne correspondent pas à ce que le client attend.

**Adapter** : Implémente l’interface Target et encapsule une instance de l’Adaptee.
Il transforme les appels pour qu’ils correspondent aux méthodes de l’Adaptee.

**Client** : Travaille uniquement avec l’interface Client interface.
Il ne connaît ni l’Adapter ni l’Adaptee directement.

## Avantages

- Respect de l'open-close principle, pas besoin de modifier l'adaptee ou le client
- Couplage faible via l'adaptateur et l'interface
- Intégration facile des services externes
- Respect SRP, logique d'adaptation isolée

## inconvénients

- Ajoute une classe supplémentaire
- Peut complexifier la lecture si trop d’adapters sont utilisés
- Peut masquer des différences importantes entre deux systèmes
- Si l’interface de l’adaptee change, l’adapter doit être modifié

## Cas d'usage réel

Sur un site e-commerce, imaginons que les commandes puissent être exportées vers un ERP mais fait maison et qu'il est en place depuis longtemps,
donc tout le code est adapté sur mesure à cet ERP, et aujourd'hui, l'entreprise veut migrer vers un autre ERP, on arrête le fait maison.
Sauf que l'ERP n'est pas compatible avec le code actuel.

L'ancienne interface a une méthode export avec en paramètre un objet Order mais la nouvelle a une méthode similaire sendOrder avec un array,
il faut faire un adaptateur ici, sans quoi il faudrait modifier soit le code de l'ERP (si on y a accès), ou adapter tout le client.