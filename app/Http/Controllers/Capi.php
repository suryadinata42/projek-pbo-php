<?php

namespace App\Http\Controllers;
use App\Models\Mbarang;
use App\Models\Mpembeli;
use App\Models\Msuplier;
use App\Models\Mpesanan;
use App\Models\Mpembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Capi extends Controller
{
    public function barang()
    {
        $data = Mbarang::get();
            return response()->json([
            'status'  => 'success',
                'message' => 'Daftar barang berhasil diambil',
                'data'    => $data,
            ], 200, [], JSON_PRETTY_PRINT);
    }

    public function barangsimpan(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'id_barang'=> 'required|string|max:6|unique:barang,id_barang',
            'nama'  => 'required|min:3|regex:/^[\pL\s]+$/u',
            'harga_beli'=> 'required|numeric|min:1000',
            'harga_jual' => 'required|numeric|min:1000', 
            'varian' => 'required',
	    ]);

    	if ($validator->fails()) {
        	return response()->json([
            	'status' 	=> 'error',
            	'message' 	=> 'Validasi gagal',
            	'errors' 	=> $validator->errors()
        	], 422, [], JSON_PRETTY_PRINT);
    	}

    	$data = Mbarang::create($request->all());

    	return response()->json([
        	'status' 	=> 'success',
        	'message' 	=> 'Data barang berhasil ditambahkan',
        	'data' 	=> $data
    	], 201, [], JSON_PRETTY_PRINT);

    	return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    public function barangsimpan2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_barang'  => 'required|string|max:6',
            'nama'       => 'required|min:3|regex:/^[\pL\s]+$/u',
            'varian'     => 'required|string',
            'harga_beli' => 'required|numeric|min:1000',
            'harga_jual' => 'required|numeric|min:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data gagal disimpan',
                'errors'  => $validator->errors()
            ], 422, [], JSON_PRETTY_PRINT);
        }

        $existing = Mbarang::where('id_barang', $request->id_barang)->first();

        if ($existing) {
            $existing->update($request->all());

            return response()->json([
                'status'  => 'success',
                'message' => 'Data barang berhasil diupdate',
                'data'    => $existing
            ], 200, [], JSON_PRETTY_PRINT);
        }

        $data = Mbarang::create($request->all());

        return response()->json([
            'status'  => 'success',
            'message' => 'Data barang berhasil ditambahkan',
            'data'    => $data
        ], 201, [], JSON_PRETTY_PRINT);
    }


    public function pembeli()
    {
        $data = Mpembeli::get();
        return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    public function suplier(Request $request)
    {
        $token = $request->query('token');
            $validToken = '123456';

            if (!$token || $token !== $validToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token tidak valid atau tidak ditemukan'
                ], 401, [], JSON_PRETTY_PRINT);
            }

            $data = Msuplier::get();
            return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }


    public function pesanan(Request $request)
    {
            $token = $request->bearerToken();
            $validToken = '123456';

            if (!$token || $token !== $validToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Token tidak valid atau tidak ditemukan'
                ], 401, [], JSON_PRETTY_PRINT);
            }

            $data = Mpesanan::get();
            return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }

    public function pembelian(Request $request)
    {
    	$apiKey = $request->header('X-API-KEY');
    	$validApiKey = '123456';

    	if (!$apiKey || $apiKey !== $validApiKey) {
        	return response()->json([
            	'status' => 'error',
            	'message' => 'API Key tidak valid atau tidak ditemukan'
        	], 401, [], JSON_PRETTY_PRINT);
    	}

    	$data = Mpembelian::get();
    	return response()->json($data, 200, [], JSON_PRETTY_PRINT);
    }




    


}
