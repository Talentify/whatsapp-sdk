```php
$client =  new WhatsappApiClient('biz_id', 'token');

// Get registered phone numbers
$phoneNumbers = $client->getPhoneNumbers();
$phoneNumber = $phoneNumbers[0];

// Some message examples. Check Message folder for full list
//Templated Message
$textMessage = (new TemplateMessage('hello_world', 'en_US'))
   ->setFromNumberId($phoneNumber->getId())
   ->setTo('5511999998888');
$client->sendMessage($textMessage);

//Reply Button Message
$textMessage = (new ReplyButtonMessage('this is the button text'))
   ->setFromNumberId($phoneNumber->getId())
   ->setTo('5511999998888')
   ->setHeader(new Header('This is a header'))
   ->addButton('primeiro', '1')
   ->addButton('segundo', '2');
$client->sendMessage($textMessage);

//List Message with sections
$section = new Section('my section');
$section = $section->addRow('1', 'title', 'description')->addRow('2', 'cool', 'nice');
$textMessage = (new ListMessage('this is the button text'))
   ->setFromNumberId($phoneNumber->getId())
   ->setTo('5511999998888')
   ->setHeader(new Header('This is a header'))
   ->addButton('Botao')
   ->addSection($section)
   ->addSection($section);
$client->sendMessage($textMessage);
```

Parsing incoming webhook
```php
// Return an array with all changes informed by the payload
$payloads = WebhookPayloadParser::parse($request->getParsedBody());
```
