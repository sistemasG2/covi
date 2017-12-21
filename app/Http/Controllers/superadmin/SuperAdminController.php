<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function index()
    {
      return view('superadmin.dashboard',[
        'user' => $this->user
      ]);
    }

    public function accounts()
    {
      return view('superadmin.accounts');
    }

    public function profile()
    {
      return view('superadmin.profile',[
        'user' => $this->user
      ]);
    }

    public function reports()
    {
      return view('superadmin.reports',[
        'user' => $this->user
      ]);
    }

    public function signOut()
    {
      return view('superadmin.signOut',[
        'user' => $this->user
      ]);
    }

    public function support()
    {
      return view('superadmin.support',[
        'user' => $this->user
      ]);
    }

    public function users()
    {
      return view('superadmin.users',[
        'user' => $this->user
      ]);
    }
}
