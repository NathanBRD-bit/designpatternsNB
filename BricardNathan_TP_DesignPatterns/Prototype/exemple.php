<?php

/*
 * Ce script est un exemple du design pattern Prototype, il reprend le cas d'usage de l'explication.
 * PHP a déjà une méthode built-in clone() qui permet de faire une copie d'un objet sans définir de méthode particulière
 * il suffit de faire clone $objet pour faire une copie de l'objet, mais s'il y a des objets imbriqués, il faut définir la méthode __clone()
 * nous-même pour gérer les pointeurs.
 */

/*
 * L'interface Prototype qui définit la méthode de clonage,
 * __clone() permet d'exécuter un comportement spécifique quand on fait clone $object pour gérer les cas particuliers
 */
interface Prototype {
    public function __clone();
}

/*
 * Le prototype concret, il implémente la méthode __clone() qui copie les attributs de l'objet original dans le clone
 * afin d'avoir un clone dans le même état que l'original
 */
class PackProduct implements Prototype {

    public array $products;
    public string $name;
    public float $price;
    public string $color;

    /*
     * Revient a juste faire un clone de l'objet original, je n'ai pas de raison d'avoir des objets imbriqués dans cet exemple
     */
    public function __clone()
    {
        $this->products = array_merge([], $this->products);
    }

    public function __construct(array $products, string $name, float $price, string $color)
    {
    $this->products = $products;
    $this->name = $name;
    $this->price = $price;
    $this->color = $color;
    }

    public function getDescriptionPack()
    {
        echo $this->name . ' au prix de : ' . $this->price .'€';
        foreach ($this->products as $product) {
            echo ' - ' . $product;
        }
        echo ' de couleur ' . strtoupper($this->color);
        echo "\n";
    }
}

// Le pack 1 sert de modèle pour le pack 2, on peut imaganier plein de packs différents mais qui peuvent avoir certaines variantes mais qui possède les mêmes bases
// Donc le prototype est un choix pertinent ici
$pack1 = new PackProduct(['Largeot moleskine', 'Largeot velours', 'Largeot lin'], 'Pack de 3 largeots', 314.99, 'noir');
$pack2 = clone $pack1;
$pack2->color = 'écru';
$pack1->getDescriptionPack();
$pack2->getDescriptionPack();

if ($pack1->products === $pack2->products && $pack1->name === $pack2->name && $pack1->price === $pack2->price && $pack1->color !== $pack2->color) {
    echo 'Même packs mais pas la même couleur';
}