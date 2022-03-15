<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;
use Carbon\Carbon;

use App\Model\OQCInspection;
use App\Model\OQCInspection_2;
use App\Model\OQCStamp;
use App\User;

class OQCInspectionController extends Controller
{
    public function getAll_OQCInspection(Request $request)
    {
    	return response()->json(['data' => OQCInspection::get()]);
    }

    public function saveOQCInspection_2(Request $request)
    {
        if( count( OQCInspection_2::where('prod_runcard_id', $request->prod_runcard_id)->get() ) == 0 ){
        	$data = new OQCInspection_2();
        	$data->prod_runcard_id = $request->prod_runcard_id;
			// $data->coc = $request->coc;
			$data->guage = $request->guage;
			$data->accessory = $request->accessory;
			$data->yd_lbl_req = $request->yd_lbl_req;
			$data->chs_coating = $request->chs_coating;
            $data->employee_id = $request->employee_id;
            $result = 0;
            if(  in_array($request->judgement, ["Accept", "Accepted"]) )
                $result = 1;
            $data->result = $result;
            $user = User::where('employee_id', $data->employee_id)->get();
            if( count($user)>0 ){
                $oqc_stamp = OQCStamp::where('user_id', $user[0]->id)->get();
                if( count($oqc_stamp)>0 )
                    $data->oqc_stamp = $oqc_stamp[0]->oqc_stamp;
            }
			$data->save();
			return response()->json(['result' => 1]);
        }else{
        	return response()->json(['error_msg' => 'There is OQC Inspection Result already existing.']);
        }
    }
}