<?php

namespace App\Http\Controllers\CntRegister;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CntRegister\RegisterCity;
use App\Models\CntRegister\RegisterDistrict;
use App\Models\CntRegister\RegisterProvince;
use App\Models\CntRegister\RegisterSubDistrict;
use Illuminate\Support\Facades\Validator;

class RegisterRegionController extends Controller
{
    public function getProvinsi()
    {
        $getProv = RegisterProvince::select(
            'id',
            'prov as nama'
        )
            ->orderby('nama', 'ASC')
            ->get();
        $response = [
            "provinsi" => $getProv,
        ];

        return response()->json($response);
    }

    public function getKota(Request $request)
    {
        $getKota = RegisterCity::select(
            'id',
            'kdkota',
            'province as id_provinsi',
            'kota as nama'
        )
            ->orderby('kdkota', 'ASC');

        if ($request->input('id_provinsi')) {
            $getKota->where('kdprov', $request->input('id_provinsi'));
        }

        $getKota = $getKota->get();

        foreach ($getKota as $kota) {
            $kota->kode_kota = str_replace('.', '', $kota->kdkota);
            unset($kota->kdkota);
        }


        $response = [
            "kota_kabupaten" => $getKota->map(function ($kota) {
                return [
                    "kode_kota" => $kota->kode_kota,
                    "id" => $kota->id,
                    "id_provinsi" => $kota->id_provinsi,
                    "nama" => $kota->nama,
                ];
            }),
        ];


        return response()->json($response);
    }

    public function getKecamatan(Request $request)
    {
        $getKec = RegisterDistrict::select(
            'kdkec',
            'kdkota as id_kota',
            'kec as nama'
        )
            ->orderby('kdkec', 'ASC');

        if ($request->input('id_kota')) {
            $idKota = str_replace('.', '', $request->input('id_kota'));
            $getKec->whereRaw("REPLACE(kdkota, '.', '') = ?", [$idKota]);
        }

        $getKec = $getKec->get();

        foreach ($getKec as $kec) {
            $kec->id = str_replace('.', '', $kec->kdkec);
            $kec->id_kota = str_replace('.', '', $kec->id_kota);
            unset($kec->kdkota);
        }

        $response = [
            "kecamatan" => $getKec->map(function ($kec) {
                return [
                    "id" => $kec->id,
                    "id_kota" => $kec->id_kota,
                    "nama" => $kec->nama,
                ];
            }),
        ];

        return response()->json($response);
    }

    public function getKelurahan(Request $request)
    {
        $getKelurahan = RegisterSubDistrict::select(
            'kdkel',
            'kdkec as id_kecamatan',
            'kel as nama'
        )
            ->orderby('kdkel', 'ASC');

        if ($request->input('id_kecamatan')) {
            $idKec = str_replace('.', '', $request->input('id_kecamatan'));
            $getKelurahan->whereRaw("REPLACE(kdkec, '.', '') = ?", [$idKec]);
        }

        $getKelurahan = $getKelurahan->get();

        foreach ($getKelurahan as $kel) {
            $kel->id = str_replace('.', '', substr($kel->kdkel, 3));
            $kel->id_kecamatan = str_replace('.', '', $kel->id_kecamatan);
        }

        $response = [
            "kelurahan" => $getKelurahan->map(function ($kel) {
                return [
                    "id" => $kel->id,
                    "id_kecamatan" => $kel->id_kecamatan,
                    "nama" => $kel->nama,
                ];
            }),
        ];

        return response()->json($response);
    }

    public function getAreaConcatted(Request $request)
    {

        $kabupaten = RegisterCity::leftJoin('wh_provinsi', function ($join) {
            $join->on('wh_kota.kdprov', '=', 'wh_provinsi.kdprov');
        })->select(
            'wh_kota.kdkota as kabid',
            'wh_kota.kdprov as propid',
            'wh_kota.kota as kabupaten',
            'wh_provinsi.prov as propinsi'
        )->orderby('wh_kota.kdkota', 'ASC')->get();

        foreach ($kabupaten as $kab) {
            $kab->kabid = str_replace('.', '', $kab->kabid);
        }

        return response()->json($kabupaten);
    }

    function getKotaById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "province_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'invalidInput'], 400);
        }
        $province_id = $request->input('province_id') ?? null;

        $kota = RegisterCity::where('province', $province_id)->get();

        if (count($kota) > 0) {
            return response()->json(["status" => true, "result" => $kota]);
        } else {
            return response()->json(["status" => false, "result" => "No Data"]);
        }
    }

    function getKecamatanById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kota_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'invalidInput'], 400);
        }
        $kota_id = $request->input('kota_id') ?? null;

        $district = RegisterDistrict::where('city', $kota_id)->get();

        if (count($district) > 0) {
            return response()->json(["status" => true, "result" => $district]);
        } else {
            return response()->json(["status" => false, "result" => "No Data"]);
        }
    }

    function getKelurahanById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kecamatan_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'invalidInput'], 400);
        }
        $kecamatan_id = $request->input('kecamatan_id') ?? null;

        $sub_district = RegisterSubDistrict::where('district', $kecamatan_id)->get();

        if (count($sub_district) > 0) {
            return response()->json(["status" => true, "result" => $sub_district]);
        } else {
            return response()->json(["status" => false, "result" => "No Data"]);
        }
    }
}
