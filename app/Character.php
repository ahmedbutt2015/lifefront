<?php

namespace App;

use App\Http\Helpers\Crud;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Character extends Model
{

    use Crud;

    protected $guarded = [];
    protected $insert = ['first_name', 'last_name', 'language', 'prefix', 'code', 'address', 'gender', 'skin_tone', 'hair_style', 'body_type', 'age', 'status',
        'family_id', 'user_id', 'marriage_status', 'role', 'mood', 'job', 'profile', 'user_status', 'neighbourhood_id'];



    public function indications () {
        return $this->hasMany(CharacterIndication::class)
                    ->select('character_indications.*', 'indication_bars.english_name', 'indication_bars.french_name', 'indication_bars.daily_points', 'indication_bars.min', 'indication_bars.max')
                    ->join('indication_bars', 'indication_bars.id', 'character_indications.indication_id');
    }

    public function group () {
        return $this->hasOne(Group::class);
    }

    public function habitation () {
        return $this->hasOne(CharacterHabitation::class,'character_id');
    }

    // friendship that I started
    function friendsOfMine () {
        return $this->belongsToMany(Character::class, 'friends', 'character_id1', 'character_id2')
                    ->select('characters.*')
                    ->selectRaw('(SELECT job_and_diplomas_jobs.job_name FROM job_and_diplomas_jobs WHERE  job_and_diplomas_jobs.id  = characters.job ) AS job_name')
                    ->withPivot('created_at');
    }

    // friendship that I was invited to
    function friendOf () {
        return $this->belongsToMany(Character::class, 'friends', 'character_id2', 'character_id1')
                    ->select('characters.*')
                    ->selectRaw('(SELECT job_and_diplomas_jobs.job_name FROM job_and_diplomas_jobs WHERE  job_and_diplomas_jobs.id  = characters.job ) AS job_name')
                    ->withPivot(['id', 'created_at']);
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute () {
        if ( !array_key_exists('friends', $this->relations)) $this->loadFriends();
        return $this->getRelation('friends');
    }

    protected function loadFriends () {
        if ( !array_key_exists('friends', $this->relations)) {
            $friends = $this->mergeFriends();
            foreach ($friends as $friend) {
                $friend->full_name = $friend->first_name . " " . $friend->last_name;
                $friend->added_on = date('d/m/Y', strtotime($friend->pivot->created_at));
                $friend->friend_id = $friend->pivot->id;
            }
            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends () {
        return $this->friendsOfMine->merge($this->friendOf);
    }

    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function revive () {
        $this->age = 18;
        $this->status = 'live';
        $this->save();
    }

    public static function getCode ($prefix) {
        $code = self::selectRaw('MAX(code) as code')->where('prefix', $prefix)->value('code');
        return str_pad(++$code, 6, "0", STR_PAD_LEFT);
    }

    public static function getCharacter ($address) {
        $character = self::select('characters.*')
                         ->selectRaw('(SELECT ROUND(IFNULL(SUM(rating)/COUNT(rating),0)) FROM profile_ratings WHERE character_id = characters.id) as rating')
                         ->selectRaw('(SELECT job_and_diplomas_jobs.job_name FROM job_and_diplomas_jobs WHERE  job_and_diplomas_jobs.id  = characters.job ) AS job_name')
                         ->where('address', $address)
                         ->with('indications')
                         ->first();
        $character->hobbies = explode(',', $character->hobbies);
        return $character;
    }


    public static function commentsLikedBy ($id) {
        return CommentLikes::select('comment_likes.*', 'users.username AS sender_name', 'characters.prefix', 'characters.address')
                           ->selectRaw('CONCAT(characters.first_name," ",characters.last_name) as full_name')
                           ->leftJoin('comments', 'comments.id', 'comment_likes.comment_id')
                           ->leftJoin('characters', 'characters.id', 'comment_likes.liked_by')
                           ->leftJoin('users', 'users.id', 'characters.user_id')
                           ->where("comments.to", $id)
                           ->get();
    }

    public static function ratedBy ($id) {
        return ProfileRating::select('profile_ratings.*', 'users.username as sender_name', 'characters.prefix', 'characters.address')
                            ->selectRaw('CONCAT(characters.first_name," ",characters.last_name) as full_name')
                            ->leftJoin('characters', 'characters.id', 'profile_ratings.rated_by')
                            ->leftJoin('users', 'users.id', 'characters.user_id')
                            ->where("profile_ratings.character_id", $id)
                            ->get();
    }

    public static function addFriend ($friend_id) {
        $character = auth()->user()->character;
        if ($character) {
            $character_id = $character->id;
            $ids = [$friend_id, $character_id];
            $exist = Friend::whereIn('character_id1', $ids)->whereIn('character_id2', $ids)->first();
            if ( !$exist) {
                $result = Friend::create([
                    'character_id1' => $character_id,
                    'character_id2' => $friend_id,
                ]);
                if ($result) {
                    return true;
                }
            }
        }

        return false;


    }


    /*
     * Partner Relation Start
     */

    public function partnerWith () {
        return $this->belongsToMany(Character::class, 'character_relationship', 'character_id', 'partner_id')
                    ->withPivot(['id', 'created_at']);
    }

    public function partnerOf () {
        return $this->belongsToMany(Character::class, 'character_relationship', 'partner_id', 'character_id')
                    ->withPivot(['id', 'created_at']);
    }

    public function getPartnersAttribute () {
        if ( !array_key_exists('partners', $this->relations)) $this->loadPartners();
        return $this->getRelation('partners');
    }

    protected function loadPartners () {
        if ( !array_key_exists('partners', $this->relations)) {
            $partners = $this->mergePartners();
            foreach ($partners as $partner) {
                $partner->full_name = $partner->first_name . " " . $partner->last_name;
                $partner->married_since = date('d/m/Y', strtotime($partner->pivot->created_at));
                $partner->relation_id = $partner->pivot->id;
            }
            $this->setRelation('partners', $partners);
        }
    }

    protected function mergePartners () {
        return $this->partnerWith->merge($this->partnerOf);
    }


    /*
     * Partner Relation End
     */

    public static function addPartner ($id) {
        $character = auth()->user()->character;
        
        if ($character) {
            $character_id = $character->id;
            $exist = Partner::where('character_id', $character_id)->orwhere('partner_id', $character_id)->first();
            if ( !$exist) {
                $result = Partner::create([
                    'character_id' => $character_id,
                    'partner_id'   => $id,
                ]);
                if ($result) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function getCharacterByUserId ($id=0) {
        if ($id==0) {
            $id = auth()->id();
        }
        $character = self::where('user_id', $id)
                         ->first();
        $ch_id = $character->id;
        $partners = $character->partners;
        $character = $character->toArray();
        if ($partners->count()) {
            $character['partners'] = $partners;
        } else {
            $character['partners'] = false;
        }
        $character['children_list'] = Children::where('parent1', $ch_id)->orWhere('parent2', $ch_id)->with('indications')->get();

        return $character;
    }

    public static function getMarriageable () {
        return self::select('id as value')->selectRaw('CONCAT(first_name," ", last_name) as text')->where('user_id', '!=', auth()->id())
                   ->get();
    }

    public static function getOnline ($id) {
        $all = Character::select('characters.*', 'job_and_diplomas_jobs.job_name')
                        ->where('neighbourhood_id', $id)
                        ->leftJoin('job_and_diplomas_jobs', 'job_and_diplomas_jobs.id', 'characters.job')
                        ->get();
        $online = [];
        foreach ($all as $ch) {
//            if (Cache::has($ch->user_id) and $ch->user_id != auth()->id()) {
            if (Cache::has($ch->user_id)) {
                $online[] = $ch;
            }
        }
        return $online;
    }

    public static function getForMessage () {
        return self::select('id as value')
                   ->selectRaw('CONCAT(first_name," ", last_name) as text')
                   ->where('user_id', '!=', auth()->id())
                   ->get();
    }


    public function AddIndications () {
        $all = \DB::table('indication_bars')->where('apply_to', 'adults')->get();
        $insert = [];
        foreach ($all as $row) {
            $insert[] = [
                'character_id'  => $this->id,
                'indication_id' => $row->id,
                'points'        => $row->points,
            ];
        }
        \DB::table('character_indications')->insert($insert);
    }

    public static function createCharacter ($input, $user = false) {
        $setting = DB::table('settings')->latest()->first();
        $prefix = $input['city'];
        $language = $prefix == 'en' ? 'english' : 'french';
        $code = Character::getCode($prefix);
        $create = [
            'first_name'       => $input['first_name'] ?? '',
            'last_name'        => $input['last_name'] ?? '',
            'language'         => $language,
            'prefix'           => $prefix,
            'code'             => $code,
            'address'          => $prefix . $code,
            'gender'           => $input['gender'],
            'skin_tone'        => $input['skin'],
            'hair_style'       => $input['hair'],
            'body_type'        => $input['body'],
            'age'              => isset($input['age']) ? $input['age'] : 18,
            'neighbourhood_id' => $setting->default_neighbourhood,
            'cash'             => $setting->starting_cash,
            'status'           => 'live',
            'family_id'        => 0,
        ];
        if ($user) {
            $ch = $user->character()->create($create);
            $ch->AddIndications();
            $ch->addHabitation();

        } else {
            $create['user_id'] = 0;
            $ch = self::create($create);
            $ch->AddIndications();
            $ch->addHabitation();
        }

        return $ch;
    }

    public function addHabitation () {
        $h_id = DB::table('character_habitations')->insertGetId([
            'character_id'     => $this->id,
            'neighbourhood_id' => $this->neighbourhood_id,
        ]);

        $all = DB::table('indication_bars')->where('apply_to', 'habitation')->get();
        $insert = [];
        if ($all) {
            foreach ($all as $row) {
                $insert[] = [
                    'habitation_id' => $h_id,
                    'indication_id' => $row->id,
                    'points'        => $row->points,
                ];
            }
        }
        if (count($insert))
            DB::table('habitation_indications')->insert($insert);
    }


}
