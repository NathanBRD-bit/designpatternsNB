<?php

/*
 * Cet exemple reprend le cas d'usage de l'explication
 */

class OrderSubject implements \SplSubject
{
    private SplObjectStorage $observers;
    private float $price;
    private string $state;
    private array $products;

    public function __construct(float $price, string $state, array $products)
    {
        $this->price = $price;
        $this->state = $state;
        $this->observers = new SplObjectStorage();
        $this->products = $products;
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
        $this->notify();
    }

    public function getObservers(): SplObjectStorage
    {
        return $this->observers;
    }

    public function setObservers(SplObjectStorage $observers): void
    {
        $this->observers = $observers;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }
}

class StockObserver implements SplObserver
{

    public function update(SplSubject $subject): void
    {
        if ($subject->getState() === 'paiement validé') {
            foreach($subject->getProducts() as $product) {
                $product['stock'] -= 1;
                echo 'Nouveau stock de ' . $product['name'] . ' : ' . $product['stock'];
                echo "\n";
            }
        }
    }
}

class EmailObserver implements SplObserver
{
    public function update(SplSubject $subject): void
    {
        if ($subject->getState() === 'en attente de paiement par chèque') {
            echo 'Mail d\'attente de paiement envoyé avec coordonées bancaires de l\'entreprise';
            echo "\n";
        }

        if ($subject->getState() === 'paiement validé') {
            echo 'Mail de remerciement envoyé avec facture';
            echo "\n";
        }
    }
}

// C'est un exemple de commande
$order = new OrderSubject(
    204.99,
    'Entrée tunnel de paiement',
    [
        ['name' => 'Largeot moleskine', 'stock' => 10],
        ['name' => 'Largeot velours', 'stock' => 4],
        ['name' => 'Largeot lin', 'stock' => 1],
    ]
);
$stock = new StockObserver();
$email = new EmailObserver();
$order->attach($stock);
$order->attach($email);
$order->setState('en attente de paiement par chèque');
$order->setState('paiement validé');