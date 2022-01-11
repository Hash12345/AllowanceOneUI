@extends('layouts.main')
@section('style_lib')
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div id="travel-allowance-block" class="block block-rounded block-mode-loading-oneui">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Travel Allowances</h3>
                        <div class="block-options">
                            <a href="javascript:void(0)" class="mr-2 btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-travel-allowance"><i class="fa fa-plus"></i> Add</button>
                            <a href="{{ route('reimburse.create', [ $allowance->id ])}}" class="mr-2"><i class="fa fa-save"></i> Save</a>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">መነሻ ቦታ</th>
                                    <th scope="col">ቀን</th>
                                    <th scope="col">ቁርስ</th>
                                    <th scope="col">ምሳ</th>
                                    <th scope="col">እራት</th>
                                    <th scope="col">የቀን ብዛት</th>
                                    <th scope="col">የዉሎ አበል መጠን</th>
                                    <th scope="col">የበርሃ አበል</th>
                                    <th scope="col">ድምር</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='table-travel-allowances'>
                                @if (count($travelAllowances)>0)
                                    @foreach ($travelAllowances as $travelAllowance)
                                        <tr id="row_{{$travelAllowance->id}}">
                                            <td>{{ $travelAllowance->startCity->name }}</td>
                                            <td>{{ $travelAllowance->start_date }}</td>
                                            @if (!$travelAllowance->breakfast)
                                                <td>-</td>
                                            @else
                                                <td>{{ $travelAllowance->breakfastCity->name }}</td>
                                            @endif
                                            @if (!$travelAllowance->lunch)
                                                <td>-</td>
                                            @else
                                                <td>{{ $travelAllowance->lunchCity->name }}</td>
                                            @endif
                                            @if (!$travelAllowance->dinner)
                                                <td>-</td>
                                            @else
                                                <td>{{ $travelAllowance->dinnerCity->name }}</td>
                                            @endif
                                            <td></td>
                                            <td>{{ $travelAllowance->travel_total }}</td>
                                            <td></td>
                                            <td>{{ $travelAllowance->travel_total }} </td>
                                            <td><a  href="javascript:void(0)" onclick="editTravelAllowance({{ $travelAllowance->id }})"><i class="fas fa-pencil-alt"  aria-hidden="true"></i> </a><a href="javascript:void(0)" onclick="removeTravelAllowance({{ $travelAllowance->id }})"><i class="fa fa-fw fa-times text-danger" aria-hidden="true"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="9" style="text-align: right;">ድምር፡</th>
                                        <th id="sum" >{{$allowance->travels_sum}}</th>
                                    </tr>           
                                @else
                                    <tr>
                                        <th colspan="8" style="text-align: center;">No Travel Allowance Yet. Please Register One</th>
                                        <th  style="text-align: right;">ድምር፡</th>
                                        <th id="sum" >{{$allowance->travels_sum}}</th>
                                    </tr>    
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="block-content block-content-full text-right border-top">
                        <a href="{{ route('reimburse.create', [$allowance->id])}}" class="btn btn-primary"><i class="si si-arrow-right"></i> Save and continue</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Toasts -->
    <div style="position: fixed; top: 2rem; right: 2rem; z-index: 9999999;">
        <!-- Toast Example 1 -->
        <div id="toast-success" class="toast fade hide" data-delay="4000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="si si-check text-primary mr-2"></i>
                <strong class="mr-auto">Travel allowance</strong>
                <small class="text-muted">success</small>
                <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Travel allowance created successfully.
            </div>
        </div>
        <!-- END Toast Example 1 -->
    </div>


    {{-- add travel allowance modal --}}
    <div class="modal fade" id="modal-add-travel-allowance" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Add Travel Allowance</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="allowance_id" id="allowance_id" value="{{ $allowance->id }}">
                        <div class="form-group row">
                            <label for="start_place" class="col-sm-3 col-form-label">መነሻ ቦታ፡</label>
                            <div class="col-md-6">
                                <select id="start_place" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="start_date" class="col-md-3 col-form-label">ቀን:</label>
                            <div class="col-md-6">
                                <input required id="start_date" class="form-control" type='date' placeholder="ቀን" />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="breakfast" class="col-md-3 col-form-label">ቁርስ:</label>
                            <div class="col-md-6">
                                <select id="breakfast" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                                
                            <label for="lunch" class="col-md-3 col-form-label">ምሳ:</label>
                            <div class="col-md-6">
                                <select id="lunch" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dinner" class="col-md-3 col-form-label">እራት:</label>
                            <div class="col-md-6">
                                <select id="dinner" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-outline-primary mr-1" data-dismiss="modal">Close</button>
                        <button id="btn-save" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- edit travel allowance modal --}}
    <div class="modal fade" id="modal-edit-travel-allowance" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Edit Travel Allowance</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="edit_allowance_id" id="edit_allowance_id"  }}">
                        <div class="form-group row">
                            <label for="edit_start_place" class="col-sm-3 col-form-label">መነሻ ቦታ፡</label>
                            <div class="col-md-6">
                                <select id="edit_start_place" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach    
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="edit_start_date" class="col-md-3 col-form-label">ቀን:</label>
                            <div class="col-md-6">
                                <input required id="edit_start_date" class="form-control" type='date' placeholder="ቀን" />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="edit_breakfast" class="col-md-3 col-form-label">ቁርስ:</label>
                            <div class="col-md-6">
                                <select id="edit_breakfast" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                                
                            <label for="edit_lunch" class="col-md-3 col-form-label">ምሳ:</label>
                            <div class="col-md-6">
                                <select id="edit_lunch" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_dinner" class="col-md-3 col-form-label">እራት:</label>
                            <div class="col-md-6">
                                <select id="edit_dinner" class="form-control">
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-outline-primary mr-1" data-dismiss="modal">Close</button>
                        <button id="btn-edit" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="modal-delete-travel-allowance">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h5 class="block-title">Confirm Delete?</h5>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                </div>  
                <div class="modal-body text-weight-700">
                    <h5 class="block-title">Do you want to delete Travel Allowance: <span class="font-weight-bold" id="travel-allowance-id"></span> ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm col-sm-2" data-dismiss="modal">Close</button>
                    <button id="btn-delete" class="btn btn-danger btn-sm col-sm-2" id="btnconfirm">Delete</button>
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
        //add data to table-travel-allowances table
        function addData(response){
            var tbltravel=document.getElementById('table-travel-allowances')
            tbltravel.innerHTML=""
            var data=""
            $.each(response.allowance.travel_allowances, function(key, value){
                data +=`<tr id="row_${value.id}">
                                <td>${ value.start_city.name }</td>
                                <td>${ value.start_date }</td>                                    
                                <td>${ value.breakfast_city.name }</td>                                            
                                <td>${ value.lunch_city.name }</td>
                                ${ value.dinner != null?`<td>  ${value.dinner_city.name} </td>`:'<td>-</td>' }
                                <td></td>
                                <td>${ value.travel_total }</td>
                                <td></td>
                                <td>${ value.travel_total } </td>
                                <td><a  href="javascript:void(0)" onclick="editTravelAllowance(${ value.id })"><i class="fas fa-pencil-alt"  aria-hidden="true"></i> </a><a href="javascript:void(0)" onclick="removeTravelAllowance(${ value.id })"><i class="fa fa-fw fa-times text-danger" aria-hidden="true"></i></a></td>
                            </tr>`
            })
            data +=`<tr>
                        <th colspan="9" style="text-align: right;">ድምር፡</th>
                        <th id="sum" >${response.allowance.travels_sum}</th>
                    </tr>`
            tbltravel.innerHTML=data
        }
        function removeTravelAllowance(id){            
            $("#btn-delete").data("id", id);
            $("#modal-delete-travel-allowance").modal("show");
        }

        function editTravelAllowance(id) {   
            $("#btn-edit").data('id', id)  
            let _url=`/allowance/travel_view/${id}/show`;
            $.ajax({
                type:"get",
                url:_url,
                success:function(response){      
                    $("#edit_allowance_id").val(response.travelallowance.allowance_id);
                    $("#edit_start_place").val(response.travelallowance.start_place);
                    $("#edit_start_date").val(response.travelallowance.start_date);
                    $("#edit_breakfast").val(response.travelallowance.breakfast);
                    $("#edit_lunch").val(response.travelallowance.lunch);
                    $("#edit_dinner").val(response.travelallowance.dinner);
                    $("#modal-edit-travel-allowance").modal('show');
                }

            }) 
        }
        $(document).ready(function(){
            //apply select2 style theme to dropdown menus
            $("#start_place").select2({
                theme:'bootstrap4'
                })
            $("#breakfast").select2({
                theme:'bootstrap4'
                })
            $("#lunch").select2({
                theme:'bootstrap4'
                })
            $("#dinner").select2({
                theme:'bootstrap4'
                })
            //delete travel allowance
            $("#btn-delete").on("click", function(){
                let id=$(this).data("id");
                let _url=`/allowance/travel_view/${id}`;
                let _token=$("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type:"DELETE",
                    url:_url,
                    data:{
                        _token:_token
                    },
                    success: function(response) {  
                        addData(response)
                        $("#modal-delete-travel-allowance").modal("hide")
                    }
                });
            })

            //create travel allowance
            $("#btn-save").on("click", function(){
                One.block('state_toggle', '#travel-allowance-block')
                let _url="{{ route('travelallowance.store')}}"
                let _token=$("meta[name='csrf-token']").attr("content")
                $("#modal-add-travel-allowance").modal("hide")
                $.ajax({
                    type:"POST",
                    url:_url,
                    data:{
                        allowance_id:$("#allowance_id").val(),
                        start_place:$("#start_place").val(),
                        start_date:$("#start_date").val(),
                        breakfast:$("#breakfast").val(),
                        lunch:$("#lunch").val(),
                        dinner:$("#dinner").val(),
                        _token:_token
                    },
                    success:function(response){
                        addData(response)
                        One.block('state_toggle', '#travel-allowance-block')
                        $("#toast-success").toast('show')
                    }
                })
            })

            //edit travel allowance
            $("#btn-edit").on("click", function(){
                let _id=$(this).data('id');
                let _url=`/allowance/travel_view/${_id}`
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"PUT",
                    url:_url,
                    data:{
                        allowance_id:$("#edit_allowance_id").val(),
                        start_place:$("#edit_start_place").val(),
                        start_date:$("#edit_start_date").val(),
                        breakfast:$("#edit_breakfast").val(),
                        lunch:$("#edit_lunch").val(),
                        dinner:$("#edit_dinner").val(),
                        _token:_token
                    },
                    success:function(response){
                        addData(response)
                        $("#modal-edit-travel-allowance").modal("hide")
                    }
                })
            })
        })
    </script>
@endsection