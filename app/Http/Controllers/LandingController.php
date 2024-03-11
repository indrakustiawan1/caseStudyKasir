<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    function hitungKembalian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total_belanja' => 'required',
            'jumlah_uang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error'  => $validator->errors()->toArray()
            ]);
        }
        $totalBelanja = $request->total_belanja;
        $jumlahUang = $request->jumlah_uang;

        $kembalian = $jumlahUang - $totalBelanja;

        return response()->json([
            'kembalian' => $kembalian,
            'status' => true
        ], 200);
    }
}
