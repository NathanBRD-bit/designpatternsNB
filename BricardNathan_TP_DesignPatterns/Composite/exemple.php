<?php

/*
 * Ce script est un exemple de composite
 * Il reprend le cas d'usage de l'explication (catégorie, sous-catégorie, produit)
 */

/*
 * Interface qui défini les méthodes communes aux différents Components
 */
interface Catalog
{
    public function getName(): string;
    public function getPrice(): float;
}

/*
 * La Leaf, ne peut pas avoir de components en plus
 */
class Product implements Catalog
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

/*
 * Le composite, peut avoir des components en plus
 */
class Category implements Catalog
{
    private string $name;
    private SplObjectStorage $children; // Produits ou catégories

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->children = new SplObjectStorage();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        $total = 0;
        foreach ($this->children as $child) {
            $total += $child->getPrice();
        }
        return $total;
    }

    public function addChild(Catalog $child): void
    {
        $this->children->attach($child);
    }

    public function removeChild(Catalog $child): void
    {
        $this->children->detach($child);
    }
}

// Instanciation des objets de type Category et Product
$largeots = new Category('Largeots');
$largeotsVelours = new Category('Largeots Velours');
$largeotsMoleskine = new Category('Largeots Moleskine');
$largeotMoleskineNoir = new Product('Largeot moleskine noir', 104.99);
$largeotMoleskineEcru = new Product('Largeot moleskine écru', 104.99);
$largeotMoleskineNoisette = new Product('Largeot moleskine noisette', 104.99);
$largeotVeloursNoir = new Product('Largeot velours noir', 114.99);
$largeotVeloursEcru = new Product('Largeot velours écru', 114.99);
$largeotVeloursNoisette = new Product('Largeot velours noisette', 114.99);

// Ajout des objets enfants
$largeots->addChild($largeotsMoleskine);
$largeots->addChild($largeotsVelours);
$largeotsMoleskine->addChild($largeotMoleskineNoir);
$largeotsMoleskine->addChild($largeotMoleskineEcru);
$largeotsMoleskine->addChild($largeotMoleskineNoisette);
$largeotsVelours->addChild($largeotVeloursNoir);
$largeotsVelours->addChild($largeotVeloursEcru);
$largeotsVelours->addChild($largeotVeloursNoisette);

echo "Prix total des largeots : ";
echo $largeots->getPrice() . "€";
echo "\n";
echo "Prix total des largeots velours : ";
echo $largeotsVelours->getPrice() . "€";
echo "\n";
echo "Prix total des largeots moleskine : ";
echo $largeotsMoleskine->getPrice() . "€";