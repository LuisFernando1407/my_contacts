<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'id', 'contact_id', 'description'
    ];

    public function contact(){
        return $this->belongsTo(Contact::class);
    }
}