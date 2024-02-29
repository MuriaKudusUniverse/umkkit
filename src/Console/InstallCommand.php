<?php

namespace Umkdev\Umkkit\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'umkkit:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instal UMK Kit';

    /**
     * Execute the console command.
     *
     * @return int
     */

    var $package_path = __DIR__ . '/../';
    // var $package_path = __DIR__.'/../../../packages/Umkdev/umkkit/src/';

    public function handle()
    {

        // $this->info($this->package_path);


        $choice = $this->choice('Pilih template yang anda gunakan:', ['qompactui', 'sneat']);

        if ($choice === 'qompactui') {
            $this->warn("Anda Memilih Template : Qompact UI");
        } else if ($choice === 'sneat') {
            $this->warn("Anda Memilih Template : Sneat");
        }
        $this->warn("Proses Instalasi Template....");
        $this->installTemplate($choice);
        $this->installApp();
        $this->installDatabase();
        $this->installRoute();

        $this->line('----------- Made By LSI -----------');
        $this->info('Template berhasil di install');
    }

    private function installTemplate($template = 'qompactui')
    {
        (new Filesystem)->ensureDirectoryExists(resource_path('views'));
        (new Filesystem)->ensureDirectoryExists(public_path(''));

        (new Filesystem)->copyDirectory($this->package_path . 'Templates/' . $template . '/assets/', public_path('assets'));
        (new Filesystem)->copyDirectory($this->package_path . 'Templates/' . $template . '/views/', resource_path('views'));
    }
    private function installApp()
    {
        $source_path = $this->package_path . 'App/';
        (new Filesystem)->ensureDirectoryExists(app_path('Http'));
        (new Filesystem)->ensureDirectoryExists(app_path('Models'));

        (new Filesystem)->copyDirectory($source_path . 'Http/', app_path('Http'));
        (new Filesystem)->copyDirectory($source_path . 'Models/', app_path('Models'));
        (new Filesystem)->copyDirectory($source_path . 'Services/', app_path('Services'));
    }
    private function installRoute()
    {
        (new Filesystem)->ensureDirectoryExists(base_path('routes'));
        (new Filesystem)->copy($this->package_path . 'Routes/web.php', base_path('routes/web.php'));
    }
    private function installDatabase()
    {
        (new Filesystem)->ensureDirectoryExists(base_path('database'));
        (new Filesystem)->copyDirectory($this->package_path . 'Database/', base_path('database'));
    }
}
