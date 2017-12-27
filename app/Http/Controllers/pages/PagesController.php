<?php

namespace App\Http\Controllers\pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PagesController extends Controller
{
    public function home()
    {
      $url = Storage::url('images');
      $url = explode('.com', $url);
      return view('pages.home', [
        'url' => $url[1]
      ]);
    }
}
