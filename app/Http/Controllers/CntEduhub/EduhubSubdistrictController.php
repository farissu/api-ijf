<?php

namespace App\Http\Controllers\CntEduhub;

use App\Models\CntEduhub\EduhubSubdistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EduhubSubdistrictController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {   
        $subdistrict = EduhubSubdistrict::get();
        return response()->json($subdistrict);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validator = Validator::make($request->all(), [
            'subdistrict' => 'string',
            // ... tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Simpan data mahasiswa ke database
        $subdistrict = EduhubSubdistrict::create($request->all());
    
        // Beri respons bahwa data berhasil disimpan
        return response()->json(['message' => ' created successfully', 'data' => $subdistrict]);
    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
