<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http; 
use Illuminate\Http\Request;

class Ccobah extends Controller
{

    public function mhs()
    {
        $response = Http::get('https://pbp.stmikbanjarbaru.com/api/mhs');
    	$data = $response->json('data', []);
    	return view('cobah.mhs', compact('data'));
    }


    public function mhs3()
    {
            $response = Http::get('https://pbp.stmikbanjarbaru.com/api/mhs3', [
                'token' => '123456',
            ]);

            if ($response->successful()) {
                $data = $response->json();
            } else {
                $data = [];
            }

            return view('cobah.mhs3', compact('data'));
    }

    public function mh5()
    {
            $response = Http::withHeaders([
                'X-API-KEY' => '123456',
            ])->get('https://pbp.stmikbanjarbaru.com/api/mhs5');

            if ($response->successful()) {
                $data = $response->json();
            } else {
                $data = [];
            }

            return view('cobah.mhs5', compact('data'));
    }


    public function index()
    {
        $response = Http::get('https://pbp.stmikbanjarbaru.com/api/mhs');

        $json = $response->json();

        // Antisipasi: API bisa mengembalikan array langsung, atau dibungkus "data"
        $mahasiswa = $json['data'] ?? $json ?? [];

        return view('cobah.index', compact('mahasiswa'));
    }

    public function tambahdata()
    {
        return view('cobah.tambahdata');
    }

    // Proses menyimpan data melalui API
    public function simpandata(Request $request)
    {
        $response = Http::acceptJson()->post(
            'https://pbp.stmikbanjarbaru.com/api/mhs',
            [
                'nim' => $request->nim,
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'telpon' => $request->telpon,
                'prodi' => $request->prodi,
                'kelas' => $request->kelas,
            ]
        );
        dd($request->all(), $response->status(), $response->body());
        if ($response->successful()) {

            return redirect()
                ->route('cobah.index')
                ->with('success', 'Data mahasiswa berhasil ditambahkan');
        }

        return back()
            ->withInput()
            ->with(
                'error',
                $response->json('message', 'Gagal menyimpan data')
            );
    }


    public function update(Request $request, $id)
    {
            $mhs = Mmhs::where('nim', $id)->first();

            if (!$mhs) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'nim'           	=> 'sometimes|required|size:12|unique:mahasiswa,nim,' . $id . ',nim',
                'nama'          	=> 'sometimes|required|string|max:100',
                'jenis_kelamin' 	=> 'sometimes|required|string|max:1',
                'tanggal_lahir' 	=> 'sometimes|required|date',
                'telepon'      	=> 'sometimes|required|string|max:20',
                'prodi'         	=> 'sometimes|required|string|max:100',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  	=> 'error',
                    'message' 	=> 'Validasi gagal',
                    'errors'  	=> $validator->errors(),
                ], 422);
            }

        // Ambil hanya field yang dikirim & boleh diupdate
            $data = $request->only([
                'nim',
                'nama',
                'jenis_kelamin',
                'tanggal_lahir',
                'telepon',
                'prodi',
            ]);

            if (empty($data)) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Tidak ada data yang diupdate',
                ], 422);
            }

            $mhs->update($data);

            return response()->json([
                'status'  	=> 'success',
                'message' 	=> 'Data berhasil diupdate',
                'data'    	=> $mhs,
            ], 200);
    }

    
    public function patch(Request $request, $id)
    {
        $mhs = Mmhs::where('nim', $id)->first();

        if (!$mhs) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nim' => 'sometimes|required|size:12|unique:mahasiswa,nim,' . $mhs->nim . ',nim',
            'nama' => 'sometimes|required|string|max:100',
            'jenis_kelamin' => 'sometimes|required|string|max:1',
            'tanggal_lahir' => 'sometimes|required|date',
            'telepon' => 'sometimes|required|string|max:20',
            'prodi' => 'sometimes|required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->only([
            'nim',
            'nama',
            'jenis_kelamin',
            'tanggal_lahir',
            'telepon',
            'prodi',
        ]);

        if (empty($data)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada data yang diupdate',
            ], 422);
        }

        $mhs->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate',
            'data' => $mhs->fresh(),
        ], 200);
    }

    
    public function destroy($id)
    {
        $mhs = Mmhs::where('nim', $id)->first();

        if (!$mhs) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $mhs->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data mahasiswa berhasil dihapus',
            'data' => $mhs,
        ], 200);
    }



}