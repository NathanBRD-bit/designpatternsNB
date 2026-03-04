# Façade

## Problèmes que résout la façade

Quand on fait appel a des sous-système, framework, librairies, etc pour utiliser seulement une partie de leurs code dans le client
on doit analyser le comportement du framework spécifique utilisé (par exemple, ça pourrait être une librairie) et pondre un code sur-mesure pour ce framework.
C'est pas très maintenable sur le long terme, rend la logique de plus en plus complexe au fur et à mesure qu'on intègre le framework dans notre client et chaque changement peut tout casser.

Donc une tâche simple peut demander l'intervention de plusieurs systèmes complexe, la façade permet de simplifier ce processus en appelant une seule interface qui gère tout le processus.
Plus besoin de connaitre le fonctionnement du sous-système

## Principe de fonctionnement

La **façade** est une classe qui regroupe plusieurs appels internes à différents objets et services, et propose des méthodes qui simplifie le traitement que le **client** souhaite avec ces objets et services.
Le **client** connaît uniquement la **façade**, il l'instancie dans les méthodes et l'utilise là où il en a besoin pour exécuter le traitement cherché avec les objets et services.
Comme ça il ne connait le fonctionnement interne des services ni même du processus de traitement.
La **façade** encapsule plusieurs objets et comportements (les sous-systèmes), gère les appels dans le bon ordre dans les méthodes, cache les dépendances internes du **client** et protège le **client** des changements
Le but n’est pas de remplacer les classes internes, mais de fournir une interface simple pour les utiliser.

## Structure

**Façade** : Classe qui offre une interface unifiée et facile d’utilisation pour le **client**, elle contient des instances des sous-systèmes et orchestre leurs appels.

**Classes internes (sous-systèmes)** :Classes qui font réellement le travail technique (logique métier, calcul, communication API, etc.), 
elles restent indépendantes, mais ne sont pas directement appelées par le **client**. Ce sont les services, frameworks, librairies, etc.

**Client** : Il n’interagit qu’avec la **façade**, il ne dépend pas des classes internes du sous-système.

## Avantages

- Simplifie l'usage de systèmes complexes
- Respect SRP, délègue la logique des sous-systèmes à la façade
- Réduit le couplage entre Client et sous-système (on peut facilement changer de framework, suffit d'adapter la façade)
- facilite la maintenance du code et l'évolution

## inconvénients

- Si la façade devient trop complexe, elle peut devenir littéralement indispensable pour beaucoup de logique métier du client.
- La façade doit être mis à jour en fonction des sous-systèmes
- Inutile dans un cas où le sous-système est simple

## Cas d'usage réel

Sur un site e-commerce, on va rester sur l'exemple de la commande, cette fois-ci on suppose que nous sommes sur une architecture microservices.
Avec cette architecture, pour passer une commande le client aurait besoin du service de commande, mais aussi de :
- Le service de stockage
- Le service de livraison
- Le service de paiement
- Le service d'email
- Le service de tax
- Le service de bon d'achat
- Le service d'export vers l'ERP

On a beaucoup de service externes à gérer et à intégrer dans le client.
En faisant une façade, plus besoin de faire plein d'appels vers ces services externes, on appelle la méthode dans la façade qui va faire tout les appels dans le bon ordre dans le processus
de création de la commande.