<?php

namespace Modules\Transaksi\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SetOptionTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:transaksi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set default value for module transaksi';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line("Start set default value for options.");

        $bar = $this->output->createProgressBar(3);

        $bar->setFormat('debug');

        $bar->start();

        option(['transaksi.status' => json_encode(['Terjual','Pending'])]);

        $bar->advance();
        usleep(300000);

        option(['transaksi.kebutuhan' => json_encode(['Jual', 'Sewa'])]);

        $bar->advance();
        usleep(300000);

        option(['transaksi.perihal_pembayaran' => json_encode(['Booking Fee','Reserved', 'NUP'])]);

        $bar->advance();
        usleep(300000);

        
        $bar->finish();

        $this->info("\nSet default value success.");
    }
}
