<?php

use Metin\Services\AccountService;
use Metin\Services\Forms\Login;

class SessionsController extends BaseController {

    /**
     * @var Metin\Services\AccountService
     */
    protected $account;
    /**
     * @var Metin\Services\Forms\Login
     */
    protected $loginForm;

    public function __construct(AccountService $account, Login $loginForm)
    {
        $this->account = $account;
        $this->loginForm = $loginForm;
    }

    public function index()
    {
        $view = View::make('site.auth.index');

        return $view;
    }

    public function doAuth()
    {
        $input = Input::only('username', 'password');

        $this->loginForm->validate($input);

        try
        {
            $this->account->authenticate($input);
            return Redirect::route('account.index');
        }
        catch (Exception $e)
        {
            return Redirect::back()->withInput()->withErrors(array(
                'credentials' => 'Username or password is incorrect.'
            ));
        }
    }
}