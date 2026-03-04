# Observer

## Problèmes que résout l'observer

L'observer résout le problème où certaines classes changent régulièrement d'état et d'autre classes doivent être informées de ces changements, mais pas tous.
Au lieu de notifier tout le monde,
il notifie seulement ceux qui sont intéressés par un changement particulier.
Donc avec l'observer il n'y a plus de besoin de vérifier des informations ou d'être spammer, on s'abonne seulement à ce qu'on veut en
évitant les informations inutiles.

## Principe de fonctionnement

Le **Diffuseur** est la classe qui va subir des changements d'états, cette classe possède des méthodes d'abonnement et désabonnement pour
pouvoir ajouter des abonnés (des classes **Souscripteur concret**) afin de les notifier du changement. La méthode **notify** parcourt les **Souscripteur concret** et
appelle une méthode **update** sur chaque **Souscripteur concret**.

Les **Souscripteur concret** implémentent une même interface afin de forcer l'implémentation de la méthode **update** afin de pouvoir être notifié.

## Structure

**Diffuseur** : classe qui exécute des comportement ou change d'état, sur ces changements il notifie les **Souscripteur concret**, possède un attribut
qui est généralement $observers qui est un tableau de **Souscripteur concret** ainsi que les 3 méthodes **attach**, **detach** et **notify**. (notamment en PHP)

**Souscripteur** : Interface qui déclare la méthode **update** qui permet aux **Souscripteur concret** de pouvoir être notifié, en général cette 
méthode ne prend en paramètre que le changement d'état mais on peut très lui envoyer tout le contexte.

**Souscripteur concret** : Implémente l'interface **Souscripteur** pour éviter de coupler le **diffuseur** et les **souscripteur concret**, exécute un comportement
en fonction de la donnée reçu dans la méthode **update**.

## Avantages

- Respect de L'open-close principle, via les interfaces on peut facilement ajouter des souscripteur concret ou diffuseur (si ils ont une interface, comme PHP le propose nativement)
- Avoir une vision claire de la relation entre les classes
- Couplage faible (grâce aux interfaces)
- Permet la réutilisation de code dans d'autres contextes
- Respect SRP

## inconvénients

- la notification des souscripteurs concrets dépendent de leur ordre d'arrivé dans le tableau du diffuseur
- S'il y a beaucoup de souscripteur concrets et qu'on met à jour le diffuseur, on peut créer des effets de bord, complexifie le débuggage

## Cas d'usage réel

Sur un site e-commerce, quand on passe une commande, plein d'autres classes sont appelés pour mettre à jour le stock, envoyer un mail au client, générer une facture,
générer un bon d'achat si il y a une campagne, etc...
Donc utiliser l'observer dans ce cas est très pertinent, car à la validation du paiement on va notifier toutes ces classes pour qu'elles éxecutent leur traitement en conséquence.