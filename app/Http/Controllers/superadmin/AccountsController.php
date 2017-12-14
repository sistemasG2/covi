<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;

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
      $accounts = Account::select('name', 'company', 'key', 'note', 'type', 'avatar')->get();

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
          'company.required' => 'El campo empresa es obligatorio.',
          'name.max' => 'La empresa no debe tener más de 20 caracteres.',
          'key.required' => 'El campo clave es obligatorio.',
          'key.max' => 'La clave no debe ser de más de 16 caracteres.',
          'type.required' => 'El campo tipo de cuenta es obligatorio.',
          'note.max' => 'Las notas no debe superar 255 caracteres.'
        ]);

        $account = Account::create([
          'name' => $request->input('name'),
          'company' => $request->input('company'),
          'key' => $request->input('key'),
          'type' => $request->input('type'),
          'avatar' => 'https://loremflickr.com/400/400/logo',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
