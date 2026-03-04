<?php

/*
 * Ce script est un exemple d'adapter, il reprend le cas d'usage de l'explication
 */


/*
 * Interface pour envoyer vers l'ERP maison
 */
interface OrderExporter
{
    public function export(Order $order): void;
}

/*
 * le Client, il contient la logique métier
 */
class Order
{
    private int $id;
    private string $customer;
    private float $total;
    public function __construct(int $id, string $customer, float $total)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->total = $total;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}

/*
 * Le service externe
 */
class ExternalERP
{
    /*
     * Les paramètres sont différents
     */
    public function sendOrder(array $data): void
    {
        echo "Commande envoyée à l'ERP externe :\n";
        print_r($data);
    }
}

/*
 * L'adapter, il prend en attribut le service externe
 * et revois la méthode export() avec le Client
 */
class ERPAdapter implements OrderExporter
{
    private ExternalERP $erp;

    public function __construct(ExternalERP $erp)
    {
        $this->erp = $erp;
    }

    public function export(Order $order): void
    {
        // Transformation de l'objet Order en format attendu par l'ERP
        $formattedData = [
            'order_id' => $order->getId(),
            'client_name' => $order->getCustomer(),
            'amount_total' => $order->getTotal(),
        ];

        $this->erp->sendOrder($formattedData);
    }
}

// Exemple d'utilisation en utilisant l'adapter
$order = new Order(1, 'John Doe', 199.99);

$externalERP = new ExternalERP();
$orderExporter = new ERPAdapter($externalERP);

$orderExporter->export($order);