<?php

use Dotenv\Dotenv;
use Illuminate\Config\Repository;
use Isapp\AiSpamdetector\FormData;
use Isapp\AiSpamdetector\SpamDetector;
use Isapp\LaravelAiSpamdetector\ServiceProvider;
use Orchestra\Testbench\TestCase;
use PHPUnit\Framework\Attributes\Test;

class SpamprotectorTest extends TestCase
{
    #[Test]
    public function analyze_spam(): void
    {
        $formData = new FormData(
            message: 'Congratulations! You are selected for a limited offer!!! Click here 👉 http://bit.ly/xyz',
            email: 'freecashnow@xyz.biz',
            name: 'James Bond',
            userAgent: 'python-requests/2.31',
            ip: '123.123.123.123'
        );

        $result = app()->make(SpamDetector::class)->analyze($formData);
        $this->assertFalse($result);
    }

    #[Test]
    public function analyze_valid_message(): void
    {
        $formData = new FormData(
            message: 'Hi, I would like more information about your services.',
            email: 'johndoe@example.com',
            firstName: 'John',
            lastName: 'Doe',
            userAgent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            ip: '123.123.123.123',
        );

        $result = app()->make(SpamDetector::class)->analyze($formData);
        $this->assertTrue($result);
    }

    #[Test]
    public function analyze_empty_data(): void
    {
        $formData = new FormData(
            message: '',
            email: '',
            name: '',
            userAgent: '',
            ip: '',
        );

        $result = \Isapp\LaravelAiSpamdetector\Facades\SpamDetector::analyze($formData);
        $this->assertFalse($result);
    }

    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        if (file_exists(__DIR__.'/../../.env')) {
            $dotenv = Dotenv::createImmutable(__DIR__.'/../../');
            $dotenv->load();

            tap($app['config'], function (Repository $config) {
                $config->set('ai-spamdetector.api_key', $_ENV['OPENAI_API_KEY']);
                $config->set('ai-spamdetector.organization', $_ENV['OPENAI_ORGANIZATION']);
            });
        }
    }
}
