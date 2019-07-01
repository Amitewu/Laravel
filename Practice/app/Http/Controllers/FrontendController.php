<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontendController extends Controller
{
  function contact(){
  	return view('contact');
  }

  function about(){
  	return view('about');
  }

  function root(){
  	$products= Product::all();
  	return view('welcome',compact('products'));
  }

 
}
