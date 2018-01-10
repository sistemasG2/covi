<?php

namespace App\Http\Controllers\pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Classes\ImageUploaderS3;
use App\Account;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home()
    {
      return view('pages.home');
    }
}
