<?php

namespace Isapp\LaravelAiSpamdetector;

use Isapp\AiSpamdetector\SpamDetector;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/courier.php',
            'ai-spamdetecto'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('ai-spamdetector.php'),
        ], 'ai-spamdetector-config');

        $this->app->bind(SpamDetector::class, function ($app) {
            $config = $app['config']['ai-spamdetector'];

            return new SpamDetector(
                client: new \Isapp\AiSpamdetector\Client(
                    apiKey: $config['api_key'],
                    organization: $config['organization'] ?? null,
                    project: $config['project'] ?? null,
                    baseUri: $config['base_uri'] ?? 'api.openai.com/v1',
                    model: $config['model'] ?? 'gpt-4'
                )
            );
        });
    }
}
