<?php

/**
 * Ce script est un exemple qui reflète un serveur smtp qui envoi des mails au client
 *
 *
 */

/**
 * Classe singleton du serveur SMTP
 */
class SmtpServer
{
    private static SmtpServer $instance; // instance de type SmtpServer
    private string $host;
    private int $port;
    private string $key;

    private function __construct($host, $port, $key) // constructeur privé pour empêcher l'initialiser via d'autres objets
    {
        $this->host = $host;
        $this->port = $port;
        $this->key = $key;
    }

    public static function getInstance($host, $port, $key) // méthode accessible par la classe pour initialiser l'instance
    {
        if (!isset(self::$instance)) {
            self::$instance = new SmtpServer($host, $port, $key);
        }
        return self::$instance;
    }

    public function send($msg, $customerName) // code métier relatif à un serveur smtp typique
    {
        return $customerName. ', voici votre récapitulatif de commande : ' . $msg;
    }
}

// Récupération de l'instance unique
$mailer = SmtpServer::getInstance('smtp-server', 3000, 'uvUHUob9EE6ed');
echo $mailer->send('2 largeots pour 230 € !', 'John Doe');
// Affiche : John Doe, voici votre récapitulatif de commande : 2 largeots pour 230 € !

$mailer2 = SmtpServer::getInstance('smtp-serverrege', 3020, 'uvUHUob9ErE6ed');
if ($mailer === $mailer2) {
    echo 'c\'est la même instance !';
}