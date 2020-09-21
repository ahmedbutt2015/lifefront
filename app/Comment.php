<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use Crud;

    protected $guarded = [];

    protected $primaryKey = 'id';
    protected $insert = ['body', 'to', 'from', 'allow'];

    protected $casts = [
        'created_at' => 'datetime: d/m/Y \a\t H:i'
    ];

    public static function getCharacterComments ($ch_id) {
        return self::select('comments.*','characters.prefix','characters.address')
                   ->selectRaw('(SELECT CONCAT(first_name," ",last_name) FROM characters WHERE characters.id = comments.from ) AS from_name')
                   ->selectRaw('(SELECT COUNT(*) FROM comment_likes WHERE comment_id = comments.id) AS likes')
                   ->leftJoin('characters', 'characters.id', 'comments.from')
                   ->where('to', $ch_id)->get();
    }

    public static function addLike ($id) {

        $character = auth()->user()->character;
        if ($character) {
            $character_id = $character->id;
            $exist = CommentLikes::where('comment_id', $id)->where('liked_by', $character_id)->first();
            if ( !$exist) {
                $result = CommentLikes::addUpdate([
                    'comment_id' => $id,
                    'liked_by'   => $character_id,
                ]);
                if ($result) {
                    return true;
                }
            }
        }

        return false;
    }


}
