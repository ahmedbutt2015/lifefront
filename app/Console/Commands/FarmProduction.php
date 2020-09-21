<?php

namespace App\Console\Commands;

use App\FarmProduct;
use Illuminate\Console\Command;

class FarmProduction extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm-production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct () {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle () {
        $productions = FarmProduct::InProcess();
        $ids = $productions->where('complete_in', 0)->pluck('id');
        FarmProduct::whereIn('id', $ids)->update(['in_production' => false]);
    }


}
