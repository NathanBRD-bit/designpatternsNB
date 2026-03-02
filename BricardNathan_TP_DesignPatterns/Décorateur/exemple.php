<?php

/*
 * Ce script est un exemple de décorateur sur une classe BaseOrder qui sera décoré pour ajouter différentes informations
 * sans modifier la classe BaseOrder (Respect de l'open/close principle)
 */

/*
 * Component (Interface) Order
 */

interface Order
{
    public function getCost(): float;
    public function getDescription(): string;
}

/*
 * Concrete Component (Class) BaseOrder
 * Je reste assez light, j'affiche juste le prix de la commande et sa description
 */

class BaseOrder implements Order
{
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getCost(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return "Commande de base";
    }
}

/*
 * Le décorateur de base qui servira de base commune aux autres
 * Implémentation de l'interface Order et sa référence dans l'attribut protégé $order
 * permet de décorer un objet et sans le connaitre spécifiquement, on sait juste qu'il respecte le contrat Order.
 */

abstract class OrderDecorator implements Order
{
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getCost(): float
    {
        return $this->order->getCost(); // Délègue le calcul au composant de base
    }

    public function getDescription(): string
    {
        return $this->order->getDescription();
    }
}

/*
 * Décorateur concret qui ajoute à la commande un message cadeau (si on le souhaite) qui coute 5 euros de plus
 */

class GiftMessageDecorator extends OrderDecorator
{
    public function getCost(): float
    {
        return parent::getCost() + 5; // Appelle au décorateur de base qui délègue le calcul afin d'avoir le prix de la commande
    }

    public function getDescription(): string
    {
        return parent::getDescription() . " + Emballage cadeau";
    }
}

/*
 * Décporateur concret mode de livraison express qui coute 15 euros de plus
 */

class ExpressShippingDecorator extends OrderDecorator
{
    public function getCost(): float
    {
        return parent::getCost() + 15;
    }

    public function getDescription(): string
    {
        return parent::getDescription() . " + Livraison express";
    }
}

//Commande basic
$order = new BaseOrder(100);
// Ajout d'un message cadeau
$order = new GiftMessageDecorator($order);
// Ajout d'une livraison express
$order = new ExpressShippingDecorator($order);

//Donc on a BaseOrder -> GiftMessageDecorator -> ExpressShippingDecorator

echo $order->getDescription();
echo "\nPrix total : " . $order->getCost() . "€";