<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;

class TestController extends Controller
{
  public function index()
  {
    $data = "Here is my data.";

    return Response::json(['data' => $data]);
  }

  public function store(Request $request)
  {
    $rules = [
      'name' => 'required',
      'age' => 'required'
    ];

    $validator = Validator::make(purifier::clean($request->all()), $rules);

    $name = $request->input('name');
    $age = $request->input('age');
    $home = $request->input('home');
    $sign = $request->input('sign');

    if(!is_numeric($age)) {
      return Response::json(['error' => 'Please enter a number for your age.']);
    }

    if($validator->fails())
    {
      return Response::json(['error' => 'Please fill out all fields.']);
    }



    $sentence = "Hi! My name is " . $name . " and I am " . $age . " years old. I live in " . $home . " and my sign is: " . $sign . ".";

    return Response::json(['sentence' => $sentence]);
  }
}
