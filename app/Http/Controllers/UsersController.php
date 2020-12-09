<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Symfony\Component\Console\Input\Input;

class UsersController extends Controller
{

//    public function index()
//    {
//        $users = Users::query()->get();
//
//        return view('users/users', ['users' => $users]);
//    }

    public function index()
    {
//        $users = Users::query()->get();

        return view('users/users',
            ['users' => DB::table('users')->paginate(5)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        return View::make('users/userCreate');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|unique:users|max:255',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('users/create')
                ->withErrors($validator)
                ->withInput();
        }else{
            $user = new Users([
                'login' => $request->get('login'),
                'name' => $request->get('name'),
                'surname' => $request->get('surname'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
                ]);

        $user->save();

        return redirect('/users')->with('success', 'Пользователь добавлен!');

        }


    }

    public function show($id)
    {
        /**
         * @var Users|null $user
         */

        $user = Users::query()->findOrFail($id);

        return view('users/user', ['user'=>$user]);

    }


    public function edit($id)
    {

        $user = Users::query()->findOrFail($id);

        return view('users/userUpdate', ['user' => $user]);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|max:255',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('users/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            /**
             * @var Users|null $user
             */
            $user = Users::query()->findOrFail($id);
            $user->login = $request->get('login');
            $user->name = $request->get('name');
            $user->surname = $request->get('surname');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $user->save();
            return Redirect('/users');
        }



    }
    public function destroy($id)
    {


        /**
         * @var Users|null $user
         */

        $user = Users::query()->findOrFail($id);

        $user->delete();

        return view('users/userDelete', ['user'=>$user]);

    }
}
