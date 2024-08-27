<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\GetDataResource;
use App\Models\ApiModel;
use App\Models\ApiDetailModel;
use App\Models\ApiAnswerMonthModel;
use App\Models\ApiSupportingFileModel;
use App\Models\ApiMonthModel;
use App\Models\ApiQuarterModel;
use App\Models\ApiAnswerQuarterModel;
use App\Models\ApiAnswerDescriptionModel;
use App\Models\ApiAnswerDateModel;
use App\Models\ApiAnswerLossModel;
use App\Models\ApiStatusLossModel;
use App\Models\ApiTotalLossModel;

class GetDataController extends Controller
{
    public function index()
    {
        $data = ApiModel::get();
        return response()->json($data);
        // return new GetDataResource(true, 'Data has been successfuly', $data);
    }
}
