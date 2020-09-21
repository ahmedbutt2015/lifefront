<?php

namespace App\Http\Controllers;

use App\Action;
use App\CharacterHabitation;

use App\Article;
use App\Character;
use App\CharacterDisease;
use App\CharacterIndication;
use App\Chat;
use App\Children;
use App\ChildrenIndication;
use App\CoachEquipment;
use App\CoachService;
use App\CoachSubscription;
use App\Comment;
use App\Company;
use App\CompanyEmployee;
use App\DeliveryCharges;
use App\DiagnoseRequest;
use App\DustManagerStock;
use App\DustManStock;
use App\DustManStockRequest;
use App\FarmAnimal;
use App\FarmerOrders;
use App\FarmProduct;
use App\FinanceReport;
use App\Friend;
use App\Group;
use App\HabitationIndication;
use App\IndicationBar;
use App\Intimate;
use App\Job;
use App\JobApplication;
use App\JobOffer;
use App\Neighbourhood;
use App\Notification;
use App\PharmacistStock;
use App\PostObject;
use App\PractitionerEquipment;
use App\PreObject;
use App\ProfileRating;
use App\RestaurantIngredientsStock;
use App\RestaurantPlates;
use App\ShopKeeperStock;
use App\ShopKeeperStockRequest;
use App\ShopManagerStock;
use App\TrashCleanRequests;
use App\User;
use App\UserActionHistory;
use App\ShopkeeperAvailableStock;
use App\GiftNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\PhoneSellerRequest;
use App\PhoneMangerStock;
use App\FactoryProduct;
use App\FactoryAnimal;
use App\FactoryOrders;
use App\CreditSubscription; 
use App\ItemPocket;
use App\BuySubscriptionPlan;
use App\PhoneKeeperStock;

class AjaxController extends Controller
{

    public function __construct () {
        $this->middleware('auth')->except('getRecaptchaKey');
    }

    private function UploadFile ($field_name, $storagePath) {
        $imageName = time() . '.' . request()->{$field_name}->getClientOriginalExtension();
        request()->{$field_name}->move(public_path($storagePath), $imageName);
        return url($storagePath . '/' . $imageName);
    }

    public function index ($method) {

        $data = $this->{$method}();
        return response()->json($data);
    }

    public function getRecaptchaKey () {
        return config('services.recaptcha.key');
    }

    public function getRules () {
        return [
            ['rule' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna lorem, ultrices in auctor a, ullamcorper at nisi. In aliquet, risus quis aliquet dapibus, nisl erat interdum enim, id vehicula nunc felis ut sem. Phasellus at vestibulum magna. Mauris ornare ut massa quis gravida. Fusce at orci et tortor pharetra vulputate in at lacus. Proin lacinia lacus id commodo lacinia. Aliquam et quam laoreet, scelerisque quam varius, pellentesque purus."],
            ['rule' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna lorem, ultrices in auctor a, ullamcorper at nisi. In aliquet, risus quis aliquet dapibus, nisl erat interdum enim, id vehicula nunc felis ut sem. Phasellus at vestibulum magna. Mauris ornare ut massa quis gravida. Fusce at orci et tortor pharetra vulputate in at lacus. Proin lacinia lacus id commodo lacinia. Aliquam et quam laoreet, scelerisque quam varius, pellentesque purus."],
            ['rule' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna lorem, ultrices in auctor a, ullamcorper at nisi. In aliquet, risus quis aliquet dapibus, nisl erat interdum enim, id vehicula nunc felis ut sem. Phasellus at vestibulum magna. Mauris ornare ut massa quis gravida. Fusce at orci et tortor pharetra vulputate in at lacus. Proin lacinia lacus id commodo lacinia. Aliquam et quam laoreet, scelerisque quam varius, pellentesque purus."],
            ['rule' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna lorem, ultrices in auctor a, ullamcorper at nisi. In aliquet, risus quis aliquet dapibus, nisl erat interdum enim, id vehicula nunc felis ut sem. Phasellus at vestibulum magna. Mauris ornare ut massa quis gravida. Fusce at orci et tortor pharetra vulputate in at lacus. Proin lacinia lacus id commodo lacinia. Aliquam et quam laoreet, scelerisque quam varius, pellentesque purus."],
            ['rule' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna lorem, ultrices in auctor a, ullamcorper at nisi. In aliquet, risus quis aliquet dapibus, nisl erat interdum enim, id vehicula nunc felis ut sem. Phasellus at vestibulum magna. Mauris ornare ut massa quis gravida. Fusce at orci et tortor pharetra vulputate in at lacus. Proin lacinia lacus id commodo lacinia. Aliquam et quam laoreet, scelerisque quam varius, pellentesque purus."],
            ['rule' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna lorem, ultrices in auctor a, ullamcorper at nisi. In aliquet, risus quis aliquet dapibus, nisl erat interdum enim, id vehicula nunc felis ut sem. Phasellus at vestibulum magna. Mauris ornare ut massa quis gravida. Fusce at orci et tortor pharetra vulputate in at lacus. Proin lacinia lacus id commodo lacinia. Aliquam et quam laoreet, scelerisque quam varius, pellentesque purus."],
            ['rule' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna lorem, ultrices in auctor a, ullamcorper at nisi. In aliquet, risus quis aliquet dapibus, nisl erat interdum enim, id vehicula nunc felis ut sem. Phasellus at vestibulum magna. Mauris ornare ut massa quis gravida. Fusce at orci et tortor pharetra vulputate in at lacus. Proin lacinia lacus id commodo lacinia. Aliquam et quam laoreet, scelerisque quam varius, pellentesque purus."],
        ];
    }

    public function getCities () {
        return DB::table('cities')->get();
    }

    public function acceptRules () {

        $date = now()->toDateTimeString();
        User::where('id', auth()->id())->update([
            'rules_accepted_at' => $date,
        ]);
        return $date;
    }

    public function buyDiamonds () {
        $user = auth()->user();
        $user->diamonds += 100;
        $user->save();
        return User::getUser($user->id);
    }

    public function updatePassword () {
        if (auth()->attempt([
            'email'    => request()->get('email'),
            'password' => request()->get('old'),
        ])) {

            if (request()->get('new') == request()->get('confirm')) {
                User::where('email', request()->get('email'))->update([
                    'password' => bcrypt(request()->get('new')),
                ]);

                return ['status' => true, 'msg' => 'Password updated successfully'];

            }

            return ['msg' => 'Confirm Password Didn\'t match'];

        }
        return ['msg' => 'Invalid Credentials'];

    }

    public function removeProfile () {
        $path = auth()->user()->pic;
        auth()->user()->pic = '';
        auth()->user()->save();

        if (file_exists($path)) {
            unlink($path);
        }
        return ['msg' => 'Profile Picture removed successfully'];
    }

    public function updateProfile () {
        $username = request()->get('username');
        $email = request()->get('email');
        $user = auth()->user();

        if ($username != $user->username) {
            request()->validate([
                'username' => 'required|unique:users',
            ], [
                'username.required' => "User Name cannot be null.",
                'username.unique'   => "User Name already taken try some other.",
            ]);
            $user->username = $username;
        }


        if ($email != $user->email) {
            request()->validate([
                'email' => 'required|email|unique:users',
            ]);
            $user->email = $email;
        }

        if (request()->hasFile('image')) {
            if (file_exists($user->pic)) {
                unlink($user->pic);
            }
            $user->pic = $this->uploadImage('image');
        }


        $user->save();

        return ['user' => $user, 'msg' => 'Your Profile updated successfully'];
    }

    public function getCharacterSettings () {
    //     $c= DB::table('cities')->leftJoin('languages', 'languages.id', 'cities.language_id')->select('cities.title', 'cities.slug as slug', 'languages.language_name')->get();
    //    dd($c);
        return [
            'characters' => Character::where('user_id', 0)->get(),
            'cities'     => DB::table('cities')->select('cities.title', 'cities.slug as slug', 'languages.language_name')->leftJoin('languages', 'languages.id', 'cities.language_id')->get()
            ,
            'hair'       => [
                [
                    'color' => "Brown",
                    'value' => "brown"
                ], [
                    'color' => "Black",
                    'value' => "black"
                ]
            ],
            'skins'      => [

                [
                    'color' => "Light",
                    'value' => "light"
                ], [
                    'color' => "Dark",
                    'value' => "dark"
                ]
            ],
            'bodies'     => [
                [
                    'name'  => 'Fat',
                    'value' => 'fat',
                ], [
                    'name'  => 'Medium',
                    'value' => 'medium',
                ], [
                    'name'  => 'Strong',
                    'value' => 'strong',
                ]
            ],
            'genders'    => [
                ['slug' => 'male', 'title' => 'Male'],
                ['slug' => 'female', 'title' => 'Female'],
            ]
        ];
    }

    public function saveCharacter () {
        $user = User::getUser();
        $input = request()->get('data');
        $ch_id = $input['character_id'];
        if ($ch_id > 0) {
            Character::addUpdate([
//                'gender'     => $input['gender'],
                'skin_tone'  => $input['skin'],
                'hair_style' => $input['hair'],
                'body_type'  => $input['body'],
                'user_id'    => auth()->id(),
            ], $ch_id);
            $ch = Character::find($ch_id);
        } else {
            $ch = Character::createCharacter($input, $user);
        }
        return ['status' => 'ok', 'link' => "city/$ch->prefix/$ch->address", 'msg' => 'Saved'];
    }

    public function getUser () {
        return User::getUser(auth()->id());
    }

    public function deleteCharacter () {
        $user = auth()->user();

        $user->character->delete();

        return true;
    }

    public function reviveCharacter () {
        $user = auth()->user();
        //todo minus diamond etc
        $user->character->revive();

        return User::getUser();
    }

    public function getNotifications () {
        return Notification::notRead();
    }

    public function markNotificationRead () {
        $id = request('id');
        if ($id) {
            Notification::addUpdate(['read' => 1], $id);
        }
        return $this->getNotifications();
    }

    public function getCharacterProfile () {
        
        $address = request('address');
        $data['user'] = $this->getUser();
        $data['gender_dropdown'] = DB::table("sexual_orientations")->get();
        $data['family_situation_dropdown'] = DB::table("family_situations")->get();
        $data['mood_dropdown'] = DB::table("moods")->get();
        $data['role_dropdown'] = ['yes', 'no'];//todo get from admin
//        $data['hobbies_dropdown'] = DB::table("hobbies")->get();
        $data['hobbies_dropdown'] = [];
        $data['job_dropdown'] = Job::all();

        $character = Character::getCharacter($address);
        $d = ItemPocket::where('character_id',$character->id)->latest('created_at')->first();
        if($d ==null){
            $d=0;
            $data['credit_quantiy']=$d;
        }
        else{
            $data['credit_quantiy']=$d;
        }
        $data['character'] = $character;
        $data['visitor'] = Character::getCharacterByUserId();
        $data['diseases'] = CharacterDisease::getCharacterDiseases($character->id);
        $data['children_diseases'] = CharacterDisease::getChildrenDiseases($character->id);
        $data['comments'] = Comment::getCharacterComments($character->id);
        $data['friends'] = $character->friends;
        $data['likedBy'] = Character::commentsLikedBy($character->id);
        $data['ratedBy'] = Character::ratedBy($character->id);
        
        return $data;
    }

    public function updateCharacterProfile () {
        $character = request()->all();
        Character::addUpdate($character, $character['id']);
        return ['msg' => 'saved successfully', 'user' => User::getUser()];
    }

    public function updateCharacterHobbies () {
        $data = request()->all();
        $hobbies = implode(',', $data['hobbies']);
        Character::where('id', $data['id'])->update(['hobbies' => $hobbies]);
        return ['msg' => 'saved successfully'];
    }

    public function notificationCharacter () {
        $ch_id = request('ch_id');
        $value = request('value');
        $column = request('column');
        return Character::where('id', $ch_id)->update([$column => $value]);
    }

    public function saveComment () {
        $data = request()->all();
        $data['from'] = auth()->user()->character->id;
        $ok = Comment::addUpdate($data);
        if ($ok) {
            return ['msg' => 'saved successfully'];
        }
        return ['msg' => 'not saved, try later'];
    }

    public function allowComment () {
        $id = request('id');
        $ok = Comment::addUpdate(['allow' => 1], $id);
        if ($ok) {
            return ['msg' => 'allowed successfully'];
        }
        return ['msg' => 'not allowed, try later'];
    }

    public function deleteComment () {
        $id = request('id');
        $ok = Comment::where('id', $id)->delete();
        if ($ok) {
            return ['msg' => 'deleted successfully'];
        }
        return ['msg' => 'not deleted, try later'];
    }

    public function likeComment () {
        $id = request('id');
        $ok = Comment::addLike($id);
        if ($ok) {
            return ['status' => 'ok'];
        } else {
            return ['status' => 'error', 'msg' => 'you have already liked this comment'];
        }
    }

    public function addFriend () {
        $id = request('id');
        $ok = Character::addFriend($id);
        if ($ok) {
            $ch = Character::find($id);
            return ['status' => 'ok', 'friends' => $ch->friends];
        } else {
            return ['status' => 'error', 'msg' => 'You already have this character in your friend list'];
        }
    }

    public function deleteFriend () {
        $id = request('id');
        Friend::where('id', $id)->delete();

        return ['msg' => 'Friend removed successfully'];

    }

    public function addRating () {
        $id = request('id');
        $rating = request('rating');
        $ok = ProfileRating::addRating($id, $rating);
        if ($ok) {
            return ['status' => 'ok', 'rating' => $ok];
        } else {
            return ['status' => 'error', 'msg' => 'you have already have rated this profile'];
        }
    }

    public function getActionHistory () {
        return UserActionHistory::getUserHistory();
    }
    public function getMyGift () {
        return GiftNotification::myGift();
    }

    public function getFamilyDetails () {
        $character = Character::getCharacterByUserId(auth()->id());
        $intimates = Intimate::getUserRequests();

        return compact('character', 'intimates');
    }

    public function getMarriageableCharacters () {
        return Character::getMarriageable();
    }

    public function addMarriageRequest () {
        $id = request('id');
        $exist = UserActionHistory::existPendingMarriageRequest($id);
        if ($exist) {
            return ['status' => 'error', 'msg' => 'Already have a pending request for this character'];
        }
        $result = UserActionHistory::addMarriageRequest($id);
        if ($result) {
            return ['status' => 'ok', 'msg' => 'Request Saved successfully'];
        } else {
            return ['status' => 'error', 'msg' => 'Request Not Saved'];
        }
    }

    public function marriageAction () {
        $do = request('do');
        $action_id = request('id');
        $partner_id = request('created_by');
        

        if ($do == 'accept') {
            $result = Character::addPartner($partner_id);
            if ($result) {
                UserActionHistory::addUpdate(['status' => 'accepted'], $action_id);
                return ['msg' => 'Accepted successfully and Partner added successfully', 'status' => 'accepted'];
            }
            return ['msg' => 'Cant Accept this request', 'status' => 'pending'];
        } else {
            UserActionHistory::addUpdate(['status' => 'rejected'], $action_id);
            return ['msg' => 'Rejected successfully', 'status' => 'rejected'];
        }
    }

    public function addIntimateRequest () {
        $input = request()->all();

        Intimate::create([
            'requested_to'   => $input['partner_id'],
            'requested_by'   => $input['id'],
            'use_protection' => isset($input['with']) ? $input['with'] : 0,
            'quantity'       => $input['qty'],
        ]);
        return Intimate::getUserRequests();
    }

    public function getIntimateRequests () {
        return Intimate::getUserRequests();
    }

    public function intimateAction () {
        $do = request('do');
        $id = request('id');
        $intimate = Intimate::findorfail($id);
        if ($do == 'accept') {
            //todo add child with probability
            Intimate::addUpdate(['status' => 'accepted'], $id);

            $id = auth()->user()->character->id;
            $total = Intimate::where('requested_to', $id)
                             ->orWhere('requested_by', $id)->get();
            $tota_qty = $total->sum('quantity');
            $total_without = $total->where('use_protection', 0)->sum('quantity');
            $probility = ($total_without / $tota_qty) * 100;
            $setting = DB::table('settings')->where('id', 1)->first();
            $timeForYear = $setting->probility_for_baby_without_baby;
            if ($probility >= $timeForYear) {

                $genders = ['male', 'female'];
                $child = Children::addUpdate([
                    'first_name' => '',
                    'last_name'  => '',
                    'age'        => '0',
                    'gender'     => $genders[array_rand($genders)],
                    'parent1'    => $intimate->requested_by,
                    'parent2'    => $intimate->requested_to,
                ]);
                $child->addIndications();
            }
            return ['msg' => 'Accepted successfully ', 'status' => 'accepted'];
        } else {
            Intimate::addUpdate(['status' => 'rejected'], $id);
            return ['msg' => 'Rejected successfully', 'status' => 'rejected'];
        }
    }

    public function saveChildName () {
        $data = request()->only('first_name', 'last_name');
        $id = request('id');

        Children::addUpdate($data, $id);
        return "updated";
    }

    public function getEmploymentCenterDetails () {

        $jobList = Job::select('job_name as text', 'id as value')->where('job_type', 'Corporate')->get();
        return [
            'jobs'   => $jobList,
            'offers' => JobOffer::getOpenJobs(),
        ];

    }

    public function applyForJob () {
        $offer_id = request('offer_id');
        $offer = JobOffer::find($offer_id);
        $ch_id = auth()->user()->character->id;
        $exist = JobApplication::where('offer_id', $offer_id)->where('applied_by', $ch_id)->first();
        if ( !$exist) {
            JobApplication::create([
                'offer_id'   => $offer_id,
                'applied_by' => $ch_id,
                'job_id'     => $offer->job_id,
                'status'     => 'applied',
            ]);
            return true;
        }
        return false;
    }

    public function getJobs () {
        if (request()->has('type')) {
            return Job::where('job_type', request('type'))->get();
        }
        return Job::all();
    }

    public function getCharactersByJob () {
        return Character::select('id as value')->selectRaw('concat(first_name," ", last_name) as text')->where('job', request('id'))->get();
    }

    public function getAdvertiserJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $jobs = Job::all();
//        $slug = $jobs->where('id', $id)->first()->slug;
        $advertisers = Character::where('job', $id)->get();
        $is_doer = $advertisers->where('id', $ch_id) ? true : false;

        return [
            'jobs'          => $jobs,
            'advertisers'   => $advertisers,
            'neighborhoods' => DB::table('neighbourhoods')->get(),
            'is_doer'       => $is_doer
        ];
    }

    public function getFarmerJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $farmer = Character::where('job', $id)->where('id', $ch_id)->first();
        $is_doer = $farmer ? true : false;
        $animals = PreObject::getObjects($id);
        $products = PostObject::getAll('produced_by', $id);
        $stock = FarmProduct::stock($ch_id);
//        dd($stock->toArray());
        $inProduction = FarmProduct::InProcess($ch_id);
        return [
            'job'                => $job,
            'is_doer'            => $is_doer,
            'animals'            => $animals,
            'products'           => $products,
            'farmer_animals'     => FarmAnimal::getAll($ch_id),
            'farmer'             => $farmer,
            'current_production' => $inProduction,
            'finance_report'     => FinanceReport::getReportData($ch_id),
            'stock'              => $stock,
            'delivery_companies' => Character::selectRaw('CONCAT(first_name," ",last_name) as text')
                                             ->selectRaw('CONCAT(characters.id ,"-", IFNULL((SELECT price FROM delivery_charges WHERE character_id = characters.id LIMIT 1),0) ) as value')
                                             ->whereRaw("job = (SELECT id FROM job_and_diplomas_jobs WHERE job_name like '%delivery%' LIMIT 1)")
                                             ->get(),
        ];
    }

    public function getFarmerJobDetailsForVisitor () {
        $id = request('job_id');
        $farmer_id = request('farmer');
        $job = Job::find($id);
        $farmer = Character::where('id', $farmer_id)->first();

        return [
            'job'            => $job,
            'farmer'         => $farmer,
            'farmer_animals' => FarmAnimal::getAll($farmer_id),
        ];
    }

    public function buyAnimal () {

        $object = PreObject::find(request('id'));
        $character = Character::find(request('farmer'));
        $total = $object->price * request('qty');

        if ($character->cash >= $total) {
            DB::table('farm_animals')->insert([
                'farmer_id' => request('farmer'),
                'animal_id' => request('id'),
                'quantity'  => request('qty'),
            ]);
            FinanceReport::addUpdate([
                'character_id' => request('farmer'),
                'job_id'       => $character->job,
                'client_id'    => 0,
                'revenue'      => 0,
                'expense'      => $total,
            ]);
            $character->cash -= $total;
            $character->save();
            $msg = 'Brought successfully';
        } else {
            $msg = "You dont have enough money of buy";
        }

        return [
            'farmer_animals' => FarmAnimal::getAll(request('farmer')),
            'msg'            => $msg
        ];
    }

    public function startProduction () {
        $input = request()->all();
        $product = PostObject::findOne($input['product'], request('farmer'));
        $possible = $product->quantity * $product->stock;
        if ($possible >= $input['quantity']) {
            FarmProduct::create([
                'farmer_id'  => $input['farmer'],
                'product_id' => $input['product'],
                'quantity'   => $input['quantity'],
            ]);
            $unit = $product->quantity;
            $qty = $input['quantity'] / $unit;
            DB::table('farm_animals')->insert([
                'farmer_id' => $input['farmer'],
                'animal_id' => $product->animal,
                'quantity'  => -$qty,
            ]);
            $msg = 'Production Started successfully';
        } else {
            $msg = 'Not enough components';
        }

        $inProduction = FarmProduct::InProcess($input['farmer']);

        return [
            'msg'                => $msg,
            'current_production' => $inProduction,
            'farmer_animals'     => FarmAnimal::getAll(request('farmer')),
        ];
    }

    public function completeProduction () {
        $row = FarmProduct::find(request('stock_id'));
        $row->in_production = 0;
        $row->save();
        $ch_id = $row->farmer_id;
        $inProduction = FarmProduct::InProcess($ch_id);
        $stock = FarmProduct::stock($ch_id);
        return [
            'current_production' => $inProduction,
            'stock'              => $stock,
        ];
    }

    public function getCityDetails () {
        $id = request('id');
        
        return [
            'online'         => Character::getOnline($id),
            'city'           => Neighbourhood::with(['places', 'indications'])->where('id', $id)->first(),
            'neighbourhoods' => Neighbourhood::all(),
            'actions'        => Action::getActions(),
        ];
    }

    public function getContacts () {
        return Character::getForMessage();
    }

    public function getChatDetails () {
        $ch = request('ch');
        $id = request('id');

        return Chat::getChatDetails($ch, $id);
    }
    public function getMesssageDetails () {
        $ch = request('ch');
        $id = request('id');

        return Chat::getChatDetails($ch, $id);
    }
     
    public function getChatDetailsalready() {
        $id = request('id');
        return Chat::getChatDetailsAll($id);
    }
    
    public function sendMessage () {
        Chat::addUpdate(request()->all());
        $ch = request('from');
        $id = request('to');
        return Chat::getChatDetails($ch, $id);
    }

    public function getRestaurantJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::where('job', $id)->where('id', $ch_id)->first();
        $offers = FarmerOrders::getOffers($ch_id);
        $ingredients = PostObject::getAllWithStockForRestroKeeper($id, $ch_id);
//        $ingredients = RestaurantIngredientsStock::getStock($ch_id);

        $dishes = PostObject::getAll('produced_by', $id, true);

        return [
            'owner'          => $owner,
            'job'            => $job,
            'offers'         => $offers,
            'ingredients'    => $ingredients,
            'dishes'         => $dishes,
            'finance_report' => FinanceReport::getReportData($ch_id),
            'in_process'     => RestaurantPlates::getInProcess($ch_id),
            'back_shop'      => RestaurantPlates::getBackShop($ch_id),
            'front_shop'     => RestaurantPlates::getFrontShop($ch_id),
        ];
    }

    public function getRestaurantJobDetailsForVisitor () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $owner = Character::where('job', $id)->where('id', $ch_id)->first();
        $job = Job::find($id);

        return [
            'owner'      => $owner,
            'job'        => $job,
            'front_shop' => RestaurantPlates::getFrontShop($ch_id),
        ];
    }

    public function actionFarmerOffer () {
        $action = request('action');
        $id = request('id');
        list($ch_id, $msg) = FarmerOrders::action($action, $id);
        $ch = Character::find($ch_id);
        return [
            'msg'         => $msg,
            'offers'      => FarmerOrders::getOffers($ch_id),
            'ingredients' => PostObject::getAllWithStockForRestroKeeper($ch->job, $ch_id),
        ];
    }
    public function actionFarmerOfferShopKeeper () {
        $action = request('action');
        $id = request('offer.id');
               
        list($ch_id, $msg) = FarmerOrders::actionShopKeeper($action, $id);
        $ch = Character::find($ch_id);
        return [
            'msg'         => $msg,
            'offers'      => FarmerOrders::getOffers($ch_id),
            'ingredients' => PostObject::getAllWithStockForShopKeeper($ch->job, $ch_id),
        ];
    }
    public function actionFarmerOfferPhoneSeller () {
        $action = request('action');
        $id = request('offer.id');         
        list($ch_id, $msg) = FactoryOrders::actionPhoneSeller($action, $id);
        $ch = Character::find($ch_id);
        return [
            'msg'         => $msg,
            'offers'      => FactoryOrders::getOffers($ch_id),
            'ingredients' => PostObject::getAllWithStockPhoneSeller($ch->job, $ch_id),
        ];
    }
    public function removeSubManPhoneSeller(){
        $id = request('id');
        CreditSubscription::where('id', $id)->delete();

        return ['msg' => 'Credit Subscription removed successfully'];
    }

    public function restaurantStartProduction () {

        $product = PostObject::with('parts')->find(request('product_id'));
        $insert = [];
        $qty = (int) request('quantity');
        foreach ($product->parts as $part) {
            $ingredient = PostObject::getWithStock($part->id, request('id'));

            if ($ingredient->stock > $part->pivot->quantity * $qty) {
                $insert[] = [
                    'keeper_id'  => request('id'),
                    'product_id' => $part->id,
                    'quantity'   => -($part->pivot->quantity * $qty),
                ];
            } else {
                return [
                    'status' => 'lowStock',
                ];
            }
        }
        RestaurantIngredientsStock::insert($insert);
        RestaurantPlates::create([
            'keeper_id'  => request('id'),
            'product_id' => request('product_id'),
            'quantity'   => $qty,
            'price'      => 0,
        ]);
        $keeper = Character::find(request('id'));
        return [
            'status'      => 'ok',
            'in_process'  => RestaurantPlates::getInProcess(request('id')),
            "ingredients" => PostObject::getAllWithStockForRestroKeeper($keeper->job, $keeper->id),
        ];
    }

    public function saveDishPrice () {
        return RestaurantPlates::savePrice(request('price'), request('id'));
    }

    public function putDish () {
        list($status, $msg, $back, $front) = RestaurantPlates::putDish(request('ch'), request('id'), request('current'), request('qty'), request('place'));
        return [
            'msg'        => $msg,
            'status'     => $status,
            'back_shop'  => $back,
            'front_shop' => $front,
        ];
    }

    public function restaurantRefreshProduction () {
        $product_id = request('product_id');
        RestaurantPlates::addToBack($product_id, request('id'));
        return [
            'in_process' => RestaurantPlates::getInProcess(request('id')),
            'back_shop'  => RestaurantPlates::getBackShop(request('id')),
        ];
    }

    public function farmerSendProduct () {
        $character = Character::find(request('farmer_id'));
        $chargers = DeliveryCharges::getCharges(request('delivery_id'));
        $product = PostObject::getWithStockForFarmer(request('product_id'), request('farmer_id'));
        if ($character->cash >= $chargers) {
            if ($product->stock >= request('quantity')) {
                FarmerOrders::addUpdate(request()->all());
                $character->cash -= $chargers;
                $character->save();
                FinanceReport::addUpdate([
                    'character_id' => $character->id,
                    'job_id'       => $character->job,
                    'client_id'    => request('delivery_id'),
                    'expense'      => $chargers,
                    'revenue'      => 0,
                ]);

                return ['status' => 'ok', 'msg' => 'Offer saved successfully and charges cut from your cash. If offer reject your cash will be recovered.'];
            }
            return ['status' => 'error', 'msg' => 'You dont have enough stock to send.'];
        }
        return ['status' => 'error', 'msg' => 'You dont have enough cash to pay charges'];
    }

    public function getDeliveryJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::select('characters.*', 'delivery_charges.price')
                          ->leftJoin('delivery_charges', 'delivery_charges.character_id', 'characters.id')
                          ->where('job', $id)
                          ->where('characters.id', $ch_id)
                          ->first();
        $offers = FarmerOrders::getRequests($ch_id);
        $inprocess = FarmerOrders::getRequests($ch_id, true);
        $offerFactory = FactoryOrders::getRequests($ch_id);
        $inprocessFactory = FarmerOrders::getRequests($ch_id, true);
        

        return [
            'owner'          => $owner,
            'job'            => $job,
            'requests'       => $offers,
            'in_process'     => $inprocess,
            'finance_report' => FinanceReport::getReportData($ch_id),
            'offerFactory'    => $offerFactory,
            'inprocessFactory' =>$inprocessFactory

        ];
    }

    public function getDeliveryJobDetailsForVisitor () {

        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::select('characters.*', 'delivery_charges.price')
                          ->selectRaw("( SELECT COUNT(*) FROM farmer_orders WHERE  delivery_id = characters.id AND status = 'closed') AS delivery_made")
                          ->leftJoin('delivery_charges', 'delivery_charges.character_id', 'characters.id')
                          ->where('job', $id)
                          ->where('characters.id', $ch_id)
                          ->first();

        return [
            'owner' => $owner,
            'job'   => $job,
        ];
    }

    public function actionDeliveryRequest () {
        $product_id =  request('product_id');
        $action = request('action');
        $id = request('id');
        $request = FarmerOrders::find($id);
        
        $character = Character::find($request->delivery_id);
        $fcharacter = Character::find($request->farmer_id);
        if ($action == 'accept') {
            $request->status = 'inprocess';
            $request->save();
            $character->cash += $request->charges;
            $character->save();

            FinanceReport::addUpdate([
                'character_id' => $character->id,
                'job_id'       => $character->job,
                'client_id'    => $request->farmer_id,
                'expense'      => 0,
                'revenue'      => $request->charges,
            ]);

            FinanceReport::addUpdate([
                'character_id' => $request->farmer_id,
                'job_id'       => $fcharacter->job,
                'client_id'    => $character->id,
                'expense'      => $request->charges,
                'revenue'      => 0,
            ]);

        } else {
            $farmer = Character::find($request->farmer_id);
            $request->status = 'rejected';
            $request->save();
        }

        return [
            'requests'   => FarmerOrders::getRequests($request->delivery_id),
            'in_process' => FarmerOrders::getRequests($request->delivery_id, true),
        ];
    }
    public function actionDeliveryRequestFactory () {
        $product_id =  request('product_id');
        $action = request('action');
        $id = request('id');
        $request = FactoryOrders::find($id);
        
        $character = Character::find($request->delivery_id);
        $fcharacter = Character::find($request->factory_id);
        if ($action == 'accept') {
            $request->status = 'inprocess';
            $request->save();
            $character->cash += $request->charges;
            $character->save();

            FinanceReport::addUpdate([
                'character_id' => $character->id,
                'job_id'       => $character->job,
                'client_id'    => $request->factory_id,
                'expense'      => 0,
                'revenue'      => $request->charges,
            ]);

            FinanceReport::addUpdate([
                'character_id' => $request->factory_id,
                'job_id'       => $fcharacter->job,
                'client_id'    => $character->id,
                'expense'      => $request->charges,
                'revenue'      => 0,
            ]);

        } else {
            $farmer = Character::find($request->factory_id);
            $request->status = 'rejected';
            $request->save();
        }

        return [
            'requests'   => FactoryOrders::getRequests($request->delivery_id),
            'in_process' => FactoryOrders::getRequests($request->delivery_id, true),
        ];
    }
    
    public function saveDeliveryCharges () {
        $exist = DB::table('delivery_charges')->where('character_id', request('id'))->first();
        if ($exist) {
            DB::table('delivery_charges')
              ->where('character_id', request('id'))
              ->update([
                  'price' => request('price'),
              ]);

        } else {
            DB::table('delivery_charges')->insert([
                'price'        => request('price'),
                'character_id' => request('id'),
                'created_at'   => Carbon::now()->toDateTimeString(),
            ]);
        }
        return ['status' => 'ok'];
    }

    public function deliverItem () {
        $request = FarmerOrders::find(request('id'));
        $id = $request->stock_availble_id;
        $stock_request= ShopkeeperAvailableStock::find($id);
        $request->status = 'closed';
        $request->save();
        return [
            'status' => 'ok'
        ];
    }
    public function deliverItemFactory () {
        $request = FactoryOrders::find(request('id'));
        $request->status = 'closed';
        $request->save();
        return [
            'status' => 'ok'
        ];
    }
    public function getJournalistJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::select('characters.*', 'delivery_charges.price')
                          ->leftJoin('delivery_charges', 'delivery_charges.character_id', 'characters.id')
                          ->where('job', $id)
                          ->where('characters.id', $ch_id)
                          ->first();
        $articles = Article::getAll($ch_id);
        return [
            'owner'    => $owner,
            'job'      => $job,
            'articles' => $articles,
        ];
    }

    public function saveArticle () {
        Article::addUpdate(request()->all());
        return [
            'articles' => Article::getAll(request('character_id'))
        ];
    }

    public function buyDish () {

        $id = request('id');
        $owner_id = request('owner_id');
        $cash = request('cash');
        $total = request('total');
        $order = request('order');
        $owner = Character::find($owner_id);
        $character = Character::find($id);
        $character->cash = $cash;
        $character->save();
        FinanceReport::addUpdate([
            'character_id' => $owner_id,
            'job_id'       => $owner->job,
            'client_id'    => $id,
            'revenue'      => $total,
            'expense'      => 0,
        ]);
        foreach ($order as $o) {
            $plate = RestaurantPlates::find($o['id']);
            $plate->quantity -= $o['put'];
            $plate->save();
        }
        return true;
    }

    public function eatDish () {
        $id = request('id');
        $product_id = request('product_id');
        $object = PostObject::find($product_id);
        $characterIndication = CharacterIndication::where('character_id', $id)->where('indication_id', $object->indication_bar_id)->first();
        $real = IndicationBar::find($object->indication_bar_id);
        if ($real && $characterIndication) {
            $characterIndication->points += $object->indication_bar_points;
            $characterIndication->points = $characterIndication->points > $real->max ? $real->max : $characterIndication->points;
            $characterIndication->save();
        }
        return true;
    }

    public function changeNeighbourhood () {
        $result = Character::addUpdate(request()->only('neighbourhood_id'), request('id'));

        return $result;
    }

    public function getHabitationDetails () {
        return HabitationIndication::getAllBars();
    }

    public function homeDoUrine () {
        $indication = IndicationBar::getBar('urine', 'adults');
        $characterIndication = CharacterIndication::getBar(request('ch_id'), $indication->id);

        $characterIndication->points -= abs($indication->daily_points);
        if ($characterIndication->points < $indication->min) {
            $characterIndication->points = $indication->min;
        }

        if ($characterIndication->points > $indication->max) {
            $characterIndication->points = $indication->max;
        }
        $characterIndication->save();
        return true;
    }

    public function homeDoPoop () {
        $indication = IndicationBar::getBar('poop', 'adults');
        $characterIndication = CharacterIndication::getBar(request('ch_id'), $indication->id);

        $characterIndication->points -= abs($indication->daily_points);
        if ($characterIndication->points < $indication->min) {
            $characterIndication->points = $indication->min;
        }

        if ($characterIndication->points > $indication->max) {
            $characterIndication->points = $indication->max;
        }
        $characterIndication->save();
        return true;
    }

    public function homeDoShower () {
        $indication1 = IndicationBar::getBar('cleanliness', 'adults');
        $indication2 = IndicationBar::getBar('water', 'habitation');
        $habitation = \DB::table('character_habitations')->where('character_id', request('ch_id'))->latest()->first();

        $characterIndication = CharacterIndication::getBar(request('ch_id'), $indication1->id);
        $habitationIndication = HabitationIndication::getBar($habitation->id, $indication2->id);

        $characterIndication->points += abs($indication1->daily_points);
        if ($characterIndication->points < $indication1->min) {
            $characterIndication->points = $indication1->min;
        }

        if ($characterIndication->points > $indication1->max) {
            $characterIndication->points = $indication1->max;
        }
        $characterIndication->save();


        $habitationIndication->points -= abs($indication2->daily_points);
        if ($habitationIndication->points < $indication2->min) {
            $habitationIndication->points = $indication2->min;
        }

        if ($habitationIndication->points > $indication2->max) {
            $habitationIndication->points = $indication2->max;
        }
        $habitationIndication->save();
        return HabitationIndication::getAllBars();
    }

    public function homeDoClean () {
        $indication = IndicationBar::getBar('cleanliness', 'habitation');
        $habitation = \DB::table('character_habitations')->where('character_id', request('ch_id'))->latest()->first();
        $habitationIndication = HabitationIndication::getBar($habitation->id, $indication->id);

        $habitationIndication->points += abs($indication->daily_points);
        if ($habitationIndication->points < $indication->min) {
            $habitationIndication->points = $indication->min;
        }

        if ($habitationIndication->points > $indication->max) {
            $habitationIndication->points = $indication->max;
        }
        $habitationIndication->save();
        return HabitationIndication::getAllBars();
    }

    public function cityInteraction () {
        if (strtolower(request('action')) == 'steal') {
            return UserActionHistory::steal(request()->all());
        }
        return UserActionHistory::addUpdate(request()->all());
    }

    public function childrenFeed () {
        $child_id = request('child_id');
        $indication = IndicationBar::getBar('hunger', 'children');
        if ($indication) {
            $childrenIndication = ChildrenIndication::getBar($child_id, $indication->id);
            $childrenIndication->points -= abs($indication->daily_points);
            $childrenIndication->points = $childrenIndication->points < $indication->min ? $indication->min : $childrenIndication->points;
            $childrenIndication->save();
        }

        return Children::with('indications')->where('id', $child_id)->first();
    }

    public function childrenDrink () {
        $child_id = request('child_id');
        $indication = IndicationBar::getBar('thirst', 'children');
        if ($indication) {
            $childrenIndication = ChildrenIndication::getBar($child_id, $indication->id);
            $childrenIndication->points -= abs($indication->daily_points);
            $childrenIndication->points = $childrenIndication->points < $indication->min ? $indication->min : $childrenIndication->points;
            $childrenIndication->save();
        }

        return Children::with('indications')->where('id', $child_id)->first();
    }

    public function childrenUrinate () {
        $child_id = request('child_id');
        $indication = IndicationBar::getBar('urine', 'children');
        if ($indication) {
            $childrenIndication = ChildrenIndication::getBar($child_id, $indication->id);
            $childrenIndication->points -= abs($indication->daily_points);
            $childrenIndication->points = $childrenIndication->points < $indication->min ? $indication->min : $childrenIndication->points;
            $childrenIndication->save();
        }

        return Children::with('indications')->where('id', $child_id)->first();
    }

    public function childrenPoop () {
        $child_id = request('child_id');
        $indication = IndicationBar::getBar('poop', 'children');
        if ($indication) {
            $childrenIndication = ChildrenIndication::getBar($child_id, $indication->id);
            $childrenIndication->points -= abs($indication->daily_points);
            $childrenIndication->points = $childrenIndication->points < $indication->min ? $indication->min : $childrenIndication->points;
            $childrenIndication->save();
        }

        return Children::with('indications')->where('id', $child_id)->first();
    }

    public function getSportCoachJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::select('characters.*', 'coach_subscription_charges.charges')
                          ->leftJoin('coach_subscription_charges', 'coach_subscription_charges.character_id', 'characters.id')
                          ->where('job', $id)
                          ->where('characters.id', $ch_id)->first();
//        $orders = Order::getOrdersForClient($ch_id);
        $orders = PreObject::getObjects($id);
        return [
            'owner'          => $owner,
            'job'            => $job,
            'orders'         => $orders,
            'services'       => CoachService::getServices($ch_id),
            'equipments'     => CoachEquipment::getEquipments($ch_id, 'front'),
            'back_shop'      => CoachEquipment::getEquipments($ch_id, 'back'),
            'finance_report' => FinanceReport::getReportData($ch_id),
        ];
    }

    public function getSportCoachJobDetailsForVisitor () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::where('job', $id)->where('id', $ch_id)->first();
        return [
            'owner'    => $owner,
            'job'      => $job,
            'services' => CoachService::getServices($ch_id),
        ];
    }

    public function coachPurchaseEquipment () {

        $ch_id = request('ch_id');
        $client = Character::find($ch_id);
        $pro_id = request('pro_id');
        $quantity = request('quantity');
        $product = PreObject::where('id', $pro_id)->with('parts')->first();

        if ($client->cash >= $product->price * $quantity) {
            $client->cash -= $product->price * $quantity;
            $client->save();
            FinanceReport::addUpdate([
                'character_id' => $ch_id,
                'client_id'    => 0,
                'revenue'      => '',
                'expense'      => $product->price * $quantity,
                'job_id'       => $client->job,
            ]);

            $exist = CoachEquipment::where('product_id', $pro_id)->where('character_id', $ch_id)->where('status', 'back')->first();
            if ($exist) {
                $exist->quantity += $quantity;
                $exist->save();
            } else {

                CoachEquipment::create([
                    'character_id' => $ch_id,
                    'product_id'   => $pro_id,
                    'time_used'    => 0,
                    'price'        => $product->price,
                    'quantity'     => $quantity,
                    'status'       => 'back',
                ]);
                foreach ($product->parts as $service) {
                    CoachService::create([
                        'character_id' => $ch_id,
                        'product_id'   => $service->id,
                        'is_active'    => 1,
                        'price'        => 0
                    ]);
                }
            }
            $msg = "Brought successfully";
        } else {
            $msg = "You dont have enough cash to buy";
        }

        return [
            'back_shop' => CoachEquipment::getEquipments($ch_id, 'back'),
            'msg'       => $msg,
        ];
    }

    public function saveCoachServicePrice () {
        $ch_id = request('id');
        $service_id = request('service');
        $price = request('price');
        CoachService::where('character_id', $ch_id)->where('product_id', $service_id)->update([
            'price' => $price,
        ]);
        return true;
    }

    public function changeServiceStatus () {
        $id = request('id');
        $service = CoachService::find($id);
        $service->is_active = $service->is_active == 1 ? 0 : 1;
        $service->save();
        return true;
    }


    public function coachPutFront () {
        $id = request('id');
        $product_id = request('product');
        $quantity = request('quantity');

        $exist = CoachEquipment::where('product_id', $product_id)->where('character_id', $id)->where('status', 'front')->first();
        $back = CoachEquipment::where('product_id', $product_id)->where('character_id', $id)->where('status', 'back')->first();

        if ($exist) {
            $exist->quantity += $quantity;
            $exist->save();
        } else {
            CoachEquipment::create([
                'character_id' => $back->character_id,
                'product_id'   => $back->product_id,
                'time_used'    => 0,
                'price'        => $back->price,
                'quantity'     => $quantity,
                'status'       => 'front',
            ]);
        }
        $back->quantity -= $quantity;
        $back->save();
        return [
            'equipments' => CoachEquipment::getEquipments($id, 'front'),
            'back_shop'  => CoachEquipment::getEquipments($id, 'back'),
        ];

    }

    public function saveCoachSubscriptionsPrice () {
        $ch_id = request('id');
        $charges = request('charges');
        $exist = DB::table('coach_subscription_charges')->where('character_id', $ch_id)->first();
        if ($exist) {
            DB::table('coach_subscription_charges')->where('character_id', $ch_id)->update([
                'charges' => $charges,
            ]);
        } else {
            DB::table('coach_subscription_charges')->insert(['character_id' => $ch_id, 'charges' => $charges]);
        }
        return true;
    }

    public function coachVisitorPayService () {
        $total = request('total');
        $client = auth()->user()->character;
        $client_id = $client->id;
        $owner_id = request('owner_id');
        $services = request('services');
        $subscribed = request('subscribed');


        if ($subscribed || $client->cash >= $total) {

            $owner = Character::find($owner_id);
            if ( !$subscribed) {
                $owner->cash += $total;
                $owner->save();

                $client->cash -= $total;
                $client->save();

                FinanceReport::addUpdate([
                    'character_id' => $owner_id,
                    'client_id'    => $client_id,
                    'revenue'      => $total,
                    'expense'      => '',
                    'job_id'       => $owner->job,
                ]);
            }

            foreach ($services as $ser) {
                $service = PostObject::where('id', $ser['id'])->with('parts')->first();
                $part = $service->parts->first();
                $eq = CoachEquipment::where('character_id', $owner_id)->where('product_id', $part->id)->first();
                if ($eq) {
                    $eq->time_used++;
                    $eq->save();
                }

                $characterIndication = CharacterIndication::where('character_id', $client_id)->where('indication_id', $service->indication_bar_id)->first();
                $real = IndicationBar::find($service->indication_bar_id);
                if ($real && $characterIndication) {
                    $characterIndication->points += $service->indication_bar_points;
                    $characterIndication->points = $characterIndication->points < $real->min ? $real->min : $characterIndication->points;
                    $characterIndication->points = $characterIndication->points > $real->max ? $real->max : $characterIndication->points;
                    $characterIndication->save();
                }

            }

            $msg = "Done";
            $status = 'ok';
        } else {
            $msg = "You dont have enough cash";
            $status = 'no cash';
        }

        return ['status' => $status, 'msg' => $msg];

    }

    public function subscribeToGym () {
        return CoachSubscription::create([
            'coach_id'   => request('id'),
            'visitor_id' => auth()->user()->character->id,
        ]);
    }

    public function getPractitionerJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::select('characters.*', 'practitioner_charges.adult_fees', 'practitioner_charges.children_fees')
                          ->leftJoin('practitioner_charges', 'practitioner_charges.practitioner_id', 'characters.id')
                          ->where('characters.id', $ch_id)->first();
        $orders = PreObject::getObjects($id);
        return [
            'owner'          => $owner,
            'job'            => $job,
            'supplies'       => $orders,
            'requests'       => DiagnoseRequest::getRequests($ch_id),
            'equipments'     => PractitionerEquipment::getEquipments($ch_id),
            'finance_report' => FinanceReport::getReportData($ch_id),
        ];
    }

    public function getPractitionerJobDetailsForVisitor () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::select('characters.*', 'practitioner_charges.adult_fees', 'practitioner_charges.children_fees')
                          ->leftJoin('practitioner_charges', 'practitioner_charges.practitioner_id', 'characters.id')
                          ->where('characters.id', $ch_id)->first();
        return [
            'owner' => $owner,
            'job'   => $job,
        ];
    }

    public function practitionerPurchaseEquipment () {
        $ch_id = request('ch_id');
        $client = Character::find($ch_id);
        $pro_id = request('pro_id');
        $quantity = request('quantity');
        $product = PreObject::where('id', $pro_id)->first();

        if ($client->cash >= $product->price * $quantity) {
            $client->cash -= $product->price * $quantity;
            $client->save();
            FinanceReport::addUpdate([
                'character_id' => $ch_id,
                'client_id'    => 0,
                'revenue'      => '',
                'expense'      => $product->price * $quantity,
                'job_id'       => $client->job,
            ]);

            $exist = PractitionerEquipment::where('product_id', $pro_id)->where('practitioner_id', $ch_id)->first();
            if ($exist) {
                $exist->quantity += $quantity;
                $exist->save();
            } else {
                PractitionerEquipment::create([
                    'practitioner_id' => $ch_id,
                    'product_id'      => $pro_id,
                    'quantity'        => $quantity,
                ]);
            }
            $msg = "Brought successfully";
        } else {
            $msg = "You dont have enough cash to buy";
        }

        return [
            'equipments' => PractitionerEquipment::getEquipments($ch_id),
            'msg'        => $msg,
        ];
    }

    public function practitionerSaveDiagnoseRequest () {
        $ch_id = request('ch_id');
        $type = request('type');
        $fee = request('fee');
        $client = auth()->user()->character;
        if ($client->cash >= $fee) {

            $client->cash -= $fee;
            $client->save();
            DB::table('diagnose_requests')->insert([
                'practitioner_id' => $ch_id,
                'client_id'       => $client->id,
                'fees'            => $fee,
                'type'            => $type,
            ]);
            $msg = 'You request saved successfully';
        } else {
            $msg = 'You dont have enough cash';
        }
        return [
            'msg' => $msg,
        ];

    }

    public function practitionerSaveCharges () {
        $ch_id = request('ch_id');
        $adult_fees = request('adult_fees', 0);
        $children_fees = request('children_fees', 0);
        $exist = DB::table('practitioner_charges')->where('practitioner_id', $ch_id)->first();
        if ($exist) {
            DB::table('practitioner_charges')->where('practitioner_id', $ch_id)->update([
                'adult_fees'    => $adult_fees,
                'children_fees' => $children_fees,
            ]);
        } else {
            DB::table('practitioner_charges')->insert([
                'practitioner_id' => $ch_id,
                'adult_fees'      => $adult_fees,
                'children_fees'   => $children_fees,
            ]);
        }
        return true;
    }


    public function practitionerRequestAction () {
        $ch_id = request('ch_id');
        $request_id = request('request');
        $action = request('action');

        $request = DiagnoseRequest::find($request_id);
        $client = Character::find($request->client_id);
        if ($action == 'reject') {
            $client->cash += $request->fees;
            $client->save();
            $request->status = 'rejected';
            $request->save();
            UserActionHistory::addUpdate([
                'created_by' => $ch_id, 'action_to' => $request->client_id, 'action' => 'Rejected Request for diagnose', 'status' => 'rejected'
            ]);
        } else {
            $practitioner = Character::find($request->practitioner_id);
            $practitioner->cash += $request->fees;
            $practitioner->save();

            FinanceReport::addUpdate([
                'character_id' => $ch_id,
                'client_id'    => $client->id,
                'revenue'      => $request->fees,
                'expense'      => '',
                'job_id'       => $practitioner->job,
            ]);
        }
        return ['requests' => DiagnoseRequest::getRequests($ch_id)];
    }

    public function getPharmacistJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::find($ch_id);
        $supplies = DB::table('medications')->get();
        return [
            'owner'          => $owner,
            'job'            => $job,
            'supplies'       => $supplies,
            'back_shop'      => PharmacistStock::getStock($ch_id),
            'front_shop'     => PharmacistStock::getStock($ch_id, 'front'),
            'finance_report' => FinanceReport::getReportData($ch_id),
        ];
    }

    public function getPharmacistJobDetailsForVisitor () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::find($ch_id);
        return [
            'owner'      => $owner,
            'job'        => $job,
            'front_shop' => PharmacistStock::getStock($ch_id, 'front'),
        ];
    }

    public function pharmacistPurchaseMedication () {
        $ch_id = request('ch_id');
        $client = Character::find($ch_id);
        $pro_id = request('pro_id');
        $quantity = request('quantity');
        $product = DB::table('medications')->where('id', $pro_id)->first();

        if ($client->cash >= $product->price * $quantity) {
            $client->cash -= $product->price * $quantity;
            $client->save();
            FinanceReport::addUpdate([
                'character_id' => $ch_id,
                'client_id'    => 0,
                'revenue'      => '',
                'expense'      => $product->price * $quantity,
                'job_id'       => $client->job,
            ]);

            $exist = PharmacistStock::where('medication_id', $pro_id)->where('character_id', $ch_id)->where('status', 'back')->first();
            if ($exist) {
                $exist->quantity += $quantity;
                $exist->save();
            } else {
                PharmacistStock::create([
                    'character_id'  => $ch_id,
                    'medication_id' => $pro_id,
                    'quantity'      => $quantity,
                    'price'         => 0,
                    'status'        => 'back'
                ]);
            }
            $msg = "Brought successfully";
        } else {
            $msg = "You dont have enough cash to buy";
        }

        return [
            'back_shop' => PharmacistStock::getStock($ch_id),
            'msg'       => $msg,
        ];
    }

    public function pharmacistSaveMedicationPrice () {
        PharmacistStock::where('id', request('id'))->update([
            'price' => request('price'),
        ]);
        return true;
    }

    public function pharmacistPutFront () {
        $ch_id = request('ch_id');
        $med_id = request('med_id');
        $qty = request('quantity');
        $back = PharmacistStock::where('medication_id', $med_id)->where('character_id', $ch_id)->where('status', 'back')->first();
        $exist = PharmacistStock::where('medication_id', $med_id)->where('character_id', $ch_id)->where('status', 'front')->first();
        $back->quantity -= $qty;
        $back->save();
        if ($exist) {
            $exist->quantity += $qty;
            $exist->price = $back->price;
            $exist->save();
        } else {
            PharmacistStock::create([
                'character_id'  => $ch_id,
                'medication_id' => $med_id,
                'quantity'      => $qty,
                'price'         => $back->price,
                'status'        => 'front'
            ]);
        }
        return [
            'back_shop'  => PharmacistStock::getStock($ch_id),
            'front_shop' => PharmacistStock::getStock($ch_id, 'front'),
        ];
    }

    public function pharmacistPutBack () {
        $ch_id = request('ch_id');
        $med_id = request('med_id');
        $qty = request('quantity');
        $exist = PharmacistStock::where('medication_id', $med_id)->where('character_id', $ch_id)->where('status', 'back')->first();
        $front = PharmacistStock::where('medication_id', $med_id)->where('character_id', $ch_id)->where('status', 'front')->first();
        $front->quantity -= $qty;
        $front->save();

        if ($exist) {
            $exist->quantity += $qty;
            $exist->save();
        } else {
            PharmacistStock::create([
                'character_id'  => $ch_id,
                'medication_id' => $med_id,
                'quantity'      => $qty,
                'price'         => 0,
                'status'        => 'back'
            ]);
        }
        return [
            'back_shop'  => PharmacistStock::getStock($ch_id),
            'front_shop' => PharmacistStock::getStock($ch_id, 'front'),
        ];
    }

    public function pharmacistVisitorPay () {
        $total = request('total');
        $owner_id = request('owner_id');
        $medications = request('medications');
        $owner = Character::find($owner_id);
        $client = auth()->user()->character;
        if ($client->cash >= $total) {
            $client->cash -= $total;
            $client->save();
            $owner->cash += $total;
            $owner->save();

            FinanceReport::addUpdate([
                'character_id' => $owner_id,
                'client_id'    => $client->id,
                'revenue'      => $total,
                'expense'      => 0,
                'job_id'       => $owner->job,
            ]);

            foreach ($medications as $medication) {


                $stock = PharmacistStock::where('medication_id', $medication['medication_id'])->where('character_id', $owner_id)->where('status', 'front')->first();
                $stock->quantity -= $medication['quantity'];
                $stock->save();

                $ids = Children::select('id')->where('parent1', $client->id)->orWhere('parent2', $client->id)->pluck('id')->toArray();
                $ids[] = $client->id;
                $disease_ids = CharacterDisease::whereIn('character_id', $ids)
                                               ->where('disease_id', $medication['cures'])
                                               ->where('status', 'active')
                                               ->where('type', 'adult')
                                               ->limit($medication['quantity'])
                                               ->pluck('id')
                                               ->toArray();

                if ($disease_ids) {
                    CharacterDisease::whereIn('id', $ids)->update([
                        'status' => 'cured',
                    ]);
                    UserActionHistory::addUpdate([
                        'created_by' => '', 'action_to' => $client->id, 'action' => 'Your disease cured', 'status' => 'accepted'
                    ]);
                }
            }

            $msg = 'brought successfully';
        } else {
            $msg = 'You dont have enough cash';
        }
        return [
            'msg'        => $msg,
            'front_shop' => PharmacistStock::getStock($owner_id, 'front'),
        ];
    }

    public function createGroup () {
        $input = request()->validate([
            'group_name'      => 'required',
            'company_name'    => 'required',
            'company_job'     => 'required',
            'company_capital' => 'required',
            'company_logo'    => 'required',
        ]);
        $user = auth()->user();
        $character = $user->character;
        $setting = DB::table('settings')->latest()->first();
        $total = $setting->create_group + $setting->create_first_company;
        if ($user->diamonds >= $total && $character->cash > request('company_capital')) {
            $result = Group::addGroup($input, $character->id);
            if ($result) {
                $character->cash -= request('company_capital');
                $character->save();
                $user->diamonds -= $total;
                $user->save();
                return ['msg' => 'Created successfully'];
            }
            return ['msg' => 'Company not created.'];
        } else {
            return ['msg' => 'You dont have enough diamonds or cash'];
        }

    }

    public function createCompany () {
        $input = request()->validate([
            'company_name'    => 'required',
            'company_job'     => 'required',
            'company_capital' => 'required',
            'company_logo'    => 'required',
        ]);
        $user = auth()->user();
        $character = $user->character;
        $character_id = $character->id;
         $existCompany = Company::where('character_id', $character_id)->where('job_id', request('company_job'))->first();
         if($existCompany)
         {
            return ['msg' => 'Company already exists!'];
         }
         else{
        $setting = DB::table('settings')->latest()->first();
        $total = $setting->create_company;
        if ($user->diamonds >= $total && $character->cash > request('company_capital')) {
            $group_id = null;
            if($character->group){
                $group_id = $character->group->id;
            }

            $path = $this->UploadFile('company_logo', 'company_logo/');
            $company = Company::create([
                'name'         => $input['company_name'],
                'group_id'     => $group_id,
                'character_id' => $character_id,
                'logo'         => $path,
                'job_id'       => $input['company_job'],
                'capital'      => $input['company_capital']
            ]);
            if ($company) {
                $character->cash -= request('company_capital');
                $character->save();
                $user->diamonds -= $total;
                $user->save();
                return ['msg' => 'Created successfully'];
            }
            return ['msg' => 'Company not created.'];
        } else {
            return ['msg' => 'You dont have enough diamonds or cash'];
        }
    }

    }

    public function getShopKeeperJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $availabestock = ShopkeeperAvailableStock::all();
        $offers = FarmerOrders::getOffers($ch_id);
        $ingredients = PostObject::getAllWithStockForShopKeeper($id, $ch_id);
        $owner = Character::find($ch_id);
        $company = Company::where('character_id', $ch_id)->where('job_id', $id)->first();
        if ($company) {
            return [
                'owner'             => $owner,
                'company'           => $company,
                'job'               => $job,
                'offers'         => $offers,
                'ingredients'    => $ingredients,
                'availabestock' => $availabestock,
                'doer'              => 2,
                'supplies'          => PreObject::getObjects($id),
                'manager_stock'     => ShopManagerStock::getStock($ch_id),
                'employees'         => CompanyEmployee::getEmployees($company->id),
                'employee_requests' => ShopKeeperStockRequest::getRequestsForManager($ch_id),
                'applications'      => JobApplication::getApplications($ch_id, $id),
                'finance_report'    => FinanceReport::getReportData($ch_id),
            ];
        } else {
            $companyInfo = DB::table('company_employees')
                             ->select('company_id')
                             ->where('company_employees.employee_id', $ch_id)
                             ->latest()
                             ->first();
            $company = Company::find($companyInfo->company_id);
            $manager = $company->owner;

            return [
                'owner'             => $owner,
                'job'               => $job,
                'doer'              => 1,
                'company'           => $company,
                'ingredients'    => $ingredients,
                'availabestock' => $availabestock,
                'manager'           => $manager,
                'back'              => ShopKeeperStock::getStock($ch_id, 'back'),
                'front'             => ShopKeeperStock::getStock($ch_id, 'front'),
                'products'          => PreObject::getObjectsForList($id),
                'employee_requests' => ShopKeeperStockRequest::getRequestsForKeeper($ch_id),
                'finance_report'    => FinanceReport::getReportData($ch_id),
            ];
        }


    }

    public function ShopManagerBuyProduct () {
        $ch_id = request('ch_id');
        $company_id = request('company_id');
        $quantity = request('quantity');
        $pro_id = request('pro_id');

        $object = PreObject::find($pro_id);
        $company = Company::find($company_id);
        $owner = Character::find($ch_id);
        $total = $object->price * $quantity;

        if ($company->capital >= $total) {
            $company->capital -= $total;
            $company->save();

            FinanceReport::addUpdate([
                'character_id' => $ch_id,
                'job_id'       => $owner->job,
                'client_id'    => 0,
                'revenue'      => 0,
                'expense'      => $total,
            ]);

            $exist = ShopManagerStock::where('product_id', $pro_id)->where('manager_id', $ch_id)->first();
            if ($exist) {
                $exist->quantity += $quantity;
                $exist->save();
            } else {
                ShopManagerStock::create([
                    'product_id' => $pro_id,
                    'manager_id' => $ch_id,
                    'quantity'   => $quantity,
                ]);
            }
            $msg = 'Brought successfully';
        } else {
            $msg = 'Your Company account dont have enough cash';
        }

        return [
            'msg'            => $msg,
            'manager_stock'  => ShopManagerStock::getStock($ch_id),
            'company'        => $company,
            'finance_report' => FinanceReport::getReportData($ch_id),
        ];
    }

    public function shopManagerStockRequestAction () {
        $request_id = request('request_id');
        $action = request('action');
        $request = ShopKeeperStockRequest::find($request_id);
        $ch_id = $request->manager_id;
        if ($action == 'accept') {
            $stock = ShopManagerStock::where('manager_id', $request->manager_id)->where('product_id', $request->product_id)->first();
            if ($stock && $stock->quantity >= $request->quantity) {
                $request->status = 'accepted';
                $request->save();
                $stock->quantity -= $request->quantity;
                $stock->save();

                $exist = ShopKeeperStock::where('keeper_id', $request->keeper_id)->where('product_id', $request->product_id)->where('status', 'back')->first();
                if ($exist) {
                    $exist->quantity += $request->quantity;
                    $exist->save();
                } else {
                    ShopKeeperStock::create([
                        'product_id' => $request->product_id,
                        'keeper_id'  => $request->keeper_id,
                        'quantity'   => $request->quantity,
                        'price'      => 0,
                        'status'     => 'back'
                    ]);
                }

                $msg = 'Accepted';
            } else {
                $msg = 'Not enough stock';
            }
        } else {
            $request->status = 'rejected';
            $request->save();
            $msg = 'Rejected';
        }
        return [
            'msg'               => $msg,
            'manager_stock'     => ShopManagerStock::getStock($ch_id),
            'employee_requests' => ShopKeeperStockRequest::getRequestsForManager($ch_id),
        ];
    }

    public function createJobOffer () {
        $result = JobOffer::create([
            'job_id'     => request('job_id'),
            'posted_by'  => request('posted_by'),
            'company_id' => request('company_id'),
            'commission' => request('commission'),
            'contract'   => request('contract'),
            'status'     => 'open',
        ]);
        return $result ? true : false;
    }

    public function jobApplicationAction () {
        $action = request('action');
        $id = request('request_id');
        $ch_id = request('ch_id');
        $character = Character::find($ch_id);
        $application = JobApplication::find($id);
        $job = Job::find($application->job_id);
        $company_id = $application->offer->company_id;
        if ($action == 'accept') {
            $employee = Character::find($application->applied_by);
            $employee->job = $application->job_id;
            $employee->save();
            $application->status = 'accepted';
            $application->save();
            UserActionHistory::addUpdate([
                'created_by' => $ch_id,
                'action_to'  => $application->applied_by,
                'action'     => 'Your Request for ' . $job->job_name . ' Job Accepted',
                'status'     => 'accepted'
            ]);
            CompanyEmployee::create([
                'company_id'   => $company_id,
                'employee_id'  => $application->applied_by,
                'contract'     => $application->offer->contract,
                'commission'   => $application->offer->commission,
                'joining_date' => Carbon::now()->toDateTimeString(),
            ]);


            $msg = 'Accepted';
        } else {
            $application->status = 'rejected';
            $application->save();
            UserActionHistory::addUpdate([
                'created_by' => $ch_id,
                'action_to'  => $application->applied_by,
                'action'     => 'Your Request for ' . $job->job_name . ' Job Rejected',
                'status'     => 'rejected'
            ]);
            $msg = 'Rejected';
        }

        return [
            'msg'          => $msg,
            'applications' => JobApplication::getApplications($ch_id, $character->job),
            'employees'    => CompanyEmployee::getEmployees($company_id),
        ];
    }

    public function sendBonus () {
        $company_id = request('company_id');
        $bonus = request('bonus');
        $employee_id = request('employee_id');
        $employee = Character::find($employee_id);
        $company = Company::find($company_id);
        $owner = $company->owner;

        if ($company->capital >= $bonus) {
            $company->capital -= $bonus;
            $company->save();
            $employee->cash += $bonus;
            $employee->save();

            FinanceReport::addUpdate([
                'character_id' => $owner->id,
                'job_id'       => $employee->job,
                'client_id'    => $employee_id,
                'revenue'      => 0,
                'expense'      => $bonus,
            ]);

            FinanceReport::addUpdate([
                'character_id' => $employee_id,
                'job_id'       => $employee->job,
                'client_id'    => 0,
                'revenue'      => 0,
                'expense'      => 0,
                'bonus'        => $bonus
            ]);

            $msg = "Bonus Sent";
        } else {
            $msg = "Your company account dont have enough cash";
        }
        return [
            'msg'            => $msg,
            'company'        => $company,
            'finance_report' => FinanceReport::getReportData($owner->id)
        ];
    }

    public function fireEmployee () {
        $id = request('employee');
        $ch_id = request('ch_id');
        $job_id = request('job_id');
        $company_id = request('company_id');
        $job = Job::find($job_id);
        UserActionHistory::addUpdate([
            'created_by' => $ch_id,
            'action_to'  => $id,
            'action'     => 'You are fired from ' . $job->job_name . ' Job',
            'status'     => 'accepted'
        ]);

        return CompanyEmployee::where('employee_id', $id)->where('company_id', $company_id)->delete();
    }

    public function createShopKeeperItemRequest () {

        ShopKeeperStockRequest::create([
            'manager_id' => request('manager_id'),
            'keeper_id'  => request('ch_id'),
            'product_id' => request('product_id'),
            'quantity'   => request('quantity'),
            'status'     => 'pending'
        ]);

        return [
            'msg'               => 'Request Created',
            'employee_requests' => ShopKeeperStockRequest::getRequestsForKeeper(request('ch_id')),
        ];
    }

    public function shopkeeperSaveItemPrice () {
        $ch_id = request('ch_id');
        ShopKeeperStock::where('keeper_id', $ch_id)->where('product_id', request('product_id'))->update([
            'price' => request('price')
        ]);
        return [
            'back_shop'  => ShopKeeperStock::getStock($ch_id),
            'front_shop' => ShopKeeperStock::getStock($ch_id, 'front'),
        ];
    }

    public function shopkeeperPutFront () {
        $ch_id = request('ch_id');
        $pro_id = request('pro_id');
        $qty = request('quantity');
        $back = ShopKeeperStock::where('product_id', $pro_id)->where('keeper_id', $ch_id)->where('status', 'back')->first();
        $exist = ShopKeeperStock::where('product_id', $pro_id)->where('keeper_id', $ch_id)->where('status', 'front')->first();
        $back->quantity -= $qty;
        $back->save();
        if ($exist) {
            $exist->quantity += $qty;
            $exist->price = $back->price;
            $exist->save();
        } else {
            ShopKeeperStock::create([
                'keeper_id'  => $ch_id,
                'product_id' => $pro_id,
                'quantity'   => $qty,
                'price'      => $back->price,
                'status'     => 'front'
            ]);
        }
        return [
            'back_shop'  => ShopKeeperStock::getStock($ch_id),
            'front_shop' => ShopKeeperStock::getStock($ch_id, 'front'),
        ];
    }

    public function shopkeeperPutBack () {
        $ch_id = request('ch_id');
        $pro_id = request('pro_id');
        $qty = request('quantity');

        $exist = ShopKeeperStock::where('product_id', $pro_id)->where('keeper_id', $ch_id)->where('status', 'back')->first();
        $front = ShopKeeperStock::where('product_id', $pro_id)->where('keeper_id', $ch_id)->where('status', 'front')->first();

        $front->quantity -= $qty;
        $front->save();

        if ($exist) {
            $exist->quantity += $qty;
            $exist->save();
        } else {
            ShopKeeperStock::create([
                'keeper_id'  => $ch_id,
                'product_id' => $pro_id,
                'quantity'   => $qty,
                'price'      => 0,
                'status'     => 'back'
            ]);
        }
        return [
            'back_shop'  => ShopKeeperStock::getStock($ch_id),
            'front_shop' => ShopKeeperStock::getStock($ch_id, 'front'),
        ];
    }

    public function getShopKeeperJobDetailsForVisitor () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::find($ch_id);
        $companyInfo = DB::table('company_employees')
                         ->select('company_id')
                         ->where('company_employees.employee_id', $ch_id)
                         ->latest()
                         ->first();
        if ($companyInfo) {
            $company = Company::find($companyInfo->company_id);
            return [
                'owner'      => $owner,
                'job'        => $job,
                'doer'       => 3,
                'company'    => $company,
                'front_shop' => ShopKeeperStock::getStock($ch_id, 'front'),
            ];
        }
    }

    public function shopkeeperVisitorPay () {
        $total = request('total');
        $owner_id = request('owner_id');
        $company_id = request('company_id');
        $items = request('items');
        $owner = Character::find($owner_id);
        $job_id = $owner->job;
        $company = Company::find($company_id);
        $manager = $company->owner;
        $client = auth()->user()->character;
        if ($client->cash >= $total) {
            $employee_info = CompanyEmployee::where('employee_id', $owner_id)->where('company_id', $company_id)->latest()->first();
            foreach ($items as $item) {
                $stock = ShopKeeperStock::where('product_id', $item['product_id'])->where('keeper_id', $owner_id)->where('status', 'front')->first();
                $stock->quantity -= $item['quantity'];
                $stock->save();
            }

            $client->cash -= $total;
            $client->save();

            $commission = $total * ($employee_info->commission / 100);
            $earning = $total - $commission;

            $company->capital += $earning;
            $company->save();
            $owner->cash += $commission;
            $owner->save();

            FinanceReport::addUpdate([
                'character_id' => $owner_id,
                'client_id'    => $client->id,
                'revenue'      => $total,
                'expense'      => 0,
                'commission'   => $commission,
                'job_id'       => $job_id,
            ]);

            FinanceReport::addUpdate([
                'character_id' => $manager->id,
                'client_id'    => $client->id,
                'revenue'      => $total,
                'expense'      => 0,
                'commission'   => $commission,
                'job_id'       => $job_id,
            ]);


            $msg = 'brought successfully';
        } else {
            $msg = 'You dont have enough cash';
        }
        return [
            'msg'        => $msg,
            'front_shop' => ShopKeeperStock::getStock($owner_id, 'front'),
        ];
    }

    public function getDustManJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);

        $owner = Character::find($ch_id);
        $company = Company::where('character_id', $ch_id)->where('job_id', $id)->first();
        
        if ($company) {
            return [
                'owner'             => $owner,
                'company'           => $company,
                'job'               => $job,
                'doer'              => 2,
                'supplies'          => PreObject::getObjects($id),
                'manager_stock'     => DustManagerStock::getStock($ch_id),
                'employees'         => CompanyEmployee::getEmployees($company->id),
                'employee_requests' => DustManStockRequest::getRequestsForManager($ch_id),
                'applications'      => JobApplication::getApplications($ch_id, $id),
                'finance_report'    => FinanceReport::getReportData($ch_id),
                'disposal_requests'    => TrashCleanRequests::getRequestsForDustMan($ch_id,$company->id),
            ];
        } else {
            $companyInfo = DB::table('company_employees')
                             ->select('company_id')
                             ->where('company_employees.employee_id', $ch_id)
                             ->latest()
                             ->first();
            $company = Company::find($companyInfo->company_id);
            $manager = $company->owner;

            return [
                'owner'             => $owner,
                'job'               => $job,
                'doer'              => 1,
                'company'           => $company,
                'manager'           => $manager,
                'tools'             => DustManStock::getStock($ch_id),
                'products'          => PreObject::getObjectsForList($id),
                'employee_requests' => DustManStockRequest::getRequestsForKeeper($ch_id),
                'finance_report'    => FinanceReport::getReportData($ch_id),
                'disposal_requests'    => TrashCleanRequests::getRequestsForDustMan($ch_id,$company->id),

            ];
        }
    }
 
    public function phoneSellerDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $offers = FactoryOrders::getOffers($ch_id);
        $availabestock = PhoneMangerStock::all();
        $ingredients = PostObject::getAllWithStockPhoneSeller($id, $ch_id);
        $owner = Character::find($ch_id);
        
        $company = Company::where('character_id', $ch_id)->where('job_id', $id)->first();
        if ($company) {
            return [
                'owner'             => $owner,
                'company'           => $company,
                'job'               => $job,
                'doer'              => 2,
                'availabestock' => $availabestock,
                'applications'      => JobApplication::getApplications($ch_id, $id),
                'employees'         => CompanyEmployee::getEmployees($company->id),
                'subscription_plan' => CreditSubscription::where('character_id', $ch_id)->where('job_id', $id)->get(),
                'supplies'          => PreObject::getObjects($id),
                'supplies'          => PreObject::getObjects($id),
                'offers'         => $offers,
                'ingredients'    => $ingredients,
                'employee_requests' => PhoneSellerRequest::getRequestsForManager($ch_id),
                'finance_report'    => FinanceReport::getReportData($ch_id),
                'manager_stock'     => PhoneMangerStock::getStock($ch_id),
                // 'subscription_plan_buyer' => BuySubscriptionPlan::where('character_id', $ch_id)->where('job_id', $id)->get(),
                'subscription_plan_buyer' => BuySubscriptionPlan::getBuyerSub($ch_id,$id)

            ];
            
        } else {
            $companyInfo = DB::table('company_employees')
                             ->select('company_id')
                             ->where('company_employees.employee_id', $ch_id)
                             ->latest()
                             ->first();
            $company = Company::find($companyInfo->company_id);
            $manager = $company->owner;
            return [
                'owner'             => $owner,
                'job'               => $job,
                'doer'              => 1,
                'company'           => $company,
                'manager'           => $manager,
                'offers'         => $offers,
                'availabestock' => $availabestock,
                'subscription_plan' => CreditSubscription::where('character_id', $ch_id)->where('job_id', $id)->get(),
                'ingredients'    => $ingredients,
                'products'          => PreObject::getObjectsForList($id),
                'employee_requests' => PhoneSellerRequest::getRequestsForKeeper($ch_id),
                'front'             => PhoneMangerStock::getStock($ch_id, 'front'),
                'finance_report'    => FinanceReport::getReportData($ch_id), 
                'keeperFront'       => PhoneKeeperStock::getStock($ch_id),
                

            ];
        }
    }
    public function getPhoneSellerJobDetailsForVisitor () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::find($ch_id);
        $companyInfo = DB::table('company_employees')
                         ->select('company_id')
                         ->where('company_employees.employee_id', $ch_id)
                         ->latest()
                         ->first();
                         dd($companyInfo);
         $OwnercompanyInfo = Company::where('character_id', $owner->id)->where('job_id', $id)->first();
         
        if ($companyInfo) {
            $company = Company::find($companyInfo->company_id);
            return [
                'owner'      => $owner,
                'job'        => $job,
                'doer'       => 3,
                'company'    => $company,
                'ownerCompany' => $OwnercompanyInfo,
                'subscription_plan' => CreditSubscription::where('character_id', $owner->id)->where('job_id', $id)->get(),
                'subscription_plan_buy' => CreditSubscription::where('character_id', $id)->where('job_id', $id)->get(),
            ];
        }
    }
    public function buyKeeperCrdeit(){
        $ch_id = request('ch_id');
        $credit = request('credit');
        $quantity = request('Qnty'); 
        ItemPocket::create([
            'character_id' => $ch_id,
            'credits' => $credit,
            'quantity'   => $quantity,
        ]);   
    }

    public function DustManBuyProduct () {
        $ch_id = request('ch_id');
        $company_id = request('company_id');
        $quantity = request('quantity');
        $pro_id = request('pro_id');

        $object = PreObject::find($pro_id);
        $company = Company::find($company_id);
        $owner = Character::find($ch_id);
        $total = $object->price * $quantity;

        if ($company->capital >= $total) {
            $company->capital -= $total;
            $company->save();

            FinanceReport::addUpdate([
                'character_id' => $ch_id,
                'job_id'       => $owner->job,
                'client_id'    => 0,
                'revenue'      => 0,
                'expense'      => $total,
            ]);

            $exist = DustManagerStock::where('product_id', $pro_id)->where('manager_id', $ch_id)->first();
            if ($exist) {
                $exist->quantity += $quantity;
                $exist->save();
            } else {
                DustManagerStock::create([
                    'product_id' => $pro_id,
                    'manager_id' => $ch_id,
                    'quantity'   => $quantity,
                ]);
            }
            $msg = 'Brought successfully';
        } else {
            $msg = 'Your Company account dont have enough cash';
        }

        return [
            'msg'            => $msg,
            'manager_stock'  => DustManagerStock::getStock($ch_id),
            'company'        => $company,
            'finance_report' => FinanceReport::getReportData($ch_id),
        ];
    }

    public function dustManagerStockRequestAction () {
        $request_id = request('request_id');
        $action = request('action');
        $request = DustManStockRequest::find($request_id);
        $ch_id = $request->manager_id;
        if ($action == 'accept') {
            $stock = DustManagerStock::where('manager_id', $request->manager_id)->where('product_id', $request->product_id)->first();
            if ($stock && $stock->quantity >= $request->quantity) {
                $request->status = 'accepted';
                $request->save();
                $stock->quantity -= $request->quantity;
                $stock->save();

                $exist = DustManStock::where('keeper_id', $request->keeper_id)->where('product_id', $request->product_id)->first();
                if ($exist) {
                    $exist->quantity += $request->quantity;
                    $exist->save();
                } else {
                    DustManStock::create([
                        'product_id' => $request->product_id,
                        'keeper_id'  => $request->keeper_id,
                        'quantity'   => $request->quantity,
                    ]);
                }

                $msg = 'Accepted';
            } else {
                $msg = 'Not enough stock';
            }
        } else {
            $request->status = 'rejected';
            $request->save();
            $msg = 'Rejected';
        }
        return [
            'msg'               => $msg,
            'manager_stock'     => DustManagerStock::getStock($ch_id),
            'employee_requests' => DustManStockRequest::getRequestsForManager($ch_id),
        ];
    }
    public function PhoneSellerBuyProduct () {
        $ch_id = request('ch_id');
        $company_id = request('company_id');
        $quantity = request('quantity');
        $pro_id = request('pro_id');

        $object = PreObject::find($pro_id);
        $company = Company::find($company_id);
        $owner = Character::find($ch_id);
        $total = $object->price * $quantity;

        if ($company->capital >= $total) {
            $company->capital -= $total;
            $company->save();

            FinanceReport::addUpdate([
                'character_id' => $ch_id,
                'job_id'       => $owner->job,
                'client_id'    => 0,
                'revenue'      => 0,
                'expense'      => $total,
            ]);

            $exist = PhoneMangerStock::where('product_id', $pro_id)->where('manager_id', $ch_id)->first();
            if ($exist) {
                $exist->quantity += $quantity;
                $exist->save();
            } else {
                PhoneMangerStock::create([
                    'product_id' => $pro_id,
                    'manager_id' => $ch_id,
                    'quantity'   => $quantity,
                ]);
            }
            $msg = 'Brought successfully';
        } else {
            $msg = 'Your Company account dont have enough cash';
        }

        return [
            'msg'            => $msg,
            'manager_stock'  => PhoneMangerStock::getStock($ch_id),
            'company'        => $company,
            'finance_report' => FinanceReport::getReportData($ch_id),
        ];
    }
    
    public function phoneSellerRequestAction () {
        $request_id = request('request_id');
        $action = request('action');
        $id = request('job_id');
        $ch_id = request('ch_id');
        $request = PhoneSellerRequest::find($request_id);
        $ch_id = $request->manager_id;
        $stock  = PostObject::getAllWithStockPhoneSeller($id, $ch_id); 
        
        if ($action == 'accept') {
            // $stock = PhoneMangerStock::where('manager_id', $request->manager_id)->where('product_id', $request->product_id)->first();
           
            if ($stock && $stock[0]->stock >= $request->quantity) {
                $request->status = 'accepted';
                $request->save();
                // $stock->quantity = $request->quantity;
                // $stock->save();
                $exist = PhoneKeeperStock::where('keeper_id', $request->keeper_id)->where('product_id', $request->product_id)->first();
                if ($exist) {
                    $exist->quantity += $request->quantity;
                    $exist->save();
                } else {
                    PhoneKeeperStock::create([
                        'product_id' => $request->product_id,
                        'keeper_id'  => $request->keeper_id,
                        'quantity'   => $request->quantity,
                        
                    ]);
                }
                $msg = 'Accepted';
            } else {
                $msg = 'Not enough stock';
            }
        } else {
            $request->status = 'rejected';
            $request->save();
            $msg = 'Rejected';
        }
        return [
            'msg'               => $msg,
            'manager_stock'     => PhoneMangerStock::getStock($ch_id),
            'employee_requests' => PhoneSellerRequest::getRequestsForManager($ch_id),
        ];
    }

    public function saveCompanyCharges () {
        $company_id = request('company_id');
        $charges = request('charges');
        Company::where('id', $company_id)->update([
            'charges' => $charges
        ]);
    }
    public function saveCompanyCredits () {
        $company_id = request('company_id');
        $credits = request('credits');
        Company::where('id', $company_id)->update([
            'credits' => $credits
        ]);
    }
    public function removeCompanyCredits () {
        $company_id = request('company_id');
        $credits = request('credits');
        Company::where('id', $company_id)->update([
            'credits' => $credits
        ]);
    }
    public function saveItemCreditSubscription () {
        $qunty =  request('subscriptionQnty');
        Character::where('id', request('ch_id'))->where('job', request('job_id'))->update([
            'item_credit_quantity' => $qunty
        ]);
    }
    public function saveCompanyCreditSubscription () {
        
        $subscriptionCredit = request('subscriptionCredit');
        $subscriptionQnty = request('subscriptionQnty');
        CreditSubscription::create([
            'character_id' => request('ch_id'),
            'job_id'  => request('job_id'),
            'credits_subscription' => request('subscriptionCredit'),
            'subscription_quantity'   => request('subscriptionQnty'),
        ]);

        return [
            'msg'               => 'Request Created',
            'subscription_plan' => CreditSubscription::where('character_id', request('ch_id'))->where('job_id', request('job_id'))->get(),
        ];

    }
    public function buyCreditSubscription () {
        
        $subscriptionCredit = request('subscriptionCredit');
        $subscriptionQnty = request('subscriptionQnty');
        BuySubscriptionPlan::create([
            'keeper_id' => request('user_id'),
            'character_id' => request('ch_id'),
            'job_id'  => request('job_id'),
            'credits_subscription' => request('subscriptionCredit'),
            'subscription_quantity'   => request('subscriptionQnty'),
        ]);
 
        return [
            'msg'               => 'Request Created',
            // 'subscription_plan_buyer' => BuySubscriptionPlan::getBuyerSub($ch_id,$id)
        ];

    }
    
    public function dustmanThrowObject () {
        $id = request('id');
        $ch_id = request('ch_id');
        DustManStock::where('id', $id)->delete();

        return [
            'tools' => DustManStock::getStock($ch_id),
        ];
    }

    public function createDustmanItemRequest () {

        DustManStockRequest::create([
            'manager_id' => request('manager_id'),
            'keeper_id'  => request('ch_id'),
            'product_id' => request('product_id'),
            'quantity'   => request('quantity'),
            'status'     => 'pending'
        ]);

        return [
            'msg'               => 'Request Created',
            'employee_requests' => DustManStockRequest::getRequestsForKeeper(request('ch_id')),
        ];
    }

    public function createPhoneSellerItemRequest () { 

        PhoneSellerRequest::create([
            'manager_id' => request('manager_id'),
            'keeper_id'  => request('ch_id'),
            'product_id' => request('product_id'),
            'quantity'   => request('quantity'),
            'status'     => 'pending'
        ]);

        return [
            'msg'               => 'Request Created',
            'employee_requests' => PhoneSellerRequest::getRequestsForKeeper(request('ch_id')),
        ];
    }

    public function getDustManJobDetailsForVisitor () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $owner = Character::find($ch_id);
        $visitor = auth()->user()->character;
        
        $companyInfo = DB::table('company_employees')
                         ->select('company_id')
                         ->where('company_employees.employee_id', $ch_id)
                         ->latest()
                         ->first();
        if ($companyInfo) {
            $company = Company::find($companyInfo->company_id);
            return [
                'owner'    => $owner,
                'job'      => $job,
                'doer'     => 3,
                'company'  => $company,
                'requests' => TrashCleanRequests::getRequestsForVisitor($visitor->id, $company->id),
            ];
        }
    }

    public function saveTrashCleanRequest () {
        $dustman_id = request('ch_id');
        $dustman = Character::find($dustman_id);
        $company_id = request('company_id');
        $company = Company::find($company_id);
        $manager = $company->owner;
        $visitor = auth()->user()->character;
        $job_id = $dustman->job;
        $indication = IndicationBar::getBar('trash', 'habitation');
        $habitation_id = CharacterHabitation::where('character_id',auth()->user()->character->id)->first()->id;
        $h_indication = HabitationIndication::getBar($habitation_id, $indication->id);
        $employee_info = CompanyEmployee::where('employee_id', $dustman_id)->where('company_id', $company_id)->latest()->first();
        
        if ($h_indication) {

            $total = $h_indication->points * $company->charges;
            if ($visitor->cash >= $total) {

                TrashCleanRequests::create([
                    'company_id'    => $company_id,
                    'dust_man'      => $dustman_id,
                    'requested_by'  => $visitor->id,
                    'habitation_id' => $habitation_id,
                    'indication_id' => $h_indication ? $h_indication->id : 0,
                    'trash_points'  => $h_indication ? $h_indication->points : 0,
                    'total'         => $total,
                    'status'        => 'pending'
                ]);


                $visitor->cash -= $total;
                $visitor->save();

                $commission = $total * ($employee_info->commission / 100);
                $earning = $total - $commission;

                $company->capital += $earning;
                $company->save();
                $dustman->cash += $commission;
                $dustman->save();

                FinanceReport::addUpdate([
                    'character_id' => $dustman_id,
                    'client_id'    => $visitor->id,
                    'revenue'      => $total,
                    'expense'      => 0,
                    'commission'   => $commission,
                    'job_id'       => $job_id,
                ]);

                FinanceReport::addUpdate([
                    'character_id' => $manager->id,
                    'client_id'    => $visitor->id,
                    'revenue'      => $total,
                    'expense'      => 0,
                    'commission'   => $commission,
                    'job_id'       => $job_id,
                ]);

                return 'Request Saved';
            } else {
                return 'Your Dont have enough cash to request';
            }
        }
    }

    public function cleanTrash () {
        $id = request('id');

        $request = TrashCleanRequests::find($id);
        $request->status = 'close';
        $request->save();
        $indication = HabitationIndication::find($request->indication_id);
        $indication->points -= $request->points;
        $indication->points = $indication->points < 0 ? 0 : $indication->points;
        $indication->save();
    }

    public function getFactoryJobDetails () {
        $id = request('job_id');
        $ch_id = request('ch_id');
        $job = Job::find($id);
        $farmer = Character::where('job', $id)->where('id', $ch_id)->first();
        $is_doer = $farmer ? true : false;
        $animals = PreObject::getObjects($id);
        $products = PostObject::getAll('produced_by', $id);
        $stock = FactoryProduct::stock($ch_id);
//        dd($stock->toArray());
        $inProduction = FactoryProduct::InProcess($ch_id);
       
        return [
            'job'                => $job,
            'is_doer'            => $is_doer,
            'animals'            => $animals,
            'products'           => $products,
            'farmer_animals'     => FactoryAnimal::getAll($ch_id),
            'farmer'             => $farmer,
            'current_production' => $inProduction,
            'finance_report'     => FinanceReport::getReportData($ch_id),
            'stock'              => $stock,
            'delivery_companies' => Character::selectRaw('CONCAT(first_name," ",last_name) as text')
                                             ->selectRaw('CONCAT(characters.id ,"-", IFNULL((SELECT price FROM delivery_charges WHERE character_id = characters.id LIMIT 1),0) ) as value')
                                             ->whereRaw("job = (SELECT id FROM job_and_diplomas_jobs WHERE job_name like '%delivery%' LIMIT 1)")
                                             ->get(),
        ];
    }

    public function getFactoryJobDetailsForVisitor () {
        $id = request('job_id');
        $farmer_id = request('farmer');
        $job = Job::find($id);
        $farmer = Character::where('id', $farmer_id)->first();

        return [
            'job'            => $job,
            'farmer'         => $farmer,
            'farmer_animals' => FactoryAnimal::getAll($farmer_id),
        ];
    }

    public function buyFactoryAnimal () {

        $object = PreObject::find(request('id'));
        $character = Character::find(request('farmer'));
        $total = $object->price * request('qty');

        if ($character->cash >= $total) {
            DB::table('factory_animals')->insert([
                'factory_id' => request('farmer'),
                'animal_id' => request('id'),
                'quantity'  => request('qty'),
            ]);
            FinanceReport::addUpdate([
                'character_id' => request('farmer'),
                'job_id'       => $character->job,
                'client_id'    => 0,
                'revenue'      => 0,
                'expense'      => $total,
            ]);
            $character->cash -= $total;
            $character->save();
            $msg = 'Brought successfully';
        } else {
            $msg = "You dont have enough money of buy";
        }

        return [
            'farmer_animals' => FactoryAnimal::getAll(request('farmer')),
            'msg'            => $msg
        ];
    }

    public function startProductionFactory () {
        $input = request()->all();
        $product = PostObject::findOneFactory($input['product'], request('farmer'));
        $possible = $product->quantity * $product->stock;
        if ($possible >= $input['quantity']) {
            FactoryProduct::create([
                'factory_id'  => $input['farmer'],
                'product_id' => $input['product'],
                'quantity'   => $input['quantity'],
            ]);
            $unit = $product->quantity;
            $qty = $input['quantity'] / $unit;
            DB::table('factory_animals')->insert([
                'factory_id' => $input['farmer'],
                'animal_id' => $product->animal,
                'quantity'  => -$qty,
            ]);
            $msg = 'Production Started successfully';
        } else {
            $msg = 'Not enough components';
        }

        $inProduction = FactoryProduct::InProcess($input['farmer']);

        return [
            'msg'                => $msg,
            'current_production' => $inProduction,
            'farmer_animals'     => FactoryAnimal::getAll(request('farmer')),
        ];
    }

    public function completeProductionFactory () {
        $row = FactoryProduct::find(request('stock_id'));
        $row->in_production = 0;
        $row->save();
        $ch_id = $row->farmer_id;
        $inProduction = FactoryProduct::InProcess($ch_id);
        $stock = FactoryProduct::stock($ch_id);
        return [
            'current_production' => $inProduction,
            'stock'              => $stock,
        ];
    }

    public function FactorySendProduct () {
        $character = Character::find(request('factory_id'));
        $chargers = DeliveryCharges::getCharges(request('delivery_id'));
        $product = PostObject::getWithStockForFactory(request('product_id'), request('factory_id'));
        if ($character->cash >= $chargers) {
            if ($product->stock >= request('quantity')) {
               $a = FactoryOrders::addUpdate(request()->all());
                $character->cash -= $chargers;
                $character->save();
                FinanceReport::addUpdate([
                    'character_id' => $character->id,
                    'job_id'       => $character->job,
                    'client_id'    => request('delivery_id'),
                    'expense'      => $chargers,
                    'revenue'      => 0,
                ]);

                return ['status' => 'ok', 'msg' => 'Offer saved successfully and charges cut from your cash. If offer reject your cash will be recovered.'];
            }
            return ['status' => 'error', 'msg' => 'You dont have enough stock to send.'];
        }
        return ['status' => 'error', 'msg' => 'You dont have enough cash to pay charges'];
    }

}
