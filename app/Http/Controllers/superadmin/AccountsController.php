<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Classes\ImageUploader;

class AccountsController extends Controller
{
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
          'note' => $request->input('note')
        ]);

        if ($request->avatar)
        {
          $uploader = new ImageUploader($request->avatar, $account, 'avatar', 's3', 'images/accounts/logos/');
          $uploader->store('avatar', 200);
        }
        else
        {
          $account->update([
            'avatar' => url('/images/accounts_logos/imagen-no-disponible.png'),
          ]);
        }


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
      $account = Account::find($id);
      return $account;
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
        'note' => $request->note
      ]);

      if ($request->avatar)
      {
        $uploader = new ImageUploader($request->avatar, $account, 'avatar', 's3', 'images/accounts/logos/');
        $uploader->removeOld();
        $uploader->store('avatar', 200);
      }
      else
      {
        $account->update([
          'avatar' => url('/images/accounts_logos/imagen-no-disponible.png'),
        ]);
      }

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

        $accountAvatar = $account->avatar;
        $accountAvatar = explode('.com/', $accountAvatar);
        Storage::disk('s3')->delete($accountAvatar[1]);

        $account->delete();

        return ['message' => 'La cuenta de '.$account->name.' ha sido eliminada.'];
    }
}
