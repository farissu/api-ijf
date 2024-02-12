<?php

namespace App\Http\Controllers\CntCms;

use App\Models\CntCms\CmsImgix;
use App\Models\Company;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;


class Controller extends BaseController
{
    // public function getCompanyCode(Request $request){
    //     #Get company ID for next action
    //     $hostname = $this->getHost($request->header('x-forwarded-for'));
    //     if($request->route('entitas') == 'crowdfunding'){
    //         $company = Company::where('url',$hostname)->first();
    //         $company_id = $company->company_id;
    //     }else{
    //         $company = Company::where('url',$hostname)->first();
    //         $company_id = $company->id;
    //     }
        
    //     if(!$company){
    //         return 0;
    //     }else{
    //         return $company_id;
    //     }
    // }

    // private function getHost($xforwardedfor){
    //     $forArray = explode( ',',$xforwardedfor);
    //     return $forArray[0];
    // }

    // public function maskingImgix($companyId, $model, $fields, $id, $width, $height){
    //     $imgix = CmsImgix::where('company_id',$companyId)->first();
    //     if($imgix->active){
    //         return $imgix->image_url. $model .'/' . $id . '/'. $fields .'/' . $id . '.png';
    //     }else{
    //         return "Imgix Tidak aktif";
    //     }
        
    // }

    // public function maskingImgixIco($companyId, $model, $fields, $id, $width, $height){
    //     $imgix = CmsImgix::where('company_id',$companyId)->first();
    //     if($imgix->active){
    //         return $imgix->image_url. $model .'/' . $id . '/'. $fields .'/' . $id . '.ico?';
    //     }else{
    //         return "Imgix Tidak aktif";
    //     }
        
    // }
}
