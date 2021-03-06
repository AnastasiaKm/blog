<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Logic\User\CaptureIp;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'first_name', 'last_name', 'email', 'avatar', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // REGISTRATION VALIDATION RULES
    public static $rules = [
        'name'                          => 'required',
        'first_name'                    => 'required',
        'last_name'                     => 'required',
        'email'                         => 'required|email|unique:users',
        'password'                      => 'required|min:6|max:20',
        'password_confirmation'         => 'required|same:password',
        'g-recaptcha-response'          => 'required'
    ];

    // REGISTRATION ERROR MESSAGES
    public static $messages = [
        'name.required'                 => 'Username is required',
        'first_name.required'           => 'First Name is required',
        'last_name.required'            => 'Last Name is required',
        'email.required'                => 'Email is required',
        'email.email'                   => 'Email is invalid',
        'password.required'             => 'Password is required',
        'password.min'                  => 'Password needs to have at least 6 characters',
        'password.max'                  => 'Password maximum length is 20 characters',
        'g-recaptcha-response.required' => 'Captcha is required'
    ];

    // ACCOUNT EMAIL ACTIVATION
    public function accountIsActive($code) {

        // CHECK IF ACTIVATION CODE MATCHES THE ONE WE SENT
        $user = User::where('activation_code', '=', $code)->first();

        // GET IP ADDRESS
        $userIpAddress                          = new CaptureIp;
        $user->signup_confirmation_ip_address   = $userIpAddress->getClientIp();

        // SET THE USER TO ACTIVE
        $user->active                           = 1;

        // CLEAR THE ACTIVATION CODE
        $user->activation_code                  = '';

        // SAVE THE USER
        if($user->save()) {
            \Auth::login($user);
        }
        return true;
    }

    // USER ROLES
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }

        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    // SOCIAL MEDIA AUTH
    public function social()
    {
        return $this->hasMany('App\Models\Social');
    }

    // USER PROFILES
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
    public function profiles()
    {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function hasProfile($name)
    {
        foreach($this->profiles as $profile)
        {
            if($profile->name == $name) return true;
        }

        return false;
    }

    public function assignProfile($profile)
    {
        return $this->profiles()->attach($profile);
    }

    public function removeProfile($profile)
    {
        return $this->profiles()->detach($profile);
    }

    public function posts()
    {
      return $this->hasMany('App\Models\Post');
    }

    public function comments()
    {
      return $this->hasMany('App\Models\Comment');
    }

    public function statuses()
    {
      return $this->hasMany('App\Status')->latest();
    }

    public function follows()
    {
      return $this->belongsToMany(self::class, 'follows', 'follower_id', 'followed_id')
                  ->withTimestamps();
    }

    public function followers()
    {
      return $this->belongsToMany(self::class, 'follows', 'followed_id', 'follower_id')
                  ->withTimestamps();
    }


    public function isFollowedBy(User $otherUser)
    {
      $idsWhoOtherUserFollows = $otherUser->follows()->lists('followed_id');
      foreach ($idsWhoOtherUserFollows as $idsWhoOtherUserFollow)
      {
        if ($this->id == $idsWhoOtherUserFollow)
        {
          return true;
        }
      }
    }

    public function statusComments()
    {
      return $this->hasMany('App\StatusComment');
    }



}
