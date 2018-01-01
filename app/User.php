<?php

namespace App;

use App\Notifications\AwardedXp;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules =  [
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:30',
        'username' => 'required|string|max:16|min:4',
        'nickname' => 'nullable|string|max:20',
        'description' => 'nullable|string|max:250',
        'school' => 'nullable|string',
        'school_level' => 'sometimes|numeric',
        'sex' => 'nullable|numeric',
        'phone' => 'nullable|numeric',
        'email' => 'required|string|email',
        'password' => 'required|string|max:16|min:6',
        'image' => 'required|image|mimes:jpeg,png,jpg',
        'city' => 'nullable|numeric',
        'is_teacher' => 'boolean',
    ];
    protected $appends = [
        '_image',
        '_avatar',
    ];
    public function getSocialAttribute($value) {
        return json_decode($value); // convert "{}" to {}
    }
    public function getImageAttribute() {
        return $this->image();
    }
    public function getAvatarAttribute() {
        $avatar = $this->avatars()->where('active', 1)->first(); // avatarul care este selectat
        if($avatar) return $avatar;
        // daca nu este selectat nici unul inseamna ca nu exista nici un avatar pentru user
        $this->avatars()->attach(Avatar::find('DEFAULT')->type, [ 'active' => 1 ]);
        return Avatar::find('DEFAULT');
    }
    //methods
    public function recommendations($maxAmount = 8) {
        return Recommendation::where('user_id', $this->id)
            ->orderBy('count', 'DESC') // cu cele mai multe categorii vizualizate
            ->get()
            ->take($maxAmount)
            ->map(function($e) {
                return Course::where('category', $e->category)->orderBy('views', 'DESC')->first(); // cursul cu cele mai multe vizualizari
            });
    }
    public function addXp($amount) {
        $this->increment('xp', $amount);
        $this->notify(new AwardedXp($amount)); // baga si notificare dupa ce adauga xp in db
    }
    // Relationships
    public function image() {
        // has one
        return Media::where('id', $this->image_id)->first();
    }
    public function courses() {
        return $this->hasMany(Course::class);
    }
    public function playlists() {
        return $this->hasMany(Playlist::class);
    }
    public function posts() {
        return $this->hasMany(Post::class);
    }
    public function postsLiked() {
        return $this->belongsToMany(Post::class, 'post_user_likes');
    }
    public function joinedLessons() {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }
    public function sharedCourses () {
        return $this->belongsToMany(Course::class,'course_user_shares')->withTimestamps()->withPivot('id');
    }
    public function achievements() {
        return $this->belongsToMany(Achievement::class)->withTimestamps();
    }
    public function avatars() {
        return $this->belongsToMany(Avatar::class)->withTimestamps();
    }
    public function joinedCourses() {
        return collect($this->joinedLessons->map(function($lesson){
            return $lesson->course;
        }));
    }
    public function logins() {
        return $this->hasMany(Logins::class);
    }
}
