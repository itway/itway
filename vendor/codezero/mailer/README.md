# Mailer

[![GitHub release](https://img.shields.io/github/release/codezero-be/mailer.svg)]()
[![License](https://img.shields.io/packagist/l/codezero/mailer.svg)]()
[![Build Status](https://img.shields.io/travis/codezero-be/mailer.svg?branch=master)](https://travis-ci.org/codezero-be/mailer)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/codezero-be/mailer.svg)](https://scrutinizer-ci.com/g/codezero-be/mailer)
[![Total Downloads](https://img.shields.io/packagist/dt/codezero/mailer.svg)](https://packagist.org/packages/codezero/mailer)

### Send mail in PHP (with [Laravel 5](http://laravel.com/) implementation).

## Laravel 5 Installation

Install this package through Composer:

    composer require codezero/mailer

Add a reference to `MailerServiceProvider` to the providers array in `config/app.php`:

    'providers' => [
        'CodeZero\Mailer\MailerServiceProvider'
    ]

## Usage

Create a new `MailComposer` class that extends `CodeZero\Mailer\MailComposer`.

	<?php
	
	namespace App;
	
	use CodeZero\Mailer\MailComposer;
	
	class WelcomeMailComposer extends MailComposer
	{
	    /**
	     * Compose a welcome mail.
	     *
	     * @param string $email
	     * @param string $firstname
	     *
	     * @return \CodeZero\Mailer\Mail
	     */
	    public function compose($email, $firstname)
	    {
	        $toEmail = $email;
	        $toName = $firstname;
	        $subject = 'Welcome!';
	        $view = 'emails.welcome';
	        $data = ['name' => $firstname];
            $options = null;
	
	        return $this->getMail($toEmail, $toName, $subject, $view, $data, $options);
	    }
	}

You can accept any parameters you want in the `compose()` method (and actually name it whatever you like). The important part is that you call the `getMail()` method on the base class. This will return a `CodeZero\Mailer\Mail` object, that you use to `send()` the message.

	// Make or inject your mail composer class
	$mail = app()->make('App\WelcomeMailComposer');

	// Compose and send
	$mail->compose('example@example.com', 'Example Name')->send(); 

This will call Laravel's `Mail::queue()` behind the scenes.

## Testing

    $ vendor/bin/phpspec run

## Security

If you discover any security related issues, please [e-mail me](mailto:ivan@codezero.be) instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

---
[![Analytics](https://ga-beacon.appspot.com/UA-58876018-1/codezero-be/mailer)](https://github.com/igrigorik/ga-beacon)