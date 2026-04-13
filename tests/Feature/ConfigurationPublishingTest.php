<?php

namespace Biplove\OopsUi\Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class ConfigurationPublishingTest extends TestCase
{
    /** @test */
    public function it_publishes_configuration_with_vendor_publish()
    {
        $exitCode = Artisan::call('vendor:publish', [
            '--tag' => 'oops-ui-config',
            '--force' => true,
        ]);

        $this->assertEquals(0, $exitCode);
    }

    /** @test */
    public function it_merges_published_config_with_defaults()
    {
        // Default configuration should be available
        $this->assertNotNull(config('oops-ui.show_debug'));
        $this->assertIsArray(config('oops-ui.settings'));
        $this->assertIsArray(config('oops-ui.errors'));
    }

    /** @test */
    public function it_installs_via_oops_install_command()
    {
        $exitCode = Artisan::call('oops:install');

        $this->assertEquals(0, $exitCode);
        $output = Artisan::output();
        $this->assertStringContainsString('published successfully', $output);
    }

    protected function getPackageProviders($app)
    {
        return [\Biplove\OopsUi\OopsUiServiceProvider::class];
    }
}
