<?php
namespace Biplove\OopsUi\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'oops:install';
    protected $description = 'Publish Oops UI configuration file';

    public function handle()
    {
        $this->info('Publishing Oops UI configuration...');

        $this->call('vendor:publish', [
            '--tag' => 'oops-ui-config'
        ]);

        $this->newLine();
        $this->info('✓ Oops UI configuration published successfully!');
        $this->newLine();
        $this->line('Next steps:');
        $this->line('  1. Edit config/oops-ui.php to customize your error pages');
        $this->line('  2. Error pages will work automatically - no additional setup needed!');
        $this->newLine();

        return Command::SUCCESS;
    }
}