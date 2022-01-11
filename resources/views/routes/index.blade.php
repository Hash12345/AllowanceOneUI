@extends('layouts.main')
@section('style_lib')
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2-bootstrap4.min.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">City Routes</h3>
                        <div class="block-options">
                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-add-route"><i class="fa fa-plus"></i> New Route </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>መነሻ ቦታ</th>
                                    <th>መድረሻ ቦታ</th>
                                    <th>ቁርስ</th>
                                    <th>ምሳ</th>
                                    <th>እራት</th>
                                    <th>ምርመራ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($routes as $route)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$route->startlocation->name}}</td>
                                        <td>{{$route->targetlocation->name}}</td>
                                        <td>{{$route->breakfastcity->name}}</td>
                                        <td>{{$route->lunchcity->name}}</td>
                                        <td>{{$route->dinnercity->name}}</td>
                                        @if ($route->route == 0)
                                            <td>መሄጃ</td>
                                        @else
                                            <td>መመለሻ</td>
                                        @endif
                                        <td><a href="#" onclick="editRoute({{ $route->id }})"><i class="fa fa-fw fa-pencil-alt"></i></a> <a href="#" onclick="removeRoute({{ $route->id }})"><i class="fa fa-fw fa-times text-danger"></i></a></td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Route Modal -->
    <div class="modal fade" id="modal-add-route" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Create Route</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-content">
                        <div class="form-group row m-3">
                            <label class="d-block offset-3 col-md-4 text-right">የጉዞ አይነት</label>
                            <div class="col-md-5">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="route1" name="route" value="0" checked>
                                    <label class="custom-control-label" for="route1">መሄጃ</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="route2" name="route" value="1">
                                    <label class="custom-control-label" for="route2">መመለሻ</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-3">
                            <label for="start_location" class="form-label">መነሻ ቦታ</label>
                            <select name="start_location" id="start_location" class="form-control @error('start_location') is-invalid @enderror" style="width: 100%">
                                
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="target_location" class="form-label">መድረሻ ቦታ</label>
                            <select name="target_location" id="target_location" class="form-control @error('target_location') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="breakfast" class="form-label">ቁርስ</label>
                            <select name="breakfast" id="breakfast" class="form-control @error('breakfast') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="lunch" class="form-label">ምሳ</label>
                            <select name="lunch" id="lunch" class="form-control @error('lunch') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="dinner" class="form-label">እራት</label>
                            <select name="dinner" id="dinner" class="form-control @error('dinner') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
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

    <!-- Edit Route Modal -->
    <div class="modal fade" id="modal-edit-route" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Edit Route</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-content">
                        <input type="hidden" id="edit_route_id" name="edit_route_id">
                        <div class="form-group row m-3">
                            <label class="d-block offset-3 col-md-4 text-right">የጉዞ አይነት</label>
                            <div class="col-md-5">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="edit_route1" name="edit_route" value="0">
                                    <label class="custom-control-label" for="edit_route1">መሄጃ</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="edit_route2" name="edit_route" value="1">
                                    <label class="custom-control-label" for="edit_route2">መመለሻ</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-3">
                            <label for="edit_start_location" class="form-label">መነሻ ቦታ</label>
                            <select name="edit_start_location" id="edit_start_location" class="form-control @error('edit_start_location') is-invalid @enderror" style="width: 100%">
                                
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="edit_target_location" class="form-label">መድረሻ ቦታ</label>
                            <select name="edit_target_location" id="edit_target_location" class="form-control @error('edit_target_location') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="edit_breakfast" class="form-label">ቁርስ</label>
                            <select name="edit_breakfast" id="edit_breakfast" class="form-control @error('edit_breakfast') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="edit_lunch" class="form-label">ምሳ</label>
                            <select name="edit_lunch" id="edit_lunch" class="form-control @error('edit_lunch') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
                        </div>
                        <div class="form-group m-3">
                            <label for="edit_dinner" class="form-label">እራት</label>
                            <select name="edit_dinner" id="edit_dinner" class="form-control @error('edit_dinner') is-invalid @enderror">
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}'> {{ $city->name }} </option>
                                @endforeach                                        
                            </select>
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
    <div class="modal" id="modal-delete-route">
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
                    <h5 class="block-title">Do you want to delete route: <span class="font-weight-bold" id="routeId"></span> ?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm col-sm-2" data-dismiss="modal">Close</button>
                    <button id="delete" class="btn btn-danger btn-sm col-sm-2" id="btnconfirm">Delete</button>
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
        function removeRoute(id){            
            $("#delete").data("id", id);
            $("#modal-delete-route").modal("show");
        }
        function editRoute(id) {            
            let _url=`/routes/${id}`;
            $.ajax({
                type:"get",
                url:_url,
                success:function(response){                   
                    if(response.route.route == 0){
                        $("#edit_route1").prop('checked', true)
                    }
                    else{
                        $("#edit_route2").prop('checked', true)
                    }
                    $("#edit_start_location").val(response.route.start_location);
                    $("#edit_target_location").val(response.route.target_location);
                    $("#edit_breakfast").val(response.route.breakfast);
                    $("#edit_lunch").val(response.route.lunch);
                    $("#edit_dinner").val(response.route.dinner);
                    $("#edit_route_id").val(response.route.id);
                    $("#modal-edit-route").modal('show');
                }

            }) 
        }
        $(document).ready(function(){
            $("#start_location").select2({
                placeholder:"select an option",
                theme:'bootstrap4'
            })
            $("#target_location").select2({
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
            
            $("#delete").on("click", function(){
                let id=$(this).data("id");
                let _url=`/routes/${id}`;
                let _token=$("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type:"DELETE",
                    url:_url,
                    data:{
                        _token:_token
                    },
                    success: function(response) {    
                        $("#modal-delete-route").modal("hide")
                    }
                });
            })
            //add route
            $("#btn-save").on("click", function(){
                let _url="{{ route('routes.store')}}"
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"POST",
                    url:_url,
                    data:{
                        start_location:$("#start_location").val(),
                        target_location:$("#target_location").val(),
                        breakfast:$("#breakfast").val(),
                        lunch:$("#lunch").val(),
                        dinner:$("#dinner").val(),
                        route:$("input[name='route']:checked").val(),
                        _token:_token
                    },
                    success:function(response){
                        $("#modal-add-route").modal("hide")
                        //console.log(response)
                    }
                })
            })
            //edit route
            $("#btn-edit").on("click", function(){
                let _id=$("#edit_route_id").val();
                let _url=`/routes/${_id}`
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"PUT",
                    url:_url,
                    data:{
                        start_location:$("#edit_start_location").val(),
                        target_location:$("#edit_target_location").val(),
                        breakfast:$("#edit_breakfast").val(),
                        lunch:$("#edit_lunch").val(),
                        dinner:$("#edit_dinner").val(),
                        route:$("input[name='edit_route']:checked").val(),
                        _token:_token
                    },
                    success:function(response){
                        $("#modal-edit-route").modal("hide")
                        console.log(response)
                    }
                })
            })
    })
    </script>
@endsection
