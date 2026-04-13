<?php

namespace Biplove\OopsUi\Tests\Feature;

use Biplove\OopsUi\Console\InstallCommand;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;

class InstallCommandTest extends TestCase
{
    /** @test */
    public function it_publishes_configuration_file()
    {
        $exitCode = Artisan::call('oops:install');

        $this->assertEquals(0, $exitCode);
        $this->assertStringContainsString('published successfully', Artisan::output());
    }

    /** @test */
    public function it_displays_success_message()
    {
        Artisan::call('oops:install');

        $output = Artisan::output();
        $this->assertStringContainsString('Oops UI configuration published successfully', $output);
        $this->assertStringContainsString('Next steps', $output);
    }

    protected function getPackageProviders($app)
    {
        return [\Biplove\OopsUi\OopsUiServiceProvider::class];
    }
}
