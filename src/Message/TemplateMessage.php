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
    /** @var array */
    private $cta;

    public function __construct(string $name, string $language)
    {
        $this->name = $name;
        $this->language = $language;
    }

    public function addCtaParam(string $cta): void
    {
        $this->cta = [
            'type' => 'button',
            'subtype' => 'url',
            'index' => 1,
            'parameters' => [
                'type' => 'text',
                'text' => $cta
            ]
        ];
    }

    public function addTextParam(string $text): void
    {
        $this->params[] = $text;
    }

    public function toArray(): array
    {
        $params = [];

        if ($this->params !== null ){
            foreach ($this->params as $param) {
                $params['parameters'][] = ['type' => 'text', 'text' => $param];
            }
        }

        $bodyComponent = \count($params) > 0 ? array_merge(['type' => 'body'], $params) : [];

        $finalComponent = array_merge($bodyComponent, $this->cta);

        return [
            'name' => $this->name,
            'language' => [
                'code' => $this->language,
            ],
            'components' => [$finalComponent]
        ];
    }
}
