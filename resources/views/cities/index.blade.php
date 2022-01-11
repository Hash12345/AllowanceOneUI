@extends('layouts.main')
@section('style_lib')
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2-bootstrap4.min.css')}}">
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
    @endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">City Allowances</h3>
                        <div class="block-options">
                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-add-city"><i class="fa fa-plus"></i> Create City </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table id="tblcityAllowances" class="table table-bordered table-striped table-vcenter dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>የከተማዉ ስም</th>
                                    <th>ክልል</th>
                                    <th>አበል 1</th>
                                    <th>አበል 2</th>
                                    <th>አበል 3</th>
                                    {{-- <th>አበል</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add City Modal -->
    <div class="modal fade" id="modal-add-city" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Create City</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-content">
                        <div class="form-group m-3">
                            <label for="name" class="form-label">የከተማዉ ስም</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm">
                        </div>
                        <div class="form-group m-3">
                            <label for="category_id" class="form-label">ክልል/ የከተማዉ አይነት </label>
                            <select name="category_id" id="category_id" class="form-control @error('city_category') is-invalid @enderror">
                                @foreach ($cityCategories as $category)
                                    <option value='{{ $category->id }}'> {{ $category->name }} </option>
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


    <!-- Edit City Modal -->
    <div class="modal fade" id="modal-edit-city" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Edit City</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-content">
                        <input type="hidden" id="edit_city_id" name="edit_city_id">
                        <div class="form-group m-3">
                            <label for="edit_name" class="form-label">የከተማዉ ስም</label>
                            <input type="text" name="edit_name" id="edit_name" class="form-control form-control-sm" value="">
                        </div>
                        <div class="form-group m-3">
                            <label for="edit_category_id" class="form-label">ክልል/ የከተማዉ አይነት</label>
                            <select name="edit_category_id" id="edit_category_id" class="form-control @error('edit_city_category') is-invalid @enderror">
                                @foreach ($cityCategories as $category)
                                    <option value='{{ $category->id }}'> {{ $category->name }} </option>
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
    <div class="modal" id="modal-delete-city">
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
                    <h5 class="block-title">Do you want to delete City with Id: <span class="font-weight-bold" id="cityId"></span> ?</h5>
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
    <!-- Page JS Plugins -->
    <script src="{{ asset('OneUI/assets/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('OneUI/assets/js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('OneUI/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('OneUI/assets/js/plugins/datatables/buttons/buttons.print.min.js')}}"></script>
    <script src="{{ asset('OneUI/assets/js/plugins/datatables/buttons/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('OneUI/assets/js/plugins/datatables/buttons/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('OneUI/assets/js/plugins/datatables/buttons/buttons.colVis.min.js')}}"></script>
    <!-- Page JS Code -->
    <script src="{{ asset('OneUI/assets/js/pages/be_tables_datatables.min.js')}}"></script>
@endsection
@section('scripts')
    <script>
        //Remove City
        function removeCity(id){            
            $("#delete").data("id", id);
            $("#cityId").text(id);
            $("#modal-delete-city").modal("show");
        }

        //Edit City
        function editCity(id) {            
            let _url=`/cities/${id}`;
            $.ajax({
                type:"get",
                url:_url,
                success:function(response){  
                    $("#edit_city_id").val(response.city.id);                 
                    $("#edit_name").val(response.city.name);
                    $("#edit_category_id").val(response.city.category_id);                    
                    $("#modal-edit-city").modal('show');
                }
            }) 
        }
        $(document).ready(()=>{
            //Initialize Data Table
            let cityTable= $("#tblcityAllowances").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('cities.ajax')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'allowance1', name: 'allowance1'},
                    {data: 'allowance2', name: 'allowance2'},
                    {data: 'allowance3', name: 'allowance3'},
                    {data: 'action', name: 'action',  orderable: false, searchable: false},
                ]

            })

            //Delete City
            $("#delete").on("click", function(){
                let id=$(this).data("id");
                let _url=`/cities/${id}`;
                let _token=$("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type:"DELETE",
                    url:_url,
                    data:{
                        _token:_token
                    },
                    success: function(response) {    
                        $("#modal-delete-city").modal("hide");
                        cityTable.ajax.reload();
                    }
                });
            })

        
            //Add City        
            $("#btn-save").on("click", function(){
                let _url="{{ route('cities.store')}}"
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"POST",
                    url:_url,
                    data:{
                        name:$("#name").val(),
                        category_id:$("#category_id").val(),
                        _token:_token
                    },
                    success:function(response){
                        $("#modal-add-city").modal("hide")
                        cityTable.ajax.reload();
                        //console.log(response)
                    }
                })
            })

            //Edit City
            $("#btn-edit").on("click", function(){
                let _id=$("#edit_city_id").val();
                let _url=`/cities/${_id}`
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"PUT",
                    url:_url,
                    data:{
                        name:$("#edit_name").val(),
                        category_id:$("#edit_category_id").val(),
                        _token:_token
                    },
                    success:function(response){
                        $("#modal-edit-city").modal("hide")
                        cityTable.ajax.reload();
                    }
                })
            })
        })
    </script>
@endsection
