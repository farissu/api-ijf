<?php

namespace App\Http\Controllers\CntEduhub;
use App\Models\CntEduhub\EduhubBill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EduhubBillController extends Controller
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
        $bill = EduhubBill::get();
        return response()->json($bill);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validator = Validator::make($request->all(), [
            // 'bill' => 'string',
        ]);
    
        // Cek apakah validasi berhasil
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Simpan data mahasiswa ke database
        $bill = EduhubBill::create($request->all());
    
        // Beri respons bahwa data berhasil disimpan
        return response()->json(['message' => ' created successfully', 'data' => $bill]);
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
