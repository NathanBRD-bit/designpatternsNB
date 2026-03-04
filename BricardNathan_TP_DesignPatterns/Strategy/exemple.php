<?php

/*
 * Ce script est un exemple du pattern Strategy
 * Il est tiré du cas d'usage de l'explication
 */

/*
 * L'interface Strategy, défini la méthode de tri des produits commune aux stratégies concrètes
 */
interface sortProducts
{
    public function sortProducts(array $products): array;
}

/*
 * Stratégie concrète, tri par prix
 */
class SortByPrice implements sortProducts
{
    public function sortProducts(array $products): array
    {
        usort($products, function ($a, $b) {
            return $a['price'] - $b['price'];
        });
        return $products;
    }
}

/*
 * Stratégie conrète, tri par nom
 */
class SortByName implements sortProducts
{
    public function sortProducts(array $products): array
    {
        usort($products, function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });
        return $products;
    }
}

/*
 * Classe qui fait office de context, possède une instance de type sortProducts, donc ne connait pas la stratégie concrète utilisée
 */
class Category
{
    private sortProducts $sortProducts;
    private array $products;

    public function __construct(sortProducts $sortProducts, array $products)
    {
        $this->sortProducts = $sortProducts;
        $this->products = $products;
    }

    public function setSortProducts(sortProducts $sortProducts): void
    {
        $this->sortProducts = $sortProducts;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    /*
     * logique métier qui a besoin de trier les produits
     */
    public function displaySortedProducts(): void
    {
        $sortedProducts = ($this->sortProducts->sortProducts($this->products));
        foreach ($sortedProducts as $product) {
            echo $product['name'] . ' - ' . $product['price'];
        }
    }
}


// Test d'abord du trie par nom
$category = new Category(new SortByName(),
[
    ['name' => 'Largeot moleskine', 'price' => 104.99],
    ['name' => 'Largeot velours', 'price' => 114.99],
    ['name' => 'Largeot lin', 'price' => 124.99],
    ['name' => 'Chaussure Cofra', 'price' => 74.99],
]);

$category->displaySortedProducts();
echo "\n";
// Test du trie par prix
$category->setSortProducts(new SortByPrice());
$category->displaySortedProducts();