<?php

namespace Modules\ManageUser\Console\Commands;

use Illuminate\Console\Command;

class SetOptionManageUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:manage_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set default value for module manage user';


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

        option(['tipe_agent' => json_encode(['Independen','Agent Property'])]);

        $bar->advance();
        usleep(300000);

        option(['jenis_kelamin' => json_encode(['Laki-laki','Perempuan'])]);

        $bar->advance();
        usleep(300000);

        option(['status_sales' => json_encode(['Pending', 'Verifikasi Ulang', 'Sudah Diverifikasi'])]);

        $bar->advance();
        usleep(300000);

        
        $bar->finish();

        $this->info("\nSet default value success.");
    }
}
