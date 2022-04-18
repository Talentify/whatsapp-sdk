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
    private $components;

    public function __construct(string $name, string $language)
    {
        $this->name     = $name;
        $this->language = $language;
    }

    public function setComponents(array $components) : void
    {
        $this->components = $components;
    }

    public function toArray() : array
    {
        return [
            'name'       => $this->name,
            'language'   => [
                'code' => $this->language,
            ],
            'components' => $this->components,
        ];
    }
}
