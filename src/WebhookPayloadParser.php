<?php

declare(strict_types=1);

namespace Talentify\Whatsapp;

use Talentify\Whatsapp\Webhook\Payload;
use Talentify\Whatsapp\Webhook\ValueObject\Contact;
use Talentify\Whatsapp\Webhook\ValueObject\Error;
use Talentify\Whatsapp\Webhook\ValueObject\IncomingMessage;
use Talentify\Whatsapp\Webhook\ValueObject\Metadata;
use Talentify\Whatsapp\Webhook\ValueObject\Profile;
use Talentify\Whatsapp\Webhook\ValueObject\Status;

/**
 * https://developers.facebook.com/docs/whatsapp/cloud-api/webhooks/components#webhooks-components
 */
class WebhookPayloadParser
{
    /**
     * @return Payload[]
     */
    public static function parse(array $data) : array
    {
        $object = $data['object']; //All Webhook events for Cloud API are under the whatsapp_business_account object
        if ($object !== 'whatsapp_business_account') {
            throw new \RuntimeException('Invalid payload provided. Object type is not "whatsapp_business_account"');
        }
        $valueObjects = [];
        $entries      = $data['entry']; //Array of entry objects
        foreach ($entries as $entry) {
            $id      = $entry['id']; //ID of Whatsapp Business Accounts this Webhook belongs to
            $changes = $entry['changes']; //Changes that triggered the Webhooks. This field contains an array of objects
            foreach ($changes as $change) {
                $value = $change['value']; //Contains details of the changes related to the specified field.
                $field = $change['field']; //Currently, the only option for this API is "messages".

                $metaData = new Metadata(
                    $value['metadata']['display_phone_number'],
                    $value['metadata']['phone_number_id']
                );

                $contactVOs = [];
                foreach ($value['contacts'] as $contact) {
                    $contactVOs[] = new Contact(
                        $contact['wa_id'],
                        new Profile($contact['profile']['name'])
                    );
                }

                $messageVOs = [];
                // Added to Webhooks for incoming message notifications.
                $messagesData = $value['messages'] ?? [];
                foreach ($messagesData as $messageDatum) {
                    $messageVOs[] = IncomingMessage::fromData($messageDatum);
                }

                $statusesVOs = [];
                // Added to Webhooks for message status update.
                $statusesData = $value['statuses'] ?? [];
                foreach ($statusesData as $statusesDatum) {
                    $statusesVOs[] = Status::fromData($statusesDatum);
                }

                $errorVOs   = [];
                $errorsData = $value['errors'] ?? [];
                foreach ($errorsData as $errorData) {
                    $errorVOs[] = new Error($errorData['code'], $errorData['title']);
                }

                $valueObjects[] = new Payload($metaData, $contactVOs, $messageVOs, $statusesVOs, $errorVOs);
            }
        }

        return $valueObjects;
    }
}
