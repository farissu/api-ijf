<?php

namespace App\Http\Controllers\CntRegister;

use App\Models\CntRegister\RegisterStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegisterStudentController extends Controller
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
        $student = RegisterStudent::get();
        return response()->json($student);
    }

    public function create()
    {

    }


    public function store()
    {

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
