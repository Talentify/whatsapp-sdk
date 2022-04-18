<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Webhook\ValueObject;

class Interactive
{
    /** @var string */
    private $type;
    /** @var \Talentify\Whatsapp\Webhook\ValueObject\Reply */
    private $reply;

    private function __construct(string $type, Reply $reply)
    {
        $this->type  = $type;
        $this->reply = $reply;
    }

    public static function fromInteractive(array $data) : self
    {
        if ($data['type'] === 'button_reply') {
            return new Interactive(
                $data['type'],
                new Reply(
                    $data['button_reply']['id'],
                    $data['button_reply']['title'],
                    null
                )
            );
        }

        return new Interactive(
            $data['type'],
            new Reply(
                $data['list_reply']['id'],
                $data['list_reply']['title'],
                $data['list_reply']['description']
            )
        );
    }

    public function getType() : string
    {
        return $this->type;
    }

    public function getReply() : Reply
    {
        return $this->reply;
    }
}
