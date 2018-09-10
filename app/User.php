<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Socialite\Two\User as BaseUser;
use App\Traits\B2UserTrait;
use B2Systems\B2\B2;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, B2UserTrait, HasApiTokens, HasRoles;

    /**
     * Whether or not the database ID is incrementing.
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'token', 'refresh_token', 'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the authentication identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifier()
    {
        return $this->token;
    }

    /**
     * Retrieve the users organisations and schools from the B2 API and then cache
     *
     * @return array
     */
    public function organisationsWithSchools()
    {
        $organisations = Cache::remember("user-$this->id-organisationsWithSchool", 5, function () {
            $b2 = resolve(B2::class);
            $organisations = $b2->organisations([
                'query' => [
                    'with' => ['schools'],
                    'limit' => 10000
                ]
            ]);
            return json_encode($organisations);
        });

        return json_decode($organisations);
    }

    /**
     * Sort through all the organisations and just return the schools.
     *
     * @return array
     */
    public function schools()
    {
        $schools = [];
        foreach ($this->organisationsWithSchools() as $key => $organisation) {
            foreach ($organisation->schools as $key => $school) {
                $schools[] = $school;
            }
        }
        return $schools;
    }

    /**
     * Retrieve all of the school ids that the user has access to.
     *
     * @return array
     */
    public function schoolIds()
    {
        $ids = [];
        foreach ($this->schools() as $key => $school) {
            $ids[] = $school->id;
        }
        return $ids;
    }

    /**
     * Check if the specific resource is the users organisation.
     *
     * @param string $model_name The name of the resource type.
     * @param Model $model The model the user is trying to access.
     * @return boolean
     */
    public function hasAccessTo($model = '')
    {
        if (!empty($model) && !empty(get_class($model))) {
            $model_name = get_class($model);
            $model_school_id = null;

            if ($model_name === 'App\Building' ||
                $model_name === 'App\Room' ||
                $model_name === 'App\Item'
            ) {
                $model_school_id = $model->school_id;
            }
            return in_array($model_school_id, $this->schoolIds());
        }
        return false;
    }
}
