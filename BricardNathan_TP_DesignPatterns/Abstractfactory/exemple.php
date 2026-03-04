<?php

/*
 * Ce script est un exemple d'abstract factory
 */

interface eCommerceShipping
{
    public function createTax(): Tax;
    public function createShipping(): Shipping;
}

class eCommerceShippingUSAFactory implements eCommerceShipping
{

    public function createTax(): Tax
    {
        return new USATax();
    }

    public function createShipping(): Shipping
    {
        return new USAShipping();
    }
}

class eCommerceShippingFranceFactory implements eCommerceShipping
{

    public function createTax(): Tax
    {
        return new FranceTax();
    }

    public function createShipping(): Shipping
    {
        return new FranceShipping();
    }
}

interface Shipping
{
    public function getCost(): float;
    public function getDeliveryName(): string;
}

interface Tax
{
    public function getCost(): float;
    public function getTaxName(): string;
}

class FranceTax implements Tax
{
    public function getCost(): float
    {
        return 10;
    }

    public function getTaxName(): string
    {
        return 'Taxe France';
    }
}

class USATax implements Tax
{
    public function getCost(): float
    {
        return 15;
    }

    public function getTaxName(): string
    {
        return 'Taxe USA';
    }
}

class FranceShipping implements Shipping
{
    public function getCost(): float
    {
        return 10;
    }
    public function getDeliveryName(): string
    {
        return 'Colissimo';
    }
}

class USAShipping implements Shipping
{
    public function getCost(): float
    {
        return 20;
    }
    public function getDeliveryName(): string
    {
        return 'UPS';
    }
}

class Order
{
    private Shipping $shipping;
    private Tax $tax;
    private float $total;

    public function __construct(eCommerceShipping $shipping, float $total)
    {
        $this->shipping = $shipping->createShipping();
        $this->tax = $shipping->createTax();
        $this->total = $total;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getTax(): Tax
    {
        return $this->tax;
    }

    public function getShipping(): Shipping
    {
        return $this->shipping;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function setTax(Tax $tax): void
    {
        $this->tax = $tax;
    }
}

// Création d'une commande pour la France
$order = new Order(new eCommerceShippingFranceFactory(), 100);
echo "Commande pour la France, mode de livraison :";
echo $order->getShipping()->getDeliveryName();
echo "\n";
echo "Taxe (en %) : ";
echo $order->getTax()->getCost();
echo "\n";
echo "total commande (en €) : ";
echo $order->getTotal();
echo "\n";

//Création d'une commande pour les USA
$order = new Order(new eCommerceShippingUSAFactory(), 100);
echo "Commande pour les USA, mode de livraison :";
echo $order->getShipping()->getDeliveryName();
echo "\n";
echo "Taxe (en %) : ";
echo $order->getTax()->getCost();
echo "\n";
echo "total commande (en €) : ";
echo $order->getTotal();
echo "\n";