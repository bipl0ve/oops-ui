<?php

namespace Biplove\OopsUi\Tests\Unit;

use Biplove\OopsUi\ConfigurationResolver;
use Illuminate\Config\Repository;
use PHPUnit\Framework\TestCase;

class ConfigurationResolverTest extends TestCase
{
    private ConfigurationResolver $resolver;
    private Repository $config;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->config = new Repository([
            'oops-ui' => [
                'errors' => [
                    '404' => [
                        'title' => 'Page Not Found',
                        'message' => 'The page does not exist.',
                    ],
                    '4xx' => [
                        'title' => 'Client Error',
                        'message' => 'There was a problem with your request.',
                    ],
                    '5xx' => [
                        'title' => 'Server Error',
                        'message' => 'An unexpected error occurred.',
                    ],
                ],
            ],
        ]);
        
        $this->resolver = new ConfigurationResolver($this->config);
    }

    /** @test */
    public function it_resolves_specific_error_code_configuration()
    {
        $result = $this->resolver->resolve(404);
        
        $this->assertEquals('Page Not Found', $result['title']);
        $this->assertEquals('The page does not exist.', $result['message']);
    }

    /** @test */
    public function it_falls_back_to_range_configuration()
    {
        $result = $this->resolver->resolve(405);
        
        $this->assertEquals('Client Error', $result['title']);
        $this->assertEquals('There was a problem with your request.', $result['message']);
    }

    /** @test */
    public function it_falls_back_to_generic_configuration()
    {
        $result = $this->resolver->resolve(999);
        
        $this->assertEquals('Error Occurred', $result['title']);
        $this->assertEquals('An unexpected error occurred.', $result['message']);
        $this->assertArrayHasKey('buttons', $result);
    }

    /** @test */
    public function it_resolves_translation_keys()
    {
        $this->config->set('oops-ui.errors.500', [
            'title' => 'errors.500.title',
            'message' => 'errors.500.message',
        ]);
        
        $result = $this->resolver->resolve(500);
        
        // trans() returns the key itself if translation doesn't exist
        $this->assertEquals('errors.500.title', $result['title']);
        $this->assertEquals('errors.500.message', $result['message']);
    }

    /** @test */
    public function it_merges_partial_configuration()
    {
        $this->config->set('oops-ui.errors.403', [
            'title' => 'Forbidden',
        ]);
        
        $result = $this->resolver->resolve(403);
        
        $this->assertEquals('Forbidden', $result['title']);
        $this->assertArrayNotHasKey('message', $result);
    }
}
