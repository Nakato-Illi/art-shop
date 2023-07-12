<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = "Welcome to Maya's and Ricky's Art Shop";
        return  view('index')->with('title', $title);
    }
}
