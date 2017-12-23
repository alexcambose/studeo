<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public static $rules = [
        'content' => 'required|string|max:120',
    ];
    protected $appends = [
        '_answers',
    ];

    public function getAnswersAttribute() {
        return Answer::where('question_id', $this->id)->get();
    }
}
