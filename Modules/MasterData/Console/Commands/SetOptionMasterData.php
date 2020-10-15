<?php

namespace Modules\MasterData\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SetOptionMasterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:masterdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set default value for module master data';


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

        $bar = $this->output->createProgressBar(11);

        $bar->setFormat('debug');

        $bar->start();

        option(['masterdata.jenis_bank' => json_encode(['Konvensional','Syariah'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.status' => json_encode(['Publish','Unpublish'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.status_unit' => json_encode(['Jual', 'Sewa', 'Dijual/Disewa'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.jenis_pembayaran' => json_encode(['Installment', 'KPR/KPA', 'Hardcash'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.status_unit_secondary' => json_encode(['Beli','Sewa','Beli/sewa'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.kondisi_bangunan' => json_encode(['Standard','Renovasi'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.sertifikat' => json_encode(['HGB','SHM','Strata','Lainya'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.bersedia_dipasang' => json_encode(['Spanduk','Iklan','Papan Tanda','Lainya','Tidak'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.approved_status' => json_encode(['Disetujui','Pending'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.menu' => json_encode(['Untuk Pelanggan', 'Untuk Agen Properti', 'Untuk Pemilik Properti'])]);

        $bar->advance();
        usleep(300000);

        option(['masterdata.open_house' => json_encode(['Ya', 'Tidak'])]);

        $bar->advance();
        usleep(300000);

        
        $bar->finish();

        $this->info("\nSet default value success.");
    }
}
