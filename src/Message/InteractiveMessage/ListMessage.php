<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class ListMessage extends InteractiveMessage
{
    protected $interactionType = 'list';
    /** @var string */
    protected $text;
    /** @var string */
    private $button;
    /** @var \Talentify\Whatsapp\Message\InteractiveMessage\Section[] */
    private $sections;
    /** @var Header|null */
    private $header;
    /** @var Footer|null */
    private $footer;


    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function setHeader(string $header) : self
    {
        $this->header = new Header($header);

        return $this;
    }

    public function setFooter(string $footer) : self
    {
        $this->footer = new Footer($footer);

        return $this;
    }

    public function setButton(string $text) : self
    {
        $this->button = $text;

        return $this;
    }

    public function setSection(array $sections) : self
    {
        $newSection = [];

        foreach ($sections as $section){
            $newSection = new Section($section['title']);
            $newSection->addRow(
              $section['row_id'],
              $section['row_title'],
              $section['row_description']
            );
            $this->sections[] = $newSection->toArray();
        }

        return $this;
    }

    public function getInteractive() : array
    {
        return [
            'type' => $this->interactionType,
            'header' => $this->header->toArray(),
            'body' => ['text' => $this->text ],
            'footer' => $this->footer->toArray(),
            'action' => [
                'button' => $this->button,
                'sections' => $this->sections
            ]
        ];
    }
}
