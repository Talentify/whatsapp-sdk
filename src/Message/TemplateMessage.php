<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message;

/**
 * https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#template-object
 */
class TemplateMessage extends Message
{
    protected $type = 'template';
    /**
     * The template name
     * @var string
     */
    private $name;
    /** @var string */
    private $language;
    /** @var array */
    private $params;

    public function __construct(string $name, string $language)
    {
        $this->name = $name;
        $this->language = $language;
    }

    public function addTextParam(string $text): void
    {
        $this->params[] = $text;
    }

    public function toArray(): array
    {
        $params = [];
        foreach ($this->params as $param) {
            $params['parameters'][] = ['type' => 'text', 'text' => $param];
        }

        $finalComponent = \count($params)> 0 ? array_merge(['type' => 'body'], $params) : [];

        return [
            'name' => $this->name,
            'language' => [
                'code' => $this->language,
            ],
            'components' => [$finalComponent]
        ];
    }
}
