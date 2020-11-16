<?php
/**
 * Created by PhpStorm.
 * User: arturchilingaryan
 * Date: 11/17/20
 * Time: 01:32
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class AuthController extends Controller
{
    private $redirectTo = '/cabinet';

    public function loginPage()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        try {
            if($user = Auth::attempt($request->only('email', 'password'))){
                return redirect()->to($this->redirectTo)->with('success', 'Ողջույն 🙂');
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', 'Չստացվեց!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/auth');
    }
}