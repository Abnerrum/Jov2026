<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionarioController extends Controller
{
    public function index()
{
    return view('questionario');
}

public function store(Request $request)
{
}
}
