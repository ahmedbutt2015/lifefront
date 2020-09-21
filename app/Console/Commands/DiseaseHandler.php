<?php

namespace App\Console\Commands;

use App\Character;
use App\CharacterDisease;
use App\Children;
use App\UserActionHistory;
use Illuminate\Console\Command;

class DiseaseHandler extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disease-handler';

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
        $diseases = DB::table('diseases')->pluck('id')->toArray();
        foreach (Character::all() as $character) {
            CharacterDisease::create([
                'disease_id'   => $diseases[array_rand($diseases)],
                'character_id' => $character->id,
                'type'         => 'adult',
            ]);
            UserActionHistory::addUpdate([
                'created_by' => '', 'action_to' => $character->id, 'action' => 'You got a disease', 'status' => 'accepted'
            ]);
        }

        foreach (Children::all() as $child) {
            CharacterDisease::create([
                'disease_id'   => $diseases[array_rand($diseases)],
                'character_id' => $child->id,
                'type'         => 'children',
            ]);
            UserActionHistory::addUpdate([
                'created_by' => '', 'action_to' => $child->parent1, 'action' => 'Your child got a disease', 'status' => 'accepted'
            ]);
            UserActionHistory::addUpdate([
                'created_by' => '', 'action_to' => $child->parent2, 'action' => 'Your child got a disease', 'status' => 'accepted'
            ]);
        }

    }


}
