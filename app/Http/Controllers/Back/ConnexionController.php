<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConnexionController extends Controller
{
    function index() {
        return view('admin.connexion_admin');
    }
}