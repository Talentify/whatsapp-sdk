<?php

declare(strict_types=1);

namespace Talentify\Whatsapp;

use Talentify\Whatsapp\Message\Message;
use GuzzleHttp\Client;
use Talentify\Json\Json;

class WhatsappApiClient
{
    /** @var string */
    private $wapBusinessAccId;
    /** @var string */
    private $accessToken;
    /** @var \GuzzleHttp\Client */
    private $http;
    /** @var string */
    private $baseUri;

    public function __construct(string $whatsappBusinessAccountId, string $accessToken, string $apiVersion = 'v13.0')
    {
        $this->wapBusinessAccId = $whatsappBusinessAccountId;
        $this->accessToken      = $accessToken;
        $this->apiVersion       = $apiVersion;
        $this->http             = new Client();
        $this->baseUri          = "https://graph.facebook.com/$apiVersion";
    }

    /**
     * https://developers.facebook.com/docs/whatsapp/business-management-api/manage-phone-numbers#get-all-phone-numbers
     */
    public function getPhoneNumbers() : array
    {
        $response =
            $this->http->get("$this->baseUri/$this->wapBusinessAccId/phone_numbers?access_token=$this->accessToken");

        $parsedResponse = Json::decode($response->getBody()->getContents(), true);
        $phoneNumbers   = [];
        foreach ($parsedResponse['data'] as $phoneData) {
            $phoneNumbers[] = new PhoneNumber(
                $phoneData['id'],
                $phoneData['verified_name'],
                $phoneData['code_verification_status'],
                $phoneData['display_phone_number'],
                $phoneData['quality_rating']
            );
        }

        return $phoneNumbers;
    }

    public function sendMessage(Message $message) : array
    {
        $fromNumberId = $message->getFromNumberId();
        $type         = $message->type();
        $response = $this->http->post(
            "$this->baseUri/$fromNumberId/messages?access_token=$this->accessToken",
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json'    => [
                    'messaging_product' => 'whatsapp',
                    'recipient_type'    => 'individual',
                    'to'                => $message->to(),
                    'type'              => $type,
                    $type               => $message->toArray(),
                ],
            ]
        );

        return Json::decode($response->getBody()->getContents(), true);
    }
}
