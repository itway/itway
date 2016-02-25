<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 9/26/2015
 * Time: 7:23 PM
 */

namespace Itway\Commands;

use A6digital\Image\Facades\DefaultProfileImage;
use itway\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Auth;
use itway\Events\UserWasCreatedEvent;
use Itway\Models\User;
use App;

class CreateUserCommand extends Command implements SelfHandling
{
    public $name,
        $email,
        $photo,
        $provider,
        $provider_id,
        $password;


    /**
     * @param $name
     * @param $email
     * @param $photo
     * @param $provider
     * @param $provider_id
     * @param $password
     */
    public function __construct(
        $name,
        $email,
        $password = null,
        $photo,
        $provider = null,
        $provider_id = null
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->photo = $photo;
        $this->provider = $provider ? $provider : null;
        $this->provider_id = $provider_id ? $provider_id : null;
        $this->password = $password;
    }

    /**
     * @return static
     */
    public function handle()
    {
        if (!($this->photo
            && $this->provider
            && $this->provider_id)
        ) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'locale' => App::getLocale()
            ]);
            $user->makeDefaultUserImg($user);

        } else {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'provider' => $this->provider,
                'provider_id' => $this->provider_id,
                'password' => $this->password,
                'locale' => App::getLocale()
            ]);
        }

        if (!is_null($this->photo)) {
            $user->bindLogoFromURL($this->photo, $user);
        }
        event(new UserWasCreatedEvent($user));
        return $user;
    }
}
