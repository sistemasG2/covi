<?php

namespace App\Http\Controllers\pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Classes\ImageUploaderS3;
use App\Account;

class PagesController extends Controller
{
    public function home()
    {
      // $url = Storage::url('images');
      // $url = explode('.com', $url);
      // return view('pages.home', [
      //   'url' => $url[1]
      // ]);

      // $account = Account::find(5);
      // $uploader = new ImageUploaderS3($account);
      // $uploader->changeName();

      return Storage::url('images/accounts_logos/2017-12-27/1712271514407902lncsguoosotac.jpg');
    }
}
