<?php

namespace App\Http\Controllers\CntEduhub;

use App\Models\CntEduhub\EduhubDistrict;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EduhubDistrictController extends Controller
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
        $district = EduhubDistrict::get();
        return response()->json($district);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validator = Validator::make($request->all(), [
            // 'District' => 'string',
        ]);
    
        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Simpan data mahasiswa ke database
        $district = EduhubDistrict::create($request->all());
    
        // Beri respons bahwa data berhasil disimpan
        return response()->json(['message' => ' created successfully', 'data' => $district]);
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
