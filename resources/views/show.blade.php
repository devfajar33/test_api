<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="row">
            <h2 class="m-3">Menampilkan Data</h2>
            <div class="col-lg-6">
                <table class="m-3 table">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$item['name']}}</td>
                            <td><a href="{{ route('api.detail', $item['id']) }}">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <div class="m-3">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">  
                            <label class="col-sm-12 col-form-label">{{ $param != 0 ? $data_header['name'] : '-' }}</label>
                        </div>  
                    </div>  
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Payloads</label>
                        <div class="col-sm-12">  
                        </div>  
                    </div> 
                    <ul>
                        @if($param == 0)
                        <li>
                            <label class="col-sm-12 col-form-label">No data entry !</label>
                        </li>
                        @else
                            @foreach($data_detail as $item)
                            <li>
                                <label class="col-sm-12 col-form-label">{{ $item->label }}</label>
                                @foreach(App\Models\ApiAnswerMonthModel::where('parent_id', $item['id'])->get() as $item_answer)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Dipilih</label> 
                                    <div class="col-sm-10">  
                                        <label class="col-sm-12 col-form-label">: {{ $item_answer['label'] }}</label>
                                    </div>  
                                </div>  
                                @endforeach
                                @foreach(App\Models\ApiAnswerQuarterModel::where('parent_id', $item['id'])->get() as $item_answer)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Dipilih</label> 
                                    <div class="col-sm-10">  
                                        <label class="col-sm-12 col-form-label">: {{ $item_answer['label'] }}</label>
                                    </div>   
                                </div>  
                                @endforeach
                                @foreach(App\Models\ApiAnswerDateModel::where('parent_id', $item['id'])->get() as $item_answer)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal</label> 
                                    <div class="col-sm-10">  
                                        <label class="col-sm-12 col-form-label">: {{ $item_answer['value'] }}</label>
                                    </div>   
                                </div>  
                                @endforeach
                                @foreach(App\Models\ApiAnswerDescriptionModel::where('parent_id', $item['id'])->get() as $item_answer)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Deskripsi</label> 
                                    <div class="col-sm-10">  
                                        <label class="col-sm-12 col-form-label">: {{ $item_answer['value'] }}</label>
                                    </div>   
                                </div>  
                                @endforeach
                                @foreach(App\Models\ApiAnswerLossModel::where('parent_id', $item['id'])->get() as $item_answer)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Number</label> 
                                    <div class="col-sm-10">  
                                        <label class="col-sm-12 col-form-label">: {{ $item_answer['value'] }}</label>
                                    </div>   
                                </div>  
                                @endforeach
                                @foreach(App\Models\ApiTotalLossModel::where('parent_id', $item['id'])->get() as $item_answer)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Number</label> 
                                    <div class="col-sm-10">  
                                        <label class="col-sm-12 col-form-label">: {{ $item_answer['value'] }}</label>
                                    </div>   
                                </div>  
                                @endforeach
                                @foreach(App\Models\ApiStatusLossModel::where('parent_id', $item['id'])->get() as $item_answer)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Number</label> 
                                    <div class="col-sm-10">  
                                        <label class="col-sm-12 col-form-label">: {{ $item_answer['value'] }}</label>
                                    </div>   
                                </div>  
                                @endforeach
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>     
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
