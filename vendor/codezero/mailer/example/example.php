<?php

// Register Service Provider:
// CodeZero\Mailer\MailerServiceProvider

// Make or inject your mail composer class
$composer = app()->make('App\ExampleMailComposer');

// Compose and send
$composer->compose('example@example.com', 'Example Name')->send();
