@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div id="travel-allowance-block" class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Stay Allowances</h3>
                        <div class="block-options">
                            <a  href="javascript:void(0)" class="mr-2 btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-stay-allowance"><i class="fa fa-plus"></i> Add</button>                            
                            <a href="{{ route('reimburse.create', [ $allowance->id ])}}" class="mr-2"><i class="fa fa-save"></i> Save</a>
                        </div>
                    </div>
                    <div id="stay-allowance-toggle" class="block-content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ቀን</th>
                                    <th scope="col">ለስራ የታደረበት ቦታ</th>
                                    <th scope="col">የቀን ብዛት</th>
                                    <th scope="col">የዉሎ አበል</th>
                                    <th scope="col">የበረሃ አበል</th>
                                    <th scope="col">ድምር</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id='table-stay-allowances'>
                                @if (count($stayAllowances)>0)
                                    @foreach ($stayAllowances as $stayAllowance)
                                        <tr id="row_{{$stayAllowance->id}}">
                                            @if (!$stayAllowance->to_date)
                                                <td><b>በ</b> {{ $stayAllowance->from_date }}</td>
                                            @else
                                                <td><b>ከ</b>{{ $stayAllowance->from_date }} <b>እስከ</b> {{ $stayAllowance->to_date }}  </td>
                                            @endif
                                            @if (!$stayAllowance->location)
                                                <td>-</td>
                                            @else
                                                <td>{{ $stayAllowance->locationName->name }}</td>
                                            @endif
                                            @if ($stayAllowance->days_count == 1)
                                                <td>40 %</td>                                                
                                            @else
                                                <td>{{$stayAllowance->days_count}} ቀን </td>
                                            @endif
                                            <td>{{ $stayAllowance->stay_total }}</td>
                                            <td></td>
                                            <td>{{ $stayAllowance->stay_total }}</td>
                                            <td><a  href="javascript:void(0)" onclick="editStayAllowance({{ $stayAllowance->id }})"><i class="fas fa-pencil-alt"  aria-hidden="true"></i> </a><a href="javascript:void(0)" onclick="removeStayAllowance({{ $stayAllowance->id }})"><i class="fa fa-fw fa-times text-danger" aria-hidden="true"></i></a></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="6" style="text-align: right;">ድምር፡</th>
                                        <th >{{$allowance->stays_sum}}</th>
                                    </tr>           
                                @else
                                    <tr>
                                        <th colspan="8" style="text-align: center;">No Stay Allowance Yet. Please Register One</th>
                                        <th  style="text-align: right;">ድምር፡</th>
                                        <th >{{$allowance->stays_sum}}</th>
                                    </tr>    
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="block-content block-content-full text-right border-top">
                        <a href="{{ route('reimburse.create', [$allowance->id])}}" class="btn btn-primary">Save and continue</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    
    {{-- add stay allowance modal --}}
    <div class="modal fade" id="modal-add-stay-allowance" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Add Stay Allowance</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="allowance_id" id="allowance_id" value="{{ $allowance->id }}">
                        <div class="form-group row">
                            <label for="from_date" class="col-md-3 col-form-label">ከ ቀን:</label>
                            <div class="col-md-6">
                                <input required id="from_date" class="form-control" type='date' placeholder="ከ ቀን" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="to_date" class="col-md-3 col-form-label">እስከ ቀን:</label>
                            <div class="col-md-6">
                                <input required id="to_date" class="form-control" type='date' placeholder="እስከ ቀን" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-3 col-form-label">ቦታ፡</label>
                            <div class="col-md-6">
                                <select id="location" class="form-control">
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

    {{-- edit stay allowance modal --}}
    <div class="modal fade" id="modal-edit-stay-allowance" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Edit Stay Allowance</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <input type="hidden" name="edit_allowance_id" id="edit_allowance_id" >
                        <div class="form-group row">
                            <label for="edit_from_date" class="col-md-3 col-form-label">ከ ቀን:</label>
                            <div class="col-md-6">
                                <input required id="edit_from_date" class="form-control" type='date' placeholder="ከ ቀን" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_to_date" class="col-md-3 col-form-label">እስከ ቀን:</label>
                            <div class="col-md-6">
                                <input required id="edit_to_date" class="form-control" type='date' placeholder="እስከ ቀን" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_location" class="col-sm-3 col-form-label">ቦታ፡</label>
                            <div class="col-md-6">
                                <select id="edit_location" class="form-control">
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
     <div class="modal" id="modal-delete-stay-allowance">
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
                    <h5 class="block-title">Do you want to delete Stay Allowance: <span class="font-weight-bold" id="travel-allowance-id"></span> ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm col-sm-2" data-dismiss="modal">Close</button>
                    <button id="btn-delete" class="btn btn-danger btn-sm col-sm-2" id="btnconfirm">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        //add data to table-stay-allowances table
        function addData(response){
            var tbltravel=document.getElementById('table-stay-allowances')
            tbltravel.innerHTML=""
            var data=""
            $.each(response.allowance.stay_allowances, function(key, value){
                data +=`<tr id="row_${value.id}">
                            ${ value.to_date != null?`<td>  ከ${value.from_date} እስከ ${value.to_date} </td>`:`<td>በ${ value.from_date }</td>` }
                            <td>${ value.city.name }</td>
                            ${ value.days_count == 1?`<td>40%</td>`:`<td>${ value.days_count } ቀን</td>` }
                            <td>${ value.stay_total }</td>
                            <td></td>
                            <td>${ value.stay_total }</td>
                            <td><a  href="javascript:void(0)" onclick="editStayAllowance(${ value.id })"><i class="fas fa-pencil-alt"  aria-hidden="true"></i> </a><a href="javascript:void(0)" onclick="removeStayAllowance(${ value.id })"><i class="fa fa-fw fa-times text-danger" aria-hidden="true"></i></a></td>
                        </tr>`
            })
            data +=`<tr>
                        <th colspan="6" style="text-align: right;">ድምር፡</th>
                        <th id="sum" >${response.allowance.stays_sum}</th>
                    </tr>`
            tbltravel.innerHTML=data
        }

        //Edit Stay Allowance
        function editStayAllowance(id) {   
            $("#btn-edit").data('id', id)  
            let _url=`/allowance/stay_view/${id}/show`;
            $.ajax({
                type:"get",
                url:_url,
                success:function(response){      
                    $("#edit_allowance_id").val(response.stayallowance.allowance_id);
                    $("#edit_from_date").val(response.stayallowance.from_date);
                    $("#edit_to_date").val(response.stayallowance.to_date);
                    $("#edit_location").val(response.stayallowance.location);
                    $("#modal-edit-stay-allowance").modal('show');
                }
            }) 
        }

        //Remove Stay Allowance
        function removeStayAllowance(id){            
            $("#btn-delete").data("id", id);
            $("#modal-delete-stay-allowance").modal("show");
        }
        $(document).ready(function(){

            //delete stay allowance
            $("#btn-delete").on("click", function(){
                let id=$(this).data("id");
                let _url=`/allowance/stay_view/${id}`;
                let _token=$("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type:"DELETE",
                    url:_url,
                    data:{
                        _token:_token
                    },
                    success: function(response) {  
                        addData(response)
                        $("#modal-delete-stay-allowance").modal("hide")
                    }
                });
            })

            //create stay allowance
            $("#btn-save").on("click", function(){
                //One.block('state_toggle', '#travel-allowance-toggle')
                let _url="{{ route('stayallowance.store')}}"
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"POST",
                    url:_url,
                    data:{
                        allowance_id:$("#allowance_id").val(),
                        location:$("#location").val(),
                        from_date:$("#from_date").val(),
                        to_date:$("#to_date").val(),
                        _token:_token
                    },
                    success:function(response){
                        addData(response)
                        $("#modal-add-stay-allowance").modal("hide")
                        //console.log(response)
                        //One.block('state_toggle', '#travel-allowance-toggle')
                    }
                })
            })

             //edit stay allowance
             $("#btn-edit").on("click", function(){
                let _id=$(this).data('id');
                let _url=`/allowance/stay_view/${_id}`
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"PUT",
                    url:_url,
                    data:{
                        allowance_id:$("#edit_allowance_id").val(),
                        from_date:$("#edit_from_date").val(),
                        to_date:$("#edit_to_date").val(),
                        location:$("#edit_location").val(),
                        _token:_token
                    },
                    success:function(response){
                        addData(response)
                        $("#modal-edit-stay-allowance").modal("hide")
                    }
                })
            })
        })
    </script>
    
@endsection