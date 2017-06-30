<?php

namespace App\Http\Controllers\Auth;

use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Http\Requests\Auth\ActivationRequest;
use Auth;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    /**
     * IUserRepo implementation
     *
     * @var IUserRepo
     */
    private $userRepo;

    /**
     * Create a new controller instance.
     *
     * @param IUserRepo $userRepo
     */
    public function __construct(IUserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Show user activation form
     *
     * @param $token
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($token)
    {
        if($this->exists($token)) {
            return view('auth.activate')->with([
                'token' => $token
            ]);
        }

        return $this->unAuthorized();
    }

    /**
     * Activate user
     *
     * @param ActivationRequest $request
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(ActivationRequest $request, $token)
    {
        if($this->exists($token)) {
            Auth::login($this->userRepo->activate($token, $request->password));

            return redirect('/dashboard')
                ->with('status', 'Welkom uw account is geactiveerd');
        }

        return $this->unAuthorized();
    }

    /**
     * Check if token exists
     *
     * @param $token
     * @return bool
     */
    public function exists($token)
    {
        return $this->userRepo->exists('confirmation_code', $token);
    }

    /**
     * Redirect with unauthorized message
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unAuthorized()
    {
        return redirect('/')
            ->with([
                'status' => 'Niet geautoriseerd!',
                'class' => 'is-danger'
            ]);
    }
}
