# Parse Mime Messages from your Amazon S3 Bucket
[![Build Status](https://travis-ci.org/robbfountain/aws-s3-mime-handler.svg?branch=master)](https://travis-ci.org/robbfountain/aws-s3-mime-handler)
![StyleCI](https://github.styleci.io/repos/252616345/shield?branch=master)

Fetch and parse MIME messages from your Amazon S3 bucket.

## Installation
Require the package with composer.

```bash
composer require onethirtyone/aws-s3-mime-handler
```

You'll also need to make sure your AWS environment variables are set

```
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=
```

## Usage
The ```MessageCollector``` facade will return a collection of ```OneThirtyOne\Mime\Message``` instances.  Each of these instances is a fully parsed MIME message from your bucket. You can access the properties:

```php
MessageCollector::fromBucket()->each(function ($message) {
    $message->id;    // The message file name
    $message->to;    // Message recipient
    $message->from; // Message Sender
    $message->subject;  // Message Subject
    $message->body;  // The body of the message (plain text)
});
```
You can delete a message by calling the ```delete()``` method on a message object

```php
$message = MessageCollector::fromBucket()->first();

$message->delete();
```

## Contributing
Pull requests are welcome.  For major changes, please open an issue first to discuss what you would like to change

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
