<?php

namespace App\Http\Controllers\CntEduhub;

use App\Models\CntEduhub\EduhubStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EduhubStudentController extends Controller
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
        $student = EduhubStudent::get();
        return response()->json($student);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validator = Validator::make($request->all(), [
            'nik' => 'required|integer',
            'nis' => 'required|integer',
            // ... tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Simpan data mahasiswa ke database
        $student = EduhubStudent::create($request->all());
    
        // Beri respons bahwa data berhasil disimpan
        return response()->json(['message' => 'Student created successfully', 'data' => $student]);
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
