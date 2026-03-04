<?php

/*
 * Ce script est un exemple de facade
 * L'exemple est tiré du cas d'usage de l'explication
 */


/*
 * Classe Facade qui encapsule les services externes
 */
class OrderFacade
{
    private StockChecker $stockChecker;
    private ShippingCalculator $shippingCalculator;
    private TaxCalculator $taxCalculator;
    private CartRuleProcessor $cartRuleProcessor;
    private OrderRepository $repository;
    private EmailService $emailService;
    private ErpExporter $erpExporter;

    public function __construct(
        StockChecker $stockChecker,
        ShippingCalculator $shippingCalculator,
        TaxCalculator $taxCalculator,
        CartRuleProcessor $cartRuleProcessor,
        OrderRepository $repository,
        EmailService $emailService,
        ErpExporter $erpExporter
    )
    {
        $this->stockChecker = $stockChecker;
        $this->shippingCalculator = $shippingCalculator;
        $this->taxCalculator = $taxCalculator;
        $this->repository = $repository;
        $this->emailService = $emailService;
        $this->erpExporter = $erpExporter;
        $this->cartRuleProcessor = $cartRuleProcessor;
    }

    /*
     * Méthode qui gère l'ordre des appels des méthodes des services externes
     */
    public function placeOrder(Order $order): void
    {
        $this->stockChecker->check($order);
        $this->shippingCalculator->calculate($order);
        $this->taxCalculator->calculate($order);
        $this->cartRuleProcessor->apply($order);

        $this->repository->save($order);
        $this->emailService->send($order);
        $this->erpExporter->export($order);

        echo "La commande a été crée pour un total de :" . $order->getTotal() . "€\n";
    }
}

/*
 * Classe Order simple
 */
class Order
{
    private array $products;
    private float $total = 0;
    private float $shippingCost = 0;
    private float $taxAmount = 0;
    private float $discount = 0;

    public function __construct(array $products)
    {
        $this->products = $products;
        $this->total = array_sum($products);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotal(): float
    {
        return $this->total + $this->shippingCost + $this->taxAmount - $this->discount;
    }

    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(float $taxAmount): void
    {
        $this->taxAmount = $taxAmount;
    }

    public function getShippingCost(): float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(float $shippingCost): void
    {
        $this->shippingCost = $shippingCost;
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

/*
 * Les services externes
 */
class StockChecker
{
    public function check(Order $order): void
    {
        echo "Vérification du stock de chaque produits\n";
    }
}

class ShippingCalculator
{
    public function calculate(Order $order): void
    {
        echo "Calcul des frais de livraison \n";
        $order->setShippingCost(10);
    }
}

class TaxCalculator
{
    public function calculate(Order $order): void
    {
        echo "Calcul des taxes \n";
        $order->setTaxAmount(20);
    }
}

class CartRuleProcessor
{
    public function apply(Order $order): void
    {
        echo "Ajout d'un bon d'achat \n";
        $order->setDiscount(5);
    }
}

class OrderRepository
{
    public function save(Order $order): void
    {
        echo "Création de la commande en BDD\n";
    }
}

class EmailService
{
    public function send(Order $order): void
    {
        echo "Envoie d'un email au client \n";
    }
}

class ErpExporter
{
    public function export(Order $order): void
    {
        echo "Export vers l'ERP maison \n";
    }
}

// Création d'une commande
$order = new Order([50, 30, 20]); // Je ne mets que le prix des produits pour simplifier

//Instanciation d'une façade avec chaque service externe
$facade = new OrderFacade(
    new StockChecker(),
    new ShippingCalculator(),
    new TaxCalculator(),
    new CartRuleProcessor(),
    new OrderRepository(),
    new EmailService(),
    new ErpExporter()
);

// Le process de création de commande est exécuté sans que le client ne connaisse le fonctionnement interne
$facade->placeOrder($order);