# Command

## Problèmes que résout le pattern Command

Le Command résout les problèmes où on veut découpler l'émetteur d'une action et du récepteur qui exécute cette action,
sans ça on aurait un couplage fort entre les deux et un appel direct au service concerné.
Il permet aussi la mise en place d'une file d'actions.

Donc le pattern Command transforme une action objet qui a les attributs de l'action, des méthodes et fait référence au récepteur

## Principe de fonctionnement

Le pattern repose sur une interface commune appelée (généralement) **Command** qui implémente une méthode **execute()**.

Les **commandes concrète** implémente cette interface, elles contiennent la logique à exécuter, éventuellement une référence à un récepteur et encapsule
les paramètres de l'action.

On a l'**invokeur** qui va déclencher ces commandes sans connaitre leur type.

Donc le client assemble la commande concrète, le récepteur et les paramètres puis les donne à l'invoker.

## Structure

**Command** :
Interface qui déclare la méthode execute().

**ConcreteCommand** :
Implémente l’interface Command.
Elle appelle les méthodes d’un objet Receiver.

**Receiver** :
Classe qui contient la logique métier.

**Invoker** :
Déclenche la commande.
Il ne connaît que l’interface Command.

**Client** :
Crée les commandes et les configure avec leurs receivers.

## Avantages

- Découplage entre invokeur et receiver
- Possibilité de stocker les commandes (historique)
- Permet d'annuler ou recommencer les actions plus facilement
- Permet la mise en file d’attente (queue)
- Chaque action devient testable indépendamment
- Respect du principe Open/Closed

## inconvénients

- Augmente le nombre de classes
- Peut sembler lourd pour des actions simples
- Peut complexifier inutilement un petit projet

## Cas d'usage réel

Sur un site e-commerce, le pattern Command peut être implémenter au moment du passage d'une commande,
imaginons que notre site soit basé sur une architecture microservices, on aurait un service : 
- Stock
- Erp
- Email
- Payment
- ...

Au final, quand on clique sur le bouton "Commander", tout ces services seront concernés par la commandee et devront exécuté leur logique.

Donc le pattern Command est clairement adapté ici.