<?php

/*
 * Ce script est un exemple de builder qui reprend le cas d'usage de l'explication
 */

/*
 * Le builder qui défini les étapes de construction commune
 */
interface Builder
{
    public function producePartOrderProducts(): void;
    public function producePartOrderCartRule(CartRule $cartRule): void;
    public function producePartOrderCustomer(): void;
    public function producePartOrderShipping(Shipping $shipping): void;
}

/*
 * Le builder concret, il peut y en avoir plusieurs
 * Celui-ci définit sa propre construction de l'objet Order
 * Possède une commande en attribut et la construit
 */
class OrderBuilder implements Builder
{
    private Order $order;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->order = new Order();
    }

    public function producePartOrderProducts(): void
    {
        $this->order->setProducts([
            'largeot moleskine noir', 'largeot moleskine écru', 'largeot moleskine noisette',
        ]);
    }

    public function producePartOrderCartRule(CartRule $cartRule): void
    {
        $this->order->setCartRule($cartRule);
    }

    public function producePartOrderCustomer(): void
    {
        $this->order->setCustomer('John Doe');
    }

    public function producePartOrderShipping(Shipping $shipping): void
    {
        $this->order->setShipping($shipping);
    }

    public function getOrder(): Order
    {
        $result = $this->order;
        $this->reset();
        return $result;
    }
}

/*
 * L'objet Order qui sera construit
 */
class Order
{
    private array $products;
    private CartRule $cartRule;
    private Shipping $shipping;
    private string $customer;

    public function getDescription(): string
    {
        $description = "Client : " . ($this->customer ?? 'Non défini') . "\n\n";
        $description .= "Produits :\n";

        if (!empty($this->products)) {
            foreach ($this->products as $product) {
                $description .= " - " . $product . "\n";
            }
        } else {
            $description .= " Aucun produit\n";
        }

        if (isset($this->shipping)) {
            $description .= "\nLivraison : "
                . $this->shipping->getName()
                . " (" . $this->shipping->getCost() . "€)\n";
        } else {
            $description .= "\nLivraison : Non définie\n";
        }

        if (isset($this->cartRule)) {
            $description .= "Code promo : "
                . $this->cartRule->getName()
                . " (-" . $this->cartRule->getDiscount() . "€)\n";
        }

        return $description;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function getCartRule(): CartRule
    {
        return $this->cartRule;
    }

    public function setCartRule(CartRule $cartRule): void
    {
        $this->cartRule = $cartRule;
    }

    public function getShipping(): Shipping
    {
        return $this->shipping;
    }

    public function setShipping(Shipping $shipping): void
    {
        $this->shipping = $shipping;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function setCustomer(string $customer): void
    {
        $this->customer = $customer;
    }
}

class CartRule
{
    private string $name;
    private float $discount;

    public function __construct(string $name, float $discount)
    {
        $this->name = $name;
        $this->discount = $discount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }
}

class Shipping
{
    private string $name;
    private float $cost;

    public function __construct(string $name, float $cost)
    {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $cost): void
    {
        $this->cost = $cost;
    }
}

/*
 * Le directeur (optionnel) qui décide de l'ordre et de quels attributs seront modifiés
 */
class Director
{
    private Builder $builder;
    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildOrder(): void
    {
        $this->builder->producePartOrderProducts();
        $this->builder->producePartOrderCustomer();
        $this->builder->producePartOrderShipping(new Shipping('Shipping', 10));
    }

    public function buildOrderWithCartRule()
    {
        $this->builder->producePartOrderProducts();
        $this->builder->producePartOrderCartRule(new CartRule('CartRule', 10));
        $this->builder->producePartOrderCustomer();
        $this->builder->producePartOrderShipping(new Shipping('Shipping', 10));
    }
}

// test de création d'une commande avec et sans code promo
$builder = new OrderBuilder();
$director = new Director();
$director->setBuilder($builder);

$director->buildOrder();
echo $builder->getOrder()->getDescription();
echo "\n";

$director->buildOrderWithCartRule();
echo $builder->getOrder()->getDescription();