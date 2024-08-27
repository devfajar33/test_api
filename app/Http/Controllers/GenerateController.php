<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
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
use DB;

class GenerateController extends Controller
{
    public function index(Request $request)
    {
        $param = '0';
        $data = ApiModel::get();
        return view('show', compact('data', 'param'));
    }

    public function store()
    {
        $contents = File::get(base_path('public/submission.json'));
        $response = json_decode(json: $contents, associative: true);  

        if($response)
        {
            foreach($response as $item)
            {
                if(ApiModel::where('name', $item['name'])->get()->count() == 0)
                {
                    $save = new ApiModel();
                    $save->id = $item['id'];
                    $save->name = $item['name'];
                    $save->save(); 

                    foreach($item['payloads'] as $item_details)
                    {
                        $save_detail = new ApiDetailModel();
                        $save_detail->id = $item_details['id'];
                        $save_detail->parent_id = $item['id'];
                        $save_detail->label = $item_details['label'];
                        $save_detail->type = $item_details['type'];
                        $save_detail->orm_only = $item_details['orm_only'];
                        $save_detail->description = $item_details['description'];
                        $save_detail->save(); 

                        if($item_details['supporting_file']['value'] != null && $item_details['supporting_file']['name'])
                        {
                            $save_file = new ApiSupportingFileModel();
                            $save_file->parent_id = $item_details['id'];
                            $save_file->value = $item_details['supporting_file']['value'];
                            $save_file->name = $item_details['supporting_file']['name'];
                            $save_file->save();                             
                        }

                        if($item_details['label'] == 'Bulan Pelaporan')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if(is_array($param) || is_object($param))
                            {           
                                foreach($param as $item_asnwer)
                                {   
                                    if(ApiAnswerMonthModel::where('id', $item_asnwer['id'])->get()->count() == 0)
                                    {                  
                                        $save_answer = new ApiAnswerMonthModel();
                                        $save_answer->id = $item_asnwer['id'];
                                        $save_answer->parent_id = $item_details['id'];
                                        $save_answer->value = "-";
                                        $save_answer->label = $item_asnwer['label'];
                                        $save_answer->save(); 
                                    }
                                } 
                            }
                            foreach($item_details['options'] as $item_month)
                            {
                                $save_month = new ApiMonthModel();
                                $save_month->id = $item_month['id'];
                                $save_month->value = '-';
                                $save_month->parent_id = $item_details['id'];
                                $save_month->label = $item_month['label'];
                                $save_month->save(); 
                            }
                        }   
                        
                        if($item_details['label'] == 'Quarter')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if(is_array($param) || is_object($param))
                            {           
                                foreach($param as $item_asnwer_quarter)
                                {   
                                    if(ApiAnswerQuarterModel::where('id', $item_asnwer_quarter['id'])->get()->count() == 0)
                                    {                  
                                        $save_answer_quarter = new ApiAnswerQuarterModel();
                                        $save_answer_quarter->id = $item_asnwer_quarter['id'];
                                        $save_answer_quarter->parent_id = $item_details['id'];
                                        $save_answer_quarter->value = "-";
                                        $save_answer_quarter->label = $item_asnwer_quarter['label'];
                                        $save_answer_quarter->save(); 
                                    }
                                } 
                            }
                            foreach($item_details['options'] as $item_quarter)
                            {
                                $save_quarter = new ApiQuarterModel();
                                $save_quarter->id = $item_quarter['id'];
                                $save_quarter->value = '-';
                                $save_quarter->parent_id = $item_details['id'];
                                $save_quarter->label = $item_quarter['label'];
                                $save_quarter->save(); 

                            }
                        }

                        if($item_details['label'] == 'Tanggal Ditemukan' || $item_details['label'] == 'Tanggal Kejadian')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if($param)
                            {    
                                $save_incident_date = new ApiAnswerDateModel();
                                $save_incident_date->parent_id = $item_details['id'];
                                $save_incident_date->value = $param;
                                $save_incident_date->name = "-";
                                $save_incident_date->save(); 
                            }
                        }

                        if($item_details['label'] == 'Deskripsi Kejadian' || $item_details['label'] == 'Deskripsi Penyebab / Root Cause Terjadinya Kejadian')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if($param)
                            {      
                                $save_found_date = new ApiAnswerDescriptionModel();
                                $save_found_date->parent_id = $item_details['id'];
                                $save_found_date->value = $param;
                                $save_found_date->name = "-";
                                $save_found_date->save(); 
                            }
                        }

                        if($item_details['label'] == 'Terkena Dampak')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if(is_array($param) || is_object($param))
                            {           
                                foreach($param as $item_loss)
                                {   
                                    $save_loss = new ApiAnswerLossModel();
                                    $save_loss->parent_id = $item_details['id'];
                                    $save_loss->value = $item_loss;
                                    $save_loss->name = "-";
                                    $save_loss->save(); 
                                } 
                            }
                        }

                        if($item_details['label'] == 'Potensial Kerugian Financial')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if($param)
                            {           
                                $save_loss_total = new ApiTotalLossModel();
                                $save_loss_total->parent_id = $item_details['id'];
                                $save_loss_total->value = $param;
                                $save_loss_total->name = "-";
                                $save_loss_total->save(); 
                            }
                        }

                        if($item_details['label'] == 'Kerugian Financial' || $item_details['label'] == 'Status')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if($param)
                            {           
                                $save_status = new ApiStatusLossModel();
                                $save_status->parent_id = $item_details['id'];
                                $save_status->value = $param;
                                $save_status->name = "-";
                                $save_status->save(); 
                            }
                        }

                        if($item_details['label'] == 'Kerugian Non-Financial')
                        {
                            $param = array();
                            $param = $item_details['answer']['value'];
    
                            if($param)
                            {           
                                $save_status_description = new ApiAnswerDescriptionModel();
                                $save_status_description->parent_id = $item_details['id'];
                                $save_status_description->value = $param;
                                $save_status_description->name = "-";
                                $save_status_description->save(); 
                            }
                        }
                    }
                }
            }
        }
        
        return redirect()->route('api.index');
    }

    public function detail($id)
    {
        $param = '1';
        $data = ApiModel::get();
        $data_header = ApiModel::where('id', $id)->first();
        $data_detail = ApiDetailModel::where('parent_id', $id)->get();
        // dd($data);

        return view('show', compact('data', 'data_header', 'data_detail', 'param'));
    }
}
