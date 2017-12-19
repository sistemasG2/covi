<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Support\Facades\Storage;

class AccountsController extends Controller
{
    protected $user = [
      'name' => 'Eduardo',
      'lastname' => 'Alfaro',
      'email' => 'mail@mail.com',
      'username' => 'noson',
      'avatar' => 'https://randomuser.me/api/portraits/men/12.jpg'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $accounts = Account::select('id', 'name', 'company', 'key', 'note', 'type', 'avatar')->orderBy('name', 'asc')->get();

      return $accounts;
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
          'name' => 'required|max:20|unique:accounts',
          'company' => 'required|max:20',
          'key' => 'required|max:16|unique:accounts',
          'type' => 'required',
          'note' => 'max:255'
        ], [
          'name.required' => 'El campo nombre es obligatorio.',
          'name.max' => 'El nombre no debe tener más de 20 caracteres.',
          'name.unique' => 'Ya existe una cuenta con este nombre.',
          'company.required' => 'El campo empresa es obligatorio.',
          'name.max' => 'La empresa no debe tener más de 20 caracteres.',
          'key.required' => 'El campo clave es obligatorio.',
          'key.max' => 'La clave no debe ser de más de 16 caracteres.',
          'key.unique' => 'Ya hay una clave de cuenta igual.',
          'type.required' => 'El campo tipo de cuenta es obligatorio.',
          'note.max' => 'Las notas no debe superar 255 caracteres.'
        ]);

        $account = Account::create([
          'name' => $request->input('name'),
          'company' => $request->input('company'),
          'key' => $request->input('key'),
          'type' => $request->input('type'),
          'avatar' => 'http://via.placeholder.com/300x300',
          'note' => $request->input('note')
        ]);

        return ['message' => 'Se ha creado la cuenta exitosamente!'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

      $account = Account::find($id);

      if ($account->key != $request->key) {
        $request->validate([
          'key' => 'unique:accounts'
        ], [
          'key.unique' => 'Ya hay una clave de cuenta igual.'
        ]);
      }

      if ($account->name != $request->name) {
        $request->validate([
          'name' => 'unique:accounts'
        ], [
          'name.unique' => 'Ya existe una cuenta con este nombre.'
        ]);
      }

      $request->validate([
        'name' => 'required|max:20',
        'company' => 'required|max:20',
        'key' => 'required|max:16',
        'type' => 'required',
        'note' => 'max:255'
      ], [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.max' => 'El nombre no debe tener más de 20 caracteres.',
        'company.required' => 'El campo empresa es obligatorio.',
        'name.max' => 'La empresa no debe tener más de 20 caracteres.',
        'key.required' => 'El campo clave es obligatorio.',
        'key.max' => 'La clave no debe ser de más de 16 caracteres.',
        'type.required' => 'El campo tipo de cuenta es obligatorio.',
        'note.max' => 'Las notas no debe superar 255 caracteres.'
      ]);

      $account->update([
        'name' => $request->name,
        'company' => $request->company,
        'key' => $request->key,
        'type' => $request->type,
        'avatar' => 'http://via.placeholder.com/300x300',
        'note' => $request->note
      ]);

      return ['message' => 'La cuenta de '.$request->name.' ha sido actualizada.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        $account->delete();

        return ['message' => 'La cuenta de '.$account->name.' ha sido eliminada.'];
    }
}
