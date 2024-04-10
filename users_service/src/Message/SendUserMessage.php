<?php

namespace App\Message;


class SendUserMessage
{
    /*
     * Add whatever properties and methods you need
     * to hold the data for this message class.
     */

    private $user;

    public function __construct(string $user)
    {
        $this->user = $user;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}
