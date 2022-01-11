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
                        <h4 class="m-2">የሰራተኞች አበልና መጓጓዣ ወጭ መጠየቂያና መፍቀጃ ቅጽ</h4>
                        <div class="block-options">
                            @if ($allowance->status == 0)
                                @if (auth()->user()->role == 'head')
                                    <a class="btn btn-success btn-sm" href="javascript:void(0)" onclick="approveAllowance({{$allowance->id}})"><i class="fas fa-check"></i> Approve</a> <a class="btn btn-danger btn-sm" href="javascript:void(0)" onclick="rejectAllowance( {{$allowance->id}})"><i class="fas fa-times-circle" style=""></i> Reject</a>
                                @else  
                                    <div class="text-warning">Waiting for approval... </div>
                                @endif
                            @else
                                @if ($allowance->status == 1)
                                    <div class="text-danger">this allowance is rejected <a  href="javascript:void(0)" data-toggle="modal" data-target="#modal-message">show message</a></div>
                                 @else
                                    <div class="text-success">this allowance is Accepted <a  href="javascript:void(0)" data-toggle="modal" data-target="#modal-message">show message</a></div>
                                @endif                                
                            @endif
                        </div>
                    </div>
                    <div class="block-content  bg-body-light">
                        <div class="d-flex justify-content-around">  
                            <div class="col-md-4">
                                <div class="block block-rounded block-themed">
                                    <div class="block-header bg-primary">
                                        <h3 class="block-title">የሰራተኛዉ መረጃ</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group mb-0">
                                            <label for="employee_id"  class="col-form-label">ሙሉ ስም፡ </label>
                                            <span class="text-right">{{ $allowance->user->full_name }}</span>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="" class="col-form-label"> የስራ ከፍል፡ </label>
                                            <span>{{  $allowance->user->department->name}}</span>                                                
                                        </div> 
                                        <div class="form-group mb-0">
                                            <label for="" class="col-form-label"> የስራ ድርሻ፡ </label>
                                            <span>{{  $allowance->user->job_title}}</span>                                                
                                        </div> 
                                        <div class="form-group mb-0">
                                            <label for="" class="col-form-label"> ደመወዝ፡ </label>
                                            <span>{{  number_format($allowance->user->salary,2)}}</span>                                   
                                        </div>                                
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="block block-rounded block-themed">
                                    <div class="block-header bg-success">
                                        <h3 class="block-title">የአበል ሁኔታ መግለጫ</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group mb-0">
                                            <label for="start_location" class="col-form-label"> መነሻ ቦታ፡ </label>
                                            <span>{{ $allowance->startCity->name}}</span>                                                
                                        </div> 
                                        <div class="form-group mb-0">
                                            <label for="target_location" class="col-form-label"> መድረሻ ቦታ፡ </label>
                                            <span>{{ $allowance->targetCity->name}}</span>                                   
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="start_date" class="col-form-label"> መነሻ ቀን፡ </label>                                                
                                            <span>{{ $allowance->start_date}}</span>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="return_date" class="col-form-label"> መመለሻ ቀን፡ </label>
                                            <span>{{ $allowance->return_date}}</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="trip_reason" class="col-form-label"> የጉዞ አላማ፡ </label>
                                            <span>{{ $allowance->trip_reason}}</span>
                                        </div>                                
                                    </div>
                                </div>    
                            </div>  
                            <div class="col-md-4">
                                <div class="block block-rounded block-themed">
                                    <div class="block-header bg-info">
                                        <h3 class="block-title">በቅድሚያ የተከፈለ ብር</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="d-flex justify-content-between">
                                            <label for="trip_allowance" class="">አበል፡</label>
                                            <div><span class="text-right">{{ ($allowance->trip_allowance) ? number_format( $allowance->trip_allowance,2) : 0}} ብር</span></div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <label for="transport_allowance" class="">ትራንስፓርት፡</label>
                                            <div><span class="text-right">{{ ($allowance->transport_allowance) ? number_format($allowance->transport_allowance, 2) : 0}} ብር</span></div>                                   
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <label for="feul_allowance" class="text-md-right">ለነዳጅና፡</label>
                                            <div><span class="text-right">{{ ($allowance->fuel_allowance) ? number_format( $allowance->fuel_allowance, 2) : 0 }} ብር</span></div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <label for="other_expense" class="text-md-right">ተጨማሪ፡</label>
                                            <div>{{ ($allowance->reserve) ? number_format($allowance->reserve, 2) : 0}} ብር</div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">                                    
                                            <div><strong>ድምር፡</strong></div>
                                            <div class="text-success"><span id="total">{{ number_format($allowance->trip_allowance + $allowance->transport_allowance + $allowance->fuel_allowance + $allowance->other_expense, 2)  }}</span> ብር</div>
                                        </div>                                                                
                                    </div>
                                </div>
                            </div>                     
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Travel allowance -->
        <div class="row">
            <div class="col-12">
                <div class="block block-round">
                    <div class="block-header">
                        <h5 class="font-w700">ሰራተኛዉ በጉዞ ላይ የቆዩበት ቦታዎች /ለቁርስ፣ ለምሳ፣ ለእራት/ መግለጫ ሰንጠረዥ</h5>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">መነሻ ቦታ</th>
                                    <th scope="col">ቀን</th>
                                    <th scope="col">ቁርስ</th>
                                    <th scope="col">ምሳ</th>
                                    <th scope="col">እራት</th>
                                    <th scope="col">የዉሎ አበል መጠን</th>
                                    <th scope="col">የበርሃ አበል</th>
                                    <th scope="col">ድምር</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($allowance->travelAllowances) > 0)
                                    @foreach ($allowance->travelAllowances as $data)
                                        <tr>
                                            <td>{{ $data->startCity->name }}</td>
                                            <td>{{ $data->start_date }}</td>
                                            <td>{{ $data->breakfastCity->name }}</td>
                                            <td>{{ $data->lunchCity->name }}</td>
                                            @if ($data->dinner)
                                                <td>{{ $data->dinnerCity->name }}</td>
                                            @else
                                            <td>-</td>
                                            @endif                                                
                                            <td>{{ $data->travel_total }}</td>
                                            <td></td>
                                            <td>{{ $data->travel_total }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="7" style="text-align: right;">ድምር፡</th>
                                        <th >{{ $allowance->travels_sum }}</th>
                                    </tr>
                                @else
                                <tr>
                                    <th colspan="7" style="text-align: center;">No Travel Allowance Yet. Please Register One</th>
                                    <th  style="text-align: right;">ድምር፡</th>
                                    <th id="sum" >{{$allowance->travels_sum}}</th>
                                </tr> 
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stay allowance -->
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h5 class="font-w700">ሰራተኛዉ ለስራ በቆዩባቸው ቦታዎች መግለጫ ሰንጠረዥ</h5>
                    </div>                                    
                    <div class="block-content  block-content-full">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ቀን</th>
                                    <th scope="col">ለስራ የታደረበት ቦታ</th>
                                    <th scope="col">የቀን ብዛት</th>
                                    <th scope="col">የዉሎ አበል</th>
                                    <th scope="col">የበረሃ አበል</th>
                                    <th scope="col">ድምር</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($allowance->stayAllowances) > 0)
                                    @foreach ($allowance->stayAllowances as $stayAllowance)
                                        <tr>
                                            @if (!$stayAllowance->to_date)
                                                <td><b>በ</b> {{ $stayAllowance->from_date }}</td>
                                            @else
                                                <td><b>ከ</b>{{ $stayAllowance->from_date }} <b>እስከ</b> {{ $stayAllowance->to_date }}  </td>
                                            @endif
                                            @if (!$stayAllowance->location)
                                                <td>-</td>
                                            @else
                                                <td>{{ $stayAllowance->city->name }}</td>
                                            @endif
                                            @if ($stayAllowance->days_count == 1)
                                                <td>40 %</td>                                                
                                            @else
                                                <td>{{$stayAllowance->days_count}} ቀን </td>
                                            @endif
                                            <td>{{ $stayAllowance->stay_total }}</td>
                                            <td></td>
                                            <td>{{ $stayAllowance->stay_total }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="5" style="text-align: right;">ድምር፡</th>
                                        <th >{{$allowance->stays_sum}}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <th colspan="8" style="text-align: center;">No Stay Allowance Yet. Please Register One</th>
                                        <th  style="text-align: right;">ድምር፡</th>
                                        <th >{{$allowance->stays_sum}}</th>
                                    </tr>  
                                @endif
                                <tr>
                                    <th colspan="5" style="text-align: right;">ጠቅላላ ድምር፡</th>
                                    <th >{{$allowance->allowance_payment}}</th>
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Message Modal --}}
    <div class="modal" id="modal-message">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h5 class="block-title">Approval Reason</h5>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>  
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message" class="col-form-label">Reason</label>
                            <div>{{ $allowance->message}}</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Approved By</label>
                            @if (!$allowance->approved_by)
                                <div>-</div>
                            @else
                                <div>{{ $allowance->approvedBy->full_name}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Approval Date</label>
                            <div>{{ $allowance->approved_date}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()-> user()->role="head")
        <!-- Message Acceptanced Modal -->
        <div class="modal" id="modal-accept">
            <div class="modal-dialog modal-dialog-popout">
                <div class="modal-content">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h5 class="block-title">Write Reason?</h5>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>  
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageAccept" class="col-form-label">Reason</label>
                            <textarea name="messageAccept" id="messageAccept" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary btn-sm col-sm-2" data-dismiss="modal">Close</button>
                        <button class="btn btn-success btn-sm col-sm-2" id="btnaccept">save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Message Rejected Modal -->
        <div class="modal" id="modal-reject">
            <div class="modal-dialog modal-dialog-popout">
                <div class="modal-content">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h5 class="block-title">Write Reason?</h5>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>  
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageReject" class="col-form-label">Reason</label>
                            <textarea name="messageReject" id="messageReject" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary btn-sm col-sm-2" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger btn-sm col-sm-2" id="btnreject">save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('scripts_lib')
    <script src="{{ asset('OneUI/assets/js/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection
@section('scripts')
    <script>
        function approveAllowance(id){
            $("#modal-accept").modal('show')
            $("#btnaccept").data('id', id)
        }   
        function rejectAllowance(id){
            $("#modal-reject").modal('show')
            $("#btnreject").data('id', id)
        }
        $(document).ready(function(){
            //accept Allowance
            $("#btnaccept").on("click", function(){
                let _url="{{ route('allowance.approve')}}"
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"POST",
                    url:_url,
                    data:{
                        id:$(this).data('id'),
                        message:$("#messageAccept").val(),
                        _token:_token
                    },
                    success:function(response){
                        $("#modal-accept").modal("hide")
                        window.location.href="{{ route('home')}}";
                        //allowanceTable.ajax.reload();
                    }
                })
            })
            //reject Allowance
            $("#btnreject").on("click", function(){
                let _url="{{ route('allowance.reject')}}"
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"POST",
                    url:_url,
                    data:{
                        id:$(this).data('id'),
                        message:$("#messageReject").val(),
                        _token:_token
                    },
                    success:function(response){
                        $("#modal-reject").modal("hide")
                        window.location.href="{{ route('home')}}"
                        //allowanceTable.ajax.reload();
                    }
                })
            })
        })

    </script>
@endsection