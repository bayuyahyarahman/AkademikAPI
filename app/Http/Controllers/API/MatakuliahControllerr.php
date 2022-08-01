<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\matakuliah;
use Illuminate\Support\Facades\Validator;


class MatakuliahControllerr extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }
    
     // menampilkan data 
     public function index()
     {
         $data = Matakuliah ::latest()->get();
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
             'kode_matakuliah' => 'required',
             'nam_matakuliah' => 'required',
             'sks_teori' => 'required',
             'sks_pratikum' => 'required',
         ],
             [
                 'kode_matakuliah' => 'Masukkan kode matkul anda !',
                 'nam_matakuliah.required' => 'Masukkan nama matkul anda !',
                 'sks_teori.required' => 'Masukkan jumlah sks teori !',
                 'sks_pratikum.required' => 'Masukkan jumlah sks pratikum !',
             ]
         );
 
         if($validator->fails()) {
 
             return response()->json([
                 'success' => false,
                 'message' => 'Silahkan Isi Bidang Yang Kosong',
                 'data'    => $validator->errors()
             ],401);
 
         } else {
 
             $data = Matakuliah ::create([
                 'kode_matakuliah'     => $request->input('kode_matakuliah'),
                 'nam_matakuliah'     => $request->input('nam_matakuliah'),
                 'sks_teori'   => $request->input('sks_teori'),
                 'sks_pratikum'   => $request->input('sks_pratikum'),
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
         $data = Matakuliah ::whereId($id)->first();
 
 
         if ($data) {
             return response()->json([
                 'success' => true,
                 'message' => 'Detail Nama Matakuliah !',
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
         $data = Matakuliah ::where('id', $id)->first();
 
         // cek data dengan id yg dikirimkan
         if (empty($data)) {
             return response()->json([
                 'pesan' => 'Data tidak ditemukan',
                 'data' => $data
             ], 404);
         }
 
         // proses validasi
         $validate = Validator::make($request->all(), [
             'kode_matakuliah' => 'required',
             'nam_matakuliah' => 'required',
             'sks_teori' => 'required',
             'sks_pratikum' => 'required',
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
         $data = Matakuliah::where('id', $id)->first();
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
