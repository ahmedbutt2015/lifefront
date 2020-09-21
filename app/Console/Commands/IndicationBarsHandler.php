<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class IndicationBarsHandler extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indication-bar-handle';

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
        $characters = \App\Character::where('status', 'live')->with('indications')->get();
        foreach ($characters as $character) {
            foreach ($character->indications as $indication) {
                $indication->points += $indication->daily_points;
                $indication->points = $indication->points > $indication->max ?  $indication->max :  $indication->points;
                $indication->points = $indication->points < $indication->min ?  $indication->min :  $indication->points;
                $indication->save();
            }
        }

        print "done";
    }


}
