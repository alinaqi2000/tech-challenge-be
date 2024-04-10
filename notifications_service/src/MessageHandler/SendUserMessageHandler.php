<?php

namespace App\MessageHandler;

use App\Message\SendUserMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

#[AsMessageHandler]
class SendUserMessageHandler implements MessageHandlerInterface
{
    private $logger;

    public function __construct(LoggerInterface $notificationLogger)
    {
        $this->logger = $notificationLogger;
    }
    public function __invoke(SendUserMessage $message)
    {
        $user = json_decode($message->getUser(), true);

        // send notification

        $this->logger->log(LogLevel::INFO, $user['firstName'] . " " . $user['lastName'] . ' creation has been notified.', ['channel' => 'notification']);
    }
}
