<?php

namespace App\MessageHandler;

use App\Message\SendUserMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendUserMessageHandler
{
    public function __invoke(SendUserMessage $message)
    {
        print_r('Handler handled the message! ' . $message->getUser());
    }
}
