<?php

namespace App\Http\Controllers\CntRegister;

use App\Http\Controllers\CntCms\Controller;
use App\Models\CntRegister\RegisterSchool;
use App\Models\CntRegister\RegisterTesti;
use App\Models\CntRegister\RegisterUnggulan;
use App\Models\CntRegister\RegisterFacility;
use App\Models\CntRegister\RegisterEkskul;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterSchoolController extends Controller
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
        $slug = $request->input('slug') ?? null;

        $count = RegisterSchool::count();

        $register = RegisterSchool::select(
            'cnt_register_school.id',
            'name_id',
            'code',
            'level',
            'place',
            'cnt_register_school.slug',
            'tagline',
            'thumbnail_url',
            'content',
            'kepsek_name',
            'kepsek_image_url',
            'cost',
            'registration',
            'res_partner.name as company_name',
            'res_partner.mobile as company_mobile',
            'res_partner.email as company_email',
            'res_partner.contact_address_complete as company_address',
        )
            ->leftJoin('res_company', 'res_company.id', '=', 'cnt_register_school.id')
            ->leftJoin('res_partner', 'res_partner.id', '=', 'res_company.partner_id')
            ->orderby('cnt_register_school.sequence', 'ASC')
            ->take($request->input('limit'))
            ->skip($request->input('offset'));
            
        if ($slug) {
            $register = $register->where('cnt_register_school.slug', $slug);
        }

        $register = $register->get();

        if (!$register) {
            return response()->json(['message' => 'school not found'], 404);
        }

        $testi = RegisterTesti::select(
            'parents_name',
            'information',
            'desc_testi',
        )
            ->where('slug', $slug)
            ->get();

        $unggulan = RegisterUnggulan::select(
            'program_name',
            'desc_program',
        )
            ->where('slug', $slug)
            ->get();

        $facility = RegisterFacility::select(
            'facil_name',
            'desc_facil',
            'icon_url'
        )
            ->where('slug', $slug)
            ->get();

        $ekskul = RegisterEkskul::select(
            'ekskul_name',
            'desc_ekskul',
            'icon_url'
        )
            ->where('slug', $slug)
            ->get();

        $result = [
            'count' => $count,
            'school' => $register,
            'testi' => $testi,
            'program' => $unggulan,
            'facility' => $facility,
            'ekskul' => $ekskul,
        ];

        return response()->json($result);
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
