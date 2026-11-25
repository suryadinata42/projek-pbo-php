<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mumum;

class Cumum extends Controller
{
    public function tampil()
    {
        $data = Mumum::limit(100)->get();
        return view('Umum.tampil', compact('data'));
    }
}
