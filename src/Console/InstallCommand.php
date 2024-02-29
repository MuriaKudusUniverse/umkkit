<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use RuntimeException;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\select;

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
    public function handle()
    {

        $choice = $this->choice('Pilih template yang anda gunakan:',['qompactui','sneat']);

        if($choice === 'qompactui'){
            $this->info("QOMPACT UI");
        } else if($choice === 'sneat'){
            $this->info("SNEAT");
        }

    }
}
