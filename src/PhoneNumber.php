<?php

declare(strict_types=1);

namespace Talentify\Whatsapp;

class PhoneNumber
{
    /**
     * This is what you use to send messages
     * @var string
     */
    private $id;
    /** @var string */
    private $verifiedName;
    /** @var string */
    private $codeVerificationStatus;
    /** @var string */
    private $displayPhoneNumber;
    /** @var string */
    private $qualityRating;

    public function __construct(
        string $id,
        string $verifiedName,
        string $codeVerificationStatus,
        string $displayPhoneNumber,
        string $qualityRating
    ) {
        $this->id                     = $id;
        $this->verifiedName           = $verifiedName;
        $this->codeVerificationStatus = $codeVerificationStatus;
        $this->displayPhoneNumber     = $displayPhoneNumber;
        $this->qualityRating          = $qualityRating;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getVerifiedName() : string
    {
        return $this->verifiedName;
    }

    public function getCodeVerificationStatus() : string
    {
        return $this->codeVerificationStatus;
    }

    public function getDisplayPhoneNumber() : string
    {
        return $this->displayPhoneNumber;
    }

    public function getQualityRating() : string
    {
        return $this->qualityRating;
    }
}
