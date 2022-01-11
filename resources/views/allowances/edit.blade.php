@extends('layouts.main')
@section('style_lib')
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header border-bottom mb-0">
                        <h4 class="mt-3">የሰራተኞች አበልና መጓጓዣ ወጭ መጠየቂያና መፍቀጃ ቅጽ</h4>
                        <div class="block-options">
                            <nav class="m-0">
                                <ol class="breadcrumb breadcrumb-alt push m-0" >
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('allowances.index')}}">Allowances</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Edit
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <form action="{{route('allowances.update', [$allowance->id])}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="ml-5 col-md-6 mb-3">
                                <div class="block-content">
                                    <div class="form-group">
                                        <label for="employee_id"  class="col-form-label">የሰራተኛዉ ስም፡ </label>
                                        <select name="employee_id" id="employee_id" class="form-control form-control-sm s @error('employee_id') is-invalid @enderror" style="width: 100%;" >
                                            @foreach ($employees as $employee)
                                                @if (old('employee_id', $allowance->employee_id) == $employee->id)
                                                    <option value="{{$employee->id}}" selected }}>{{$employee->full_name}}</option>
                                                @else
                                                    <option value="{{$employee->id}}"}}>{{$employee->full_name}}</option>
                                                @endif
                                            @endforeach                                   
                                        </select>
                                        @if($errors->has('employee_id'))
                                            <div class="text-danger">{{ $errors->first('employee_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="row">    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="start_location" class="col-form-label"> መነሻ ቦታ፡ </label>
                                                    <select name="start_location" id="start_location" class="form-control form-control-sm" style="width: 100%;">
                                                        @foreach ($cities as $city)
                                                            @if (old('start_location', $allowance->start_location) == $city->id)
                                                                <option value="{{$city->id}}" selected }}>{{$city->name}}</option>
                                                            @else
                                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                            @endif 
                                                        @endforeach                                                                                          
                                                    </select>
                                                    @if($errors->has('start_location'))
                                                        <div class="text-danger">{{ $errors->first('start_location') }}</div>
                                                    @endif
                                                
                                            </div> 
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="target_location" class="col-form-label"> መድረሻ ቦታ፡ </label>
                                                
                                                    <select name="target_location" id="target_location" class="form-control form-control-sm" style="width: 100%;">
                                                        @foreach ($cities as $city)
                                                            @if (old('target_location', $allowance->target_location) == $city->id)
                                                                <option value="{{$city->id}}" selected }}>{{$city->name}}</option>
                                                            @else
                                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                            @endif 
                                                        @endforeach                                  
                                                    </select>
                                                    @if($errors->has('target_location'))
                                                        <div class="text-danger">{{ $errors->first('target_location') }}</div>
                                                    @endif
                                                
                                            </div>
                                        </div>                                     
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="start_date" class="col-form-label"> መነሻ ቀን፡ </label>                                                
                                                <input class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date" name="start_date" value="{{ old('start_date', $allowance->start_date)}}" >
                                                @if($errors->has('start_date'))
                                                    <div class="text-danger">{{ $errors->first('start_date') }}</div>
                                                @endif                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <div class="form-group">
                                                <label for="return_date" class="col-form-label"> መመለሻ ቀን፡ </label>
                                                <input class="form-control @error('return_date') is-invalid @enderror" type="date" id="return_date" name="return_date" value="{{ old('return_date', $allowance->return_date)}}" >
                                                @if($errors->has('return_date'))
                                                    <div class="text-danger">{{ $errors->first('return_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="trip_reason" class="col-form-label"> የጉዞ አላማ፡ </label>
                                        <textarea name="trip_reason" id="trip_reason"  rows="3" class="form-control @error('trip_reason') is-invalid @enderror">{{ old('trip_reason', $allowance->trip_reason)}}</textarea>
                                        @if($errors->has('trip_reason'))
                                            <div class="text-danger">{{ $errors->first('trip_reason') }}</div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block"><i class="far fa-save mr-1"></i> Save and Continue</button>
                                </div>
                            </div>
                            <div class="offset-md-1 col-md-3">
                                <div class="block-content bg-body-light mt-5">
                                    <h4 class="mb-3 border-bottom text-center">በቅድሚያ የተከፈለ ብር፡</h4>
                                    <div class="form-group row mb-3">
                                        <label for="trip_allowance" class="col-md-4 text-md-right">አበል፡</label>
                                        <div class="col-md-6">
                                            <input readonly type="number" name="trip_allowance" id="trip_allowance" class="form-control form-control-sm" value="{{$allowance->trip_allowance}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="transport_allowance" class="col-md-4 text-md-right">ትራንስፓርት፡</label>
                                        <div class="col-md-6">
                                            <input type="number" name="transport_allowance" id="transport_allowance" class="form-control form-control-sm" value="{{$allowance->transport_allowance or 0}}" disabled>
                                        </div>
                                        <a href="javascript:void(0)" id="icon-transport"><i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="feul_allowance" class="col-md-4 text-md-right">ለነዳጅና፡</label>
                                        <div class="col-md-6">
                                            <input type="number" name="feul_allowance" id="feul_allowance" class="form-control form-control-sm" value="{{$allowance->fuel_allowance or 0}}" disabled>
                                        </div>
                                        <a href="javascript:void(0)" id="icon-feul"><i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="other_expense" class="col-md-4 text-md-right">ተጨማሪ፡</label>
                                        <div class="col-md-6">
                                            <input type="number" name="other_expense" id="other_expense" class="form-control form-control-sm" value="{{$allowance->other_expense or 0}}" disabled>
                                        </div>
                                        <a href="javascript:void(0)" id="icon-other"><i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div><strong>ድምር፡</strong></div>
                                        <div class="text-success"><span id="total">{{ $allowance->trip_allowance + $allowance->transport_allowance + $allowance->fuel_allowance + $allowance->other_expense  }}</span> ብር</div>
                                        {{-- <div class="text-success"><span id="total">{{ $allowance->trip_allowance + $allowance->transport_allowance + $allowance->fuel_allowance + $allowance->other_expense }}</span> ብር</div> --}}
                                    </div>
                                </div>
                                <div class="">                                   

                                    <p class="text-muted border-bottom mb-2"><strong>ማሳሰቢያ፡ </strong>ይህ ፎርም በሚመለከታቸው ሰራተኞችና የስራ ክፍል ሃላፊዎች ተሞልቶ የሚቀርበው ሰራተኛው ቢያንስ ከስድስት ሰዓት በላይ የሚቆይ ስራ ከሰራ ነዉ፡፡</p>
                                    <p class="text-muted m-0"><strong>* </strong><span  id="message"> እባክዎ ጉዞ የሚጀምሩበትንና የሚመለሱበትን ቀን በትክክል ያስገቡ</span></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  
@endsection
@section('scripts_lib')
    <script src="{{ asset('OneUI/assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
@endsection
@section('scripts')
    <script>
        let allowance=0;
        function total(){
            let travel=$("#trip_allowance").val()
            let transport=$("#transport_allowance").val()
            let fuel=$("#feul_allowance").val()
            let other=$("#other_expense").val()
            let sum= parseFloat(travel)+ parseFloat(transport) + parseFloat(fuel)+ parseFloat(other)
            $("#total").text(sum)
        }
        function dayDifference(){
            let start=$("#start_date").val()
            let end=$("#return_date").val()
            if(!start || !end){
                return null;
            }
            let startDay=new Date(start)
            let returnDay=new Date(end)
            let millisecondsPerDay= 1000*60*60*24
            let millBetween = returnDay.getTime() - startDay.getTime()
            let days =millBetween/millisecondsPerDay
            return days + 1
        }
        function getAllowance(){
            var days=dayDifference()
            if(days == null){
                $("#message").text("Select Start and Return date")
            }
            else if(days<1){
                $("#message").text("Return date can't be less than start date")
            }
            else if(days > 29){
                $("#message").text("date range should not be more than 29 day's ")
            }
            else{
                $("#days_count").text(days)
                let _target=$("#target_location").val()
                let _id=$("#employee_id").val()
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"POST",
                    url:"/allowance/get_city_allowance",
                    data:{
                        'employee_id':_id,
                        'location':_target,
                        _token:_token
                    },
                    success:function(response){
                        let difference=dayDifference()
                        let sum=difference * response.allowance
                        $("#perdiem").text(response.allowance)
                        $("#trip_allowance").val(sum)
                        total()
                        //$("#total").text(sum)
                        $("#message").text(`${difference} ቀን * ${response.allowance} ብር= ${sum} ብር`)
                    }
                })                                          
            }            
        }
        $(document).ready(function(){
            //set Select2 style
            $('#start_location').select2({
                'theme':"bootstrap4"
            })
            $('#employee_id').select2({
                'theme':"bootstrap4"
            })
            $('#target_location').select2({
                'theme':"bootstrap4"
            })

            //enable aditional payment
            $("#icon-transport").on('click', function(){
                $("#transport_allowance").prop("disabled", false)
            })
            $("#icon-feul").on('click', function(){
                $("#feul_allowance").prop("disabled", false)
            })
            $("#icon-other").on('click', function(){
                $("#other_expense").prop("disabled", false)
            })
            $("#transport_allowance").on("change", function(){
                total()
            })
            $("#feul_allowance").on("change", function(){
                total()
            })
            $("#other_expense").on("change", function(){
                total()
            })
            //claculate payment for changed values
            $("#start_date").on('change', function(){
                getAllowance()
            })
            $("#return_date").on('change', function(){
                getAllowance()
            })
            $("#employee_id").on('change', function(){
                getAllowance()
            })
            $("#target_location").on('change', function(){
                getAllowance()
            })
            $("#btn-text").on('click', function(){
                getAllowance()
            })
        })
    </script>
@endsection