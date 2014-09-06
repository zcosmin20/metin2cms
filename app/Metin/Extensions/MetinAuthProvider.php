<?php

namespace Metin\Extensions;

use Illuminate\Auth\GenericUser;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;
use Metin\Entities\Account;
use DB;

class MetinAuthProvider implements UserProviderInterface{

    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function retrieveById($id)
    {
        $account = $this->account->find($id);

        if ( ! is_null($account))
        {
            return new GenericUser($account->toArray());
        }
    }

    public function retrieveByCredentials(array $credentials)
    {
        $account = $this->account->newInstance();

        foreach ($credentials as $key => $value)
		{
            if ($key == 'username')
            {
                $key = 'login';
            }

            if ( ! str_contains($key, 'password'))
            {
                $account = $account->where($key, $value);
            }
        }

       $user = $account->first();

		if ( ! is_null($user))
        {
            return new GenericUser($user->toArray());
        }
    }

    public function validateCredentials(UserInterface $user, array $credentials)
    {
        $credentials['password'] = mysqlHash($credentials['password']);

        return $user->getAuthPassword() == $credentials['password'];
    }

    public function retrieveByToken($identifier, $token)
    {
        return new \Exception('not implemented');
    }

    public function updateRememberToken(UserInterface $user, $token)
    {
        return new \Exception('not implemented');
    }

}