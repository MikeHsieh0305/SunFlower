<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QrCodeController extends Controller
{
    const data = 'https://bookshoppingmall.tk/';
    public function index()
    {
        session();
        
      return view('qrcode',['data' => self::data]);
    }
}
