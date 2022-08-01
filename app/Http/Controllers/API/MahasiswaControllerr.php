<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Validator;

class MahasiswaControllerr extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

     // menampilkan data mahasiswa 
     public function index()
     {
         $data = Mahasiswa ::latest()->get();
         return response([
             'success' => true,
             'message' => 'List Semua data mahasiswa',
             'data' => $data
         ], 200);
     }
 
     // cara menambahkan data 
     public function store(Request $request)
     {
         //validasi data
         $validator = Validator::make($request->all(), [
             'nama' => 'required',
             'nim' => 'required',
             'jurusan' => 'required',
             'jenis_kelamin' => 'required',
             'alamat' => 'required',
         ],
             [
                 'nama.required' => 'Masukkan nama !',
                 'nim.required' => 'Masukkan nim !',
                 'jurusan.required' => 'Masukkan jurusan !',
                 'jenis_kelamin.required' => 'Masukkan jenis kelamin !',
                 'alamat.required' => 'Masukkan alamat !',
             ]
         );
 
         if($validator->fails()) {
 
             return response()->json([
                 'success' => false,
                 'message' => 'Silahkan Isi Bidang Yang Kosong',
                 'data'    => $validator->errors()
             ],401);
 
         } else {
 
             $data = Mahasiswa ::create([
                 'nama'     => $request->input('nama'),
                 'nim'     => $request->input('nim'),
                 'jurusan'   => $request->input('jurusan'),
                 'jenis_kelamin'   => $request->input('jenis_kelamin'),
                 'alamat'  => $request->input       ('alamat'),
             ]);
 
             if ($data) {
                 return response()->json([
                     'success' => true,
                     'message' => 'Berhasil Disimpan!',
                 ], 200);
             } else {
                 return response()->json([
                     'success' => false,
                     'message' => ' Gagal Disimpan!',
                 ], 401);
             }
         }
     }
 
     // MENAMPILKAN DATA BERDASARKAN ID 
     public function show($id)
     {
         $data = Mahasiswa ::whereId($id)->first();
 
 
         if ($data) {
             return response()->json([
                 'success' => true,
                 'message' => 'Detail Nama Mahasiswa!',
                 'data'    => $data
             ], 200);
         } else {
             return response()->json([
                 'success' => false,
                 'message' => 'Data Tidak Ditemukan!',
                 'data'    => ''
             ], 401);
         }
     }
 
     //Cara Update data
     public function update(Request $request, $id)
     {
         $data = Mahasiswa ::where('id', $id)->first();
 
         // cek data dengan id yg dikirimkan
         if (empty($data)) {
             return response()->json([
                 'pesan' => 'Data tidak ditemukan',
                 'data' => $data
             ], 404);
         }
 
         // proses validasi
         $validate = Validator::make($request->all(), [
             'nama' => 'required',
             'nim' => 'required',
             'jurusan' => 'required',
             'jenis_kelamin' => 'required',
             'alamat' => 'required',
         ]);
 
         if ($validate->fails()) {
             return $validate->errors();
         }
 
         // proses simpan perubahan data
         $data->update($request->all());
 
         return response()->json([
             'pesan' => 'Data berhasil di update',
             'data' => $data
         ], 201);
     }
 
     //CARA MENGAPUS DATA 
     public function delete($id)
     {
         $data = Mahasiswa::where('id', $id)->first();
         // cek data dengan id yg dikirimkan
         if (empty($data)) {
             return response()->json([
                 'pesan' => 'Data tidak ditemukan',
                 'data' => $data
             ], 404);
         }
 
         $data->delete();
 
         return response()->json([
             'pesan' => 'Data berhasil di hapus',
             'data' => $data
         ], 200);
     }
}
