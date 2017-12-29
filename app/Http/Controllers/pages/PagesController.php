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
      $url = explode('/', 'https://coviweb.s3.amazonaws.com/images/accounts_logos/1712291514582636Q1nczks2RD.jpg');
      $root = explode('/', Storage::url('/'));
      return $url[2].'<br>'.$root[2];
    }
}
