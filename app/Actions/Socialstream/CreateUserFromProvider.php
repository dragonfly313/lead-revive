<?php

namespace App\Actions\Socialstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use JoelButcher\Socialstream\Contracts\CreatesUserFromProvider;
use Laravel\Socialite\Contracts\User as ProviderUserContract;

class CreateUserFromProvider implements CreatesUserFromProvider
{
    /**
     * Create a new user from a social provider user.
     *
     * @param  string  $provider
     * @param  \Laravel\Socialite\Contracts\User  $providerUser
     * @return \App\Models\User
     */
    public function create(string $provider, ProviderUserContract $providerUser)
    {
        return DB::transaction(function () use ($providerUser) {
            
            return tap(User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
            ]), function (User $user) {
                $user->markEmailAsVerified();

                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
