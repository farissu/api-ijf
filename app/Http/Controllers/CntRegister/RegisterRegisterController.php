<?php

namespace App\Http\Controllers\CntRegister;

use App\Models\CntRegister\RegisterRegister;
use App\Models\CntRegister\RegisterSchool;
use App\Models\CntRegister\RegisterParent;
use App\Models\CntRegister\RegisterStudent;
use App\Models\CntRegister\RegisterWali;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegisterRegisterController extends Controller
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
        $register = RegisterRegister::get();
        return response()->json($register);
    }

    public function create(Request $request)
    {
        $dataRegister = [];
        // dd($request);

        #Parent - Father
        $dataParent['company_id'] = $request->input('company_id');
        $dataParent['father_name'] = $request->input('father_name');
        $dataParent['father_job'] = $request->input('father_job');
        $dataParent['father_job_description'] = $request->input('father_job_description');
        $dataParent['father_income'] = $request->input('father_income');
        $dataParent['father_education'] = $request->input('father_education');
        $dataParent['father_wa'] = $request->input('father_wa');

        #Parent - Mother
        $dataParent['mother_name'] = $request->input('mother_name');
        $dataParent['mother_job'] = $request->input('mother_job');
        $dataParent['mother_job_description'] = $request->input('mother_job_description');
        $dataParent['mother_income'] = $request->input('mother_income');
        $dataParent['mother_education'] = $request->input('mother_education');
        $dataParent['mother_wa'] = $request->input('mother_wa');
        $dataParent['parents_name'] = $request->input('father_name') . ' | ' . $request->input('mother_name');

        $parent = RegisterParent::create($dataParent);


        #Student
        $dataStudent['company_id'] = $request->input('company_id');
        $dataStudent['name'] = $request->input('name');
        $dataStudent['gender'] = $request->input('gender');
        $dataStudent['place_of_birth_id'] = $request->input('place_of_birth_id');
        $dataStudent['date_of_birth'] = $request->input('date_of_birth');
        $dataStudent['is_disabilities'] = $request->input('is_disabilities');
        $dataStudent['address'] = $request->input('address');
        $dataStudent['province_id'] = $request->input('province_id');
        $dataStudent['city_id'] = $request->input('city_id');
        $dataStudent['district_id'] = $request->input('district_id');
        $dataStudent['parent_id'] = $parent["id"];
        $dataStudent['sub_district_id'] = $request->input('sub_district_id');
        $dataStudent['parent_status'] = $request->input('parent_status');


        $student = RegisterStudent::create($dataStudent);

        #Register
        $dataRegister['nomor'] = $request->input('nomor');
        $dataRegister['company_id'] = $request->input('company_id');
        $dataRegister['school_name_id'] = $request->input('school_name_id');
        $dataRegister['wali_id'] = $request->input('wali_id');
        $dataRegister['parent_id'] = $parent["id"];
        $dataRegister['student_id'] = $student["id"];
        $dataRegister['join_date'] = $request->input('join_date');
        $dataRegister['student_status'] = $request->input('student_status');
        $dataRegister['is_elementary'] = $request->input('is_elementary');
        $dataRegister['is_kindergarten'] = $request->input('is_kindergarten');
        $dataRegister['previous_school'] = $request->input('previous_school');
        $dataRegister['status_terima'] = $request->input('status_terima');
        $dataRegister['status'] = $request->input('status');
        // $dataRegister['image'] = $request->input('image');
        // $dataRegister['code'] = $request->input('code');

        $school_name_id = $request->input('school_name_id') ?? null;

        $register_school = RegisterSchool::where('name_id', $school_name_id)->get();
        $register_register = RegisterRegister::select('nomor')->where('school_name_id', $school_name_id)->orderBy('nomor', 'desc')->first();
        $regist_id = RegisterRegister::select('id')->where('school_name_id', $school_name_id)->orderBy('id', 'desc')->first();

        if ($request->input('student_status') == 'ub') {
            $student_status = 'UB';
        } else if ($request->input('student_status') == 'up') {
            $student_status = 'UP';
        } else if ($request->input('student_status') == 'bb') {
            $student_status = 'BB';
        } else if ($request->input('student_status') == 'bp') {
            $student_status = 'BP';
        } else {
            $student_status = 'UB';
        }

        $school_code = $register_school[0]->code;

        $dates = $request->input('join_date') ?? '0';
        $join_date = str_replace("-", "", $dates);


        if ($register_register) {
            $last_sequence = explode('.', $register_register->nomor);
            $next_sequence = end($last_sequence);
            $next_sequence = intval($next_sequence) + 1;
            $next_sequence = sprintf('%03d', $next_sequence);
        } else {
            $next_sequence = '001';
        }
        $nomor = ($student_status . '.' . $school_code . '.' . $join_date . '.' . $next_sequence);

        $dataRegister['nomor'] = $nomor;


        $last_unique_code = $regist_id ? $regist_id->id : 0;
        $dataRegister['nominal_tf'] = (int)$register_school[0]->fee + ((int)$last_unique_code + 1);
        
        $save = RegisterRegister::create($dataRegister);
        // dd($save);
        if (!$save) {
            return json_encode(["status" => false, "message" => "Data failed to Insert"], 403);
        } else {
            return json_encode(["status" => true, "message" => "Data was Inserted", "register_id" => $save->id], 200);
        }
    }

    public function store()
    {
    }

    public function showCheckout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'invalidInput'], 400);
        }

        $register = RegisterRegister::select(
            'cnt_register_register.id',
            'cnt_register_register.nomor as nomor',
            'cnt_register_parent.father_name as parent',
            'cnt_register_student.name as student',
            'res_partner.name as school',
            'res_partner.mobile as mobile',
            'cnt_register_school.no_rek as no_rek',
            'cnt_register_school.nama_rek as nama_rek',
            'cnt_register_school.atas_nama as atas_nama',
            'cnt_register_register.nominal_tf as nominal_tf',
        )
            ->leftJoin('cnt_register_parent', 'cnt_register_parent.id', '=', 'cnt_register_register.parent_id')
            ->leftJoin('cnt_register_student', 'cnt_register_student.id', '=', 'cnt_register_register.student_id')
            ->leftJoin('res_partner', 'res_partner.company_id', '=', 'cnt_register_register.school_name_id')
            ->leftJoin('cnt_register_school', 'cnt_register_school.id', '=', 'cnt_register_register.school_name_id')
            ->where('cnt_register_register.id', $request->input('id'))
            ->first();

        if ($register) {
            return response()->json(["status" => true, "result" => $register]);
        } else {
            return response()->json(["status" => false, "result" => "No Data"]);
        }
    }

    public function transferProof(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'invalidInput'], 400);
        }

        $register = RegisterRegister::select(
            'cnt_register_register.id',
            'cnt_register_register.nomor as nomor',
        )
            ->where('cnt_register_register.id', $request->input('id'))
            ->first();

        // dd($register);
        if ($request->input('image')) {
            $file = $request->input('image');
            // dd($file);
            $this->uploadFoto($file, $register->id, $register->nomor);
        }
    }

    private function uploadFoto($file, $id, $nomor)
    {
        try {
            $image = $file;
            $url = 'https://erp16-ijf-dev3.cnt.id/cnt_register/register/gambar';
            $post_data = [
                'name' => $nomor,
                'datas' => $image,
                'res_id' => $id,
            ];
            // dd($post_data);

            $ch = curl_init($url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

            $response = curl_exec($ch);
            curl_close($ch);
        } catch (FileNotFoundException $e) {
            echo 'error';
        }
        return $response;
    }

    public function getRegistByEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'invalidInput'], 400);
        }

        $mail = RegisterWali::select('id')
            ->where('cnt_register_wali.email', $request->input('email'))->first();
        // dd($mail->id);

        if (!$mail) {
            return json_encode(["status" => false, "message" => "Email was not founded"], 403);
        } else {
            $register_school = RegisterRegister::select(
                'cnt_register_parent.father_name as parent',
                'cnt_register_student.name as student',
                'cnt_register_register.nomor as nomor',
                'cnt_register_register.status_terima as status',
                'cnt_register_register.id as id_status',
                'cnt_register_student.date_of_birth as date_of_birth',
                'res_partner.name as school',
                'res_partner.mobile as mobile',
            )
                ->leftJoin('cnt_register_parent', 'cnt_register_parent.id', '=', 'cnt_register_register.parent_id')
                ->leftJoin('cnt_register_student', 'cnt_register_student.id', '=', 'cnt_register_register.student_id')
                ->leftJoin('res_partner', 'res_partner.company_id', '=', 'cnt_register_register.school_name_id')
                ->where('cnt_register_register.wali_id', $mail->id);
                // ->leftJoin('cnt_register_wali', 'cnt_register_wali.id', '=', 'cnt_register_register.id')
            
            $count = $register_school->count();

            $result = $register_school->orderBy('cnt_register_student.name', 'asc')
                ->take($request->input('limit'))
                ->skip($request->input('offset'))->get();
            
            $response = [
                'count' => $count,
                'data' => $result,
            ];

            // dd($register_school);

            return response()->json(["status" => true, "message" => "Get Data Berhasil", "result" => $response],  200);
        }
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
