<?php

declare(strict_types=1);

namespace Talentify\Whatsapp\Message\InteractiveMessage;

class ListMessage extends InteractiveMessage
{
    protected $interactionType = 'list';
    /** @var string */
    protected string $text;
    /** @var string */
    private string $button;
    /** @var \Talentify\Whatsapp\Message\InteractiveMessage\Section[] */
    private array $sections;
    /** @var Header|null */
    private ?Header $header;
    /** @var Footer|null */
    private ?Footer $footer;


    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function setHeader(?string $header): void
    {
        if ($header === null){
            $this->header = $header;
            return;
        }
        $this->header = new Header($header);
    }

    public function setFooter(?string $footer): void
    {
        if ($footer === null){
            $this->footer = $footer;
            return;
        }
        $this->footer = new Footer($footer);

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
        $message = [];

        $message['type'] = $this->interactionType;

        $message['body'] = ['text' => $this->text];

        if ($this->header !== null){
            $message['header'] = $this->header->toArray();
        }

        if ($this->footer !== null){
            $message['footer'] = $this->footer->toArray();
        }

        $message['action']['button'] = $this->button;

        $message['action']['sections'] = $this->sections;

        return $message;
    }
}
