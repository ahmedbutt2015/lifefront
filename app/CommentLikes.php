<?php

namespace App;

use App\Http\Helpers\Crud;
use Illuminate\Database\Eloquent\Model;

class CommentLikes extends Model
{
    use Crud;
    protected $guarded = [];

    protected $primaryKey = 'id';
    protected $insert = ['comment_id','liked_by'];

    protected $casts = [
        'created_at' => 'date:d/m/Y'
    ];
}
