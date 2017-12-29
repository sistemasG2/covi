<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Classes\ImageUploader;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::all()->load('account');
        $users = User::with(['account' => function($query) {
          $query->select('id', 'name');
        }])->get();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required|max:30|',
          'lastname' => 'required|max:30',
          'username' => 'required|max:16|unique:users',
          'email' => 'email|max:50',
          'password' => 'min:6|confirmed',
          'role_id' => 'required',
          'account_id' => 'required'
        ], [
          'name.required' => 'El campo nombre es obligatorio.',
          'name.max' => 'El nombre no debe exceder lols 30 caracteres.',
          'lastname.required' => 'El campo apellidos es obligatorio.',
          'lastname.max' => 'Los apellidos no deben exceder los 30 caracteres.',
          'username.required' => 'El campo nombre usuario es requerido.',
          'username.max' => 'El nombre de usuario no debe exceder los 16 caracteres.',
          'email.email' => 'Ingresa un correo electronico valido.',
          'email.max' => 'El email no debe exceder los 50 caracteres.',
          'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
          'password.confirmed' => 'La contraseña debe coincidir.',
          'role_id.required' => 'El campo rol es requerido.',
          'account_id.required' => 'El campo cuenta es requerido.'
        ]);

        $user = User::create([
          'name' => $request->name,
          'lastname' => $request->lastname,
          'username' => $request->username,
          'email' => $request->email,
          'account_id' => $request->account_id,
          'role_id' => $request->role_id,
          'password' => bcrypt($request->password),
        ]);

        if ($request->avatar)
        {
          $uploader = new ImageUploader($request->avatar, $user,'avatar', 's3', 'images/users/avatars/');
          $uploader->store('avatar', 200);
        }
        else
        {
          $account->update([
            'avatar' => url('/images/accounts_logos/imagen-no-disponible.png'),
          ]);
        }

        return ['message' => 'El usuario @'. $user->username .' ha sido creado.'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->username != $user->username) {
          $request->validate([
            'username' => 'required|max:16|unique:users',
          ], [
            'username.require' => 'EL campo nombre de usuario es requerido.',
            'username.max' => 'El nombre de usuario no debe tener más de 16 caracteres',
            'username.unique' => 'Ya existe un usuario con este nombre de usuario.'
          ]);
        }

        $request->validate([
          'name' => 'required|max:30|',
          'lastname' => 'required|max:30',
          'email' => 'email|max:50',
          'role_id' => 'required',
          'account_id' => 'required'
        ], [
          'name.required' => 'El campo nombre es obligatorio.',
          'name.max' => 'El nombre no debe exceder lols 30 caracteres.',
          'lastname.required' => 'El campo apellidos es obligatorio.',
          'lastname.max' => 'Los apellidos no deben exceder los 30 caracteres.',
          'email.email' => 'Ingresa un correo electronico valido.',
          'email.max' => 'El email no debe exceder los 50 caracteres.',
          'role_id' => 'El campo rol es requerido.',
          'account_id.required' => 'El campo cuenta es requerido.'
        ]);

        $user->update([
          'name' => $request->name,
          'lastname' => $request->lastname,
          'username' => $request->username,
          'email' => $request->email,
          'account_id' => $request->account_id,
          'role_id' => $request->role_id,
        ]);

        if ($request->avatar)
        {
          $uploader = new ImageUploader($request->avatar, $user,'avatar', 's3', 'images/users/avatars/');
          $uploader->removeOld();
          $uploader->store('avatar', 200);
        }
        else
        {
          $account->update([
            'avatar' => url('/images/accounts_logos/imagen-no-disponible.png'),
          ]);
        }

        return ['message' => 'El Usuario @'. $user->username .' ha sido actualizado.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return ['message' => 'El Usuario ... ha sido eliminado.'];
    }
}
