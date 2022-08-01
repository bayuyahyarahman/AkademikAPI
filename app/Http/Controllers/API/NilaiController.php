<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\nilai;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }
    
     // menampilkan data 
     public function index()
     {

       $data = Nilai::with('mahasiswa','matakuliah')->get();
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
             'nim' => 'required',
             'kode_matakuliah' => 'required',
             'nilai_angka' => 'required',
             'nilai_huruf' => 'required',
             
         ],
             [
                 'nim.required' => 'Masukkan nim anda !',
                 'kode_matakuliah.required' => 'Masukkan kode matkul anda !',
                 'nilai_angka.required' => 'Masukkan jumlah nilai Angka !',
                 'nilai_huruf.required' => 'Masukkan jumlah nilai Huruf !',
                 
                 
             ]
         );
 
         if($validator->fails()) {
 
             return response()->json([
                 'success' => false,
                 'message' => 'Silahkan Isi Bidang Yang Kosong',
                 'data'    => $validator->errors()
             ],401);
 
         } else {
 
             $data = Nilai ::create([
                 'nim'     => $request->input('nim'),
                 'kode_matakuliah'     => $request->input('kode_matakuliah'),
                 'nilai_angka'   => $request->input('nilai_angka'),
                 'nilai_huruf'   => $request->input('nilai_huruf'),
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
         $data = Nilai ::whereId($id)->first();
 
 
         if ($data) {
             return response()->json([
                 'success' => true,
                 'message' => 'Detail Nilai !',
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
         $data = Nilai ::where('id', $id)->first();
 
         // cek data dengan id yg dikirimkan
         if (empty($data)) {
             return response()->json([
                 'pesan' => 'Data tidak ditemukan',
                 'data' => $data
             ], 404);
         }
 
         // proses validasi
         $validate = Validator::make($request->all(), [
             'nim' => 'required',
             'kode_matakuliah' => 'required',
             'nilai_angka' => 'required',
             'nilai_huruf' => 'required',
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
         $data = Nilai::where('id', $id)->first();
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
