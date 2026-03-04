<?php

/*
 * Interface Command, déclare une méthode execute utilisée par toutes les commands concretes
 */
interface Command
{
    public function execute(): void;
}

/*
 * Les concretes commands
 * Font référence au receiver qu'elles doivent appeler
 */
class CapturePaymentCommand implements Command
{
    private PaymentService $paymentService;
    private float $amount;
    public function __construct(PaymentService $paymentService, float $amount)
    {
        $this->paymentService = $paymentService;
        $this->amount = $amount;
    }

    /*
     * Appel au receiver
     */
    public function execute(): void
    {
        $this->paymentService->capture($this->amount);
    }
}

class UpdateStockCommand implements Command
{
    private StockService $stockService;
    private int $orderId;
    public function __construct(StockService $stockService, int $orderId)
    {
        $this->stockService = $stockService;
        $this->orderId = $orderId;
    }

    public function execute(): void
    {
        $this->stockService->update($this->orderId);
    }
}

class SendConfirmationEmailCommand implements Command
{
    private EmailService $emailService;
    private int $orderId;
    public function __construct(EmailService $emailService, int $orderId)
    {
        $this->emailService = $emailService;
        $this->orderId = $orderId;
    }

    public function execute(): void
    {
        $this->emailService->sendConfirmation($this->orderId);
    }
}

class ExportOrderToErpCommand implements Command
{
    private ErpService $erpService;
    private int $orderId;
    public function __construct(ErpService $erpService, int $orderId)
    {
        $this->erpService = $erpService;
        $this->orderId = $orderId;
    }

    public function execute(): void
    {
        $this->erpService->export($this->orderId);
    }
}

/*
 * L'invoker envoie les demandes, dans mon contexte j'ai besoin de plusieurs concrete commands
 * donc je les stocke dans un tableau
 * il déclenche les commandes en appelant execute()
 */
class CommandInvoker
{
    private array $commands = [];

    public function add(Command $command): void
    {
        $this->commands[] = $command;
    }

    public function executeAll(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}

/*
 * Services contenant les logiques métier
 */
class PaymentService
{
    public function capture(float $amount): void
    {
        echo "Paiement capturé : " . $amount . "€\n";
    }
}

class StockService
{
    public function update(int $orderId): void
    {
        echo "Stock mis à jour pour la commande #" . $orderId . "\n";
    }
}

class EmailService
{
    public function sendConfirmation(int $orderId): void
    {
        echo "Email envoyé pour la commande #" . $orderId . "\n";
    }
}

class ErpService
{
    public function export(int $orderId): void
    {
        echo "Commande #" . $orderId . " exportée vers l'ERP\n";
    }
}

// Le client
// instancie les services, invoker et déclenche des commandes
$paymentService = new PaymentService();
$stockService = new StockService();
$emailService = new EmailService();
$erpService = new ErpService();

$invoker = new CommandInvoker();

$invoker->add(new CapturePaymentCommand($paymentService, 199.99));
$invoker->add(new UpdateStockCommand($stockService, 123));
$invoker->add(new SendConfirmationEmailCommand($emailService, 123));
$invoker->add(new ExportOrderToErpCommand($erpService, 123));

$invoker->executeAll();