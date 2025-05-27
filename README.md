# Laravel AI SpamDetector

Laravel wrapper for [AI SpamDetector](https://github.com/isap-ou/ai-spamdetector) – protect your contact forms from spam and bots using OpenAI GPT. This package provides seamless Laravel integration for intelligent spam filtering with minimal setup.

[![AI SpamDetector](https://static.isap.me/laravel-ai-spamdeterctor.jpg)](https://github.com/isap-ou/laravel-ai-spamdetector)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/isapp/laravel-ai-spamdetector.svg?style=flat-square)](https://packagist.org/packages/isapp/laravel-ai-spamdetector)
[![Total Downloads](https://img.shields.io/packagist/dt/isapp/laravel-ai-spamdetector.svg?style=flat-square)](https://packagist.org/packages/isapp/laravel-ai-spamdetector)

## Features

- 🧠 AI-based spam detection using OpenAI GPT
- ⚡️ Lightweight and efficient
- 🛠️ Simple configuration with `.env`

## Installation

```bash
composer require your-vendor/laravel-ai-spamdetector
```

## Configuration

You can configure the package in two ways:

### 1. Using `.env` variables (recommended for simple setups)

Add the following to your `.env` file:

```dotenv
AI_SPAMDETECTOR_OPENAI_API_KEY=your-openai-api-key
AI_SPAMDETECTOR_OPENAI_ORGANIZATION=openai-organization-id
AI_SPAMDETECTOR_OPENAI_PROJECT=your-openai-project-id # Optional
AI_SPAMDETECTOR_OPENAI_BASE_URI=api.openai.com/v1 # Optional, defaults to OpenAI API
AI_SPAMDETECTOR_OPENAI_MODEL=gpt-4 # Optional, default is gpt-4
```
> 💡 If you already have `OPENAI_API_KEY` defined in your project, it will be used automatically — no need to duplicate it.
> Available fallback variables:
> - `OPENAI_API_KEY`
> - `OPENAI_ORGANIZATION`
> - `OPENAI_PROJECT`
> - `OPENAI_BASE_URI`
> - `OPENAI_MODEL`


### 2. Publishing the config file

If you need more control, publish the configuration file:

```bash
php artisan vendor:publish --provider="Isapp\LaravelAiSpamdetector\SpamDetectorServiceProvider"
```

## Usage

### 1. Dependency Injection

```php

use Illuminate\Http\Request;
use Isapp\AiSpamdetector\SpamDetector;

public function index (Request $request, SpamDetector $spamDetector)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'message' => 'required|string|max:255',
    ]);
    
    $formData = new \Isapp\AiSpamdetector\FormData(
        name: $request->input('name'),
        email: $request->input('email'),
        message: $request->input('message'),
        userAgent: $request->header('User-Agent')
    );

    $isNotSpam = $spamDetector->analyze($formData);

    if ($isNotSpam) {
        // Process the form submission
    } else {
        // Handle spam detection
    }
    
}

```
### 2. Facade Usage

```php

use Illuminate\Http\Request;
use Isapp\LaravelAiSpamdetector\Facades\SpamDetector;

public function index (Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'message' => 'required|string|max:255',
    ]);
    
    $formData = new \Isapp\AiSpamdetector\FormData(
        name: $request->input('name'),
        email: $request->input('email'),
        message: $request->input('message'),
        userAgent: $request->header('User-Agent')
    );

    $isNotSpam = SpamDetector::analyze($formData);

    if ($isNotSpam) {
        // Process the form submission
    } else {
        // Handle spam detection
    }
    
}

```


## Contributing

Please, submit bugs or feature requests via the [Github issues](https://github.com/isap-ou/laravel-ai-spamdetector/issues).

Pull requests are welcomed!

Thanks!

## License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

You are free to use, modify, and distribute it in your projects, as long as you comply with the terms of the license.

---

Maintained by [ISAPP](https://isapp.be) and [ISAP OÜ](https://isap.me).  
Check out our software development services at [isap.me](https://isap.me).
