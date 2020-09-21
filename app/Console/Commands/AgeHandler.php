<?php

namespace App\Console\Commands;

use App\Character;
use App\Children;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AgeHandler extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'age-handle';

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
        //
        $characters = \App\Character::where('status', 'live')->get();
        $setting = \Illuminate\Support\Facades\DB::table('settings')->where('id', 1)->first();
        $timeForYear = $setting->no_of_days_for_one_year;
        foreach ($characters as $character) {
            $days = $character->created_at->diffInDays(Carbon::now());
            $character->age = floor($days / $timeForYear) + 18;
            $character->save();
        }
        foreach (Children::all() as $child) {
            $days = $child->created_at->diffInDays(Carbon::now());
            $age = floor($days / $timeForYear) > 0 ? floor($days / $timeForYear) - 1 : 0;
            if ($age >= 16) {
                $parent = $child->parent;
                Character::createCharacter([
                    'city'       => $parent->prefix,
                    'first_name' => $child->first_name,
                    'last_name'  => $child->last_name,
                    'gender'     => $child->gender,
                    'skin'       => '',
                    'hair'       => '',
                    'body'       => '',
                    'age'        => 18,
                ]);
                $child->delete();
            } else {
                $child->age = $age;
                $child->save();
            }
        }
        print "done";
    }


}
