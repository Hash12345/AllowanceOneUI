@extends('layouts.main')
@section('style_lib')
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2-bootstrap4.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @if ($message=Session::get('success'))
                <div class="alert alert-success alert-dismissable" role="alert">
                    <button class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <p class="mb-0">{{ $message }}</p>
                </div>
                @endif
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Allowances</h3>
                        <div class="block-options">
                            <a href="{{ route('allowances.create')}}" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Create Allowance</a>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="btn-group mb-3" role="group">
                            <button id="btn-all" class="btn btn-primary active">All</button>
                            <button id="btn-reimburse" class="btn btn-primary ">Reimbursed</button>
                            <button id="btn-suspense" class="btn btn-primary">Suspense</button>
                            <button id="btn-expired" class="btn btn-primary">Expired</button>
                        </div>
                        <table id="tblAllowances" class="table table-bordered table-striped table-vcenter dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="d-none d-sm-table-cell" style="width: 30%;">ስም</th>
                                    <th>ቦታ</th>
                                    <th class="" style="">ቀን</th>
                                    <th class="" style="">የቆይታ ጊዜ /ቀን/</th>
                                    <th class="" style="">ምርመራ</th>
                                    <th class="" style="width: 15%;">Action</th>
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

    <!-- Add Allowance Modal -->
    {{-- <div class="modal fade" id="modal-add-allowance" role="dialog">
        <div class="modal-dialog modal-dialog-popout modal-xl">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header border-bottom bg-primary-dark">
                        <h3 class="block-title">የሰራተኞች አበል መመዝገቢያ ቅጥ</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-content content">                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label for="employee_id"  class="col-form-label col-md-3">የሰራተኛዉ ስም፡ </label>
                                    <div class="col-md-9">
                                        <select name="employee_id" id="employee_id" class="form-control form-control-sm">
                                            @foreach ($employees as $employee)
                                                <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                                            @endforeach                                   
                                        </select>
                                    </div>
                                </div>
                                <div class="row">                        
                                    <div class="form-group row col-6">
                                        <label for="start_location" class="col-form-label col-md-4"> መነሻ ቦታ፡ </label>
                                        <div class="col-md-8">
                                            <select name="start_location" id="start_location" class="form-control form-control-sm">
                                                @foreach ($cities as $city)
                                                    @if ($city->name=="ደሴ")
                                                        <option value="{{$city->id}}" selected>{{$city->name}}</option>                                        
                                                    @else
                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endif
                                                @endforeach                                   
                                            </select>
                                        </div>
                                    </div>                   
                                    <div class="form-group row col-6">
                                        <label for="target_location" class="col-form-label col-md-4"> መድረሻ ቦታ፡ </label>
                                        <div class="col-md-8">
                                            <select name="target_location" id="target_location" class="form-control form-control-sm">
                                                @foreach ($cities as $city)
                                                    @if ($city->name=="አዲስ አበባ")
                                                        <option value="{{$city->id}}" selected>{{$city->name}}</option>                                        
                                                    @else
                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                    @endif
                                                @endforeach                                   
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group row col-6">
                                        <label for="start_date" class="col-form-label col-md-4"> መነሻ ቀን፡ </label>
                                        <div class="col-md-8">
                                            <input class="form-control form-control-sm" type="date" id="start_date" name="start_date" >
                                        </div>
                                    </div>
                                    <div class="form-group row col-6">
                                        <label for="return_date" class="col-form-label col-md-4"> መመለሻ ቀን፡ </label>
                                        <div class="col-md-8">
                                            <input class="form-control form-control-sm" type="date" id="return_date" name="return_date" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="trip_reason" class="col-form-label col-md-3"> የጉዞ አላማ/ምክንያት፡ </label>
                                    <div class="col-md-9">
                                        <textarea name="trip_reason" id="trip_reason"  rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 border-left">
                                <h3 class="text-center">ክፍያ</h3>
                                <div class="form-group row m-1">
                                    <label for="trip_allowance" class="col-md-6 text-right">ለዉሎ አበል፡</label>
                                    <div class="col-md-4">
                                        <input type="number" name="trip_allowance" id="trip_allowance" class="form-control form-control-sm" value="0" disabled>
                                    </div>
                                </div>
                                <div class="form-group row m-1">
                                    <label for="transport_allowance" class="col-md-6 text-right">ትራንስፓርት፡</label>
                                    <div class="col-md-4">
                                        <input type="number" name="transport_allowance" id="transport_allowance" class="form-control form-control-sm" value="0" disabled>
                                    </div>
                                    <a href="javascript:void(0)" id="icon-transport"><i class="fas fa-pencil-alt"></i></a>
                                </div>
                                <div class="form-group row m-1">
                                    <label for="feul_allowance" class="col-md-6 text-right">ለነዳጅና ቅባት፡</label>
                                    <div class="col-md-4">
                                        <input type="number" name="feul_allowance" id="feul_allowance" class="form-control form-control-sm" value="0" disabled>
                                    </div>
                                    <a href="javascript:void(0)" id="icon-feul"><i class="fas fa-pencil-alt"></i></a>
                                </div>
                                <div class="form-group row m-1">
                                    <label for="other_expense" class="col-md-6 text-right">ተጨማሪ፡</label>
                                    <div class="col-md-4">
                                        <input type="number" name="other_expense" id="other_expense" class="form-control form-control-sm" value="0" disabled>
                                    </div>
                                    <a href="javascript:void(0)" id="icon-other"><i class="fas fa-pencil-alt"></i></a>
                                </div>
                                <h4 class="border-top text-right text-primary mr-3">ድምር፡ <span id="total" >0</span> ብር</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 id="message"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-outline-primary mr-1" data-dismiss="modal">Close</button>
                        <button id="btn-save" type="submit" class="btn btn-primary">Save</button>
                        <button id="btn-text" class="btn btn-secondary">Calculate</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="modal-delete-allowance">
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
                    <h5 class="block-title">Do you want to delete Allowance Id: <span class="font-weight-bold" id="span-id"></span> ?</h5>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
    {{-- Toaster JS Plugin --}}
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
                        $("#trip_allowance").val(sum )
                        total()
                        //$("#total").text(sum)
                        $("#message").text(`${difference} ቀን * ${response.allowance} ብር= ${sum} ብር`)
                    }
                })                                          
            }            
        }

        //Remove Allowance
        function removeAllowance(id){            
            $("#btn-delete").data("id", id)
            $("#modal-delete-allowance").modal("show")
            $("#span-id").text(id)
        }

        //Edit Stay Allowance
        function editAllowance(id) { 
            //$("#modal-edit-allowance").modal('show');  
            $("#btn-edit").data('id', id)  
            let _url=`/allowances/${id}/show`;
            $.ajax({
                type:"get",
                url:_url,
                success:function(response){      
                    $("#edit_allowance_id").val(response.allowance.allowance_id);
                    $("#edit_from_date").val(response.allowance.from_date);
                    $("#edit_to_date").val(response.allowance.to_date);
                    $("#edit_location").val(response.allowance.location);
                    $("#modal-edit-stay-allowance").modal('show');
                }
            }) 
        }
        $(document).ready(function(){
            // Allowances table Datatable configuration
            // toaster.success("Hello User")
            let allowanceTable = $('#tblAllowances').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('allowanceajax') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'target_location', name: 'target_location'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'days_count', name: 'days_count'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $("#btn-toast").on('click', function(){
                console.log("hello")
                toastr.error("Error Occured, Check your data", 'Error')
            })
            $('#modal-add-allowance').on('hidden.bs.modal', function () {
                $("#transport_allowance").val('0')
                $("#feul_allowance").val('0')
                $("#other_expense").val('0')
                $("#trip_allowance").val('0')
                $("#feul_allowance").prop('disabled', true)
                $("#other_expense").prop('disabled', true)
                $("#trip_allowance").prop('disabled', true)
                $("#start_date").val('')
                $("#return_date").val('') 
                $("#trip_reason").text('') 
                $("#total").text(0) 
                $("#message").text('')
            });
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
            $('#start_location').select2({
                'theme':"bootstrap4"
            })
            $('#employee_id').select2({
                'theme':"bootstrap4"
            })
            $('#target_location').select2({
                'theme':"bootstrap4"
            })
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
            //Save Allowance
            $("#btn-save").on("click", function(){
                let _url="{{ route('allowances.store')}}"
                let _token=$("meta[name='csrf-token']").attr("content")
                $.ajax({
                    type:"POST",
                    url:_url,
                    data:{
                        employee_id:$("#employee_id").val(),
                        start_location:$("#start_location").val(),
                        target_location:$("#target_location").val(),
                        trip_reason:$("#trip_reason").val(),
                        start_date:$("#start_date").val(),
                        return_date:$("#return_date").val(),
                        trip_allowance:$("#trip_allowance").val(),
                        fuel_allowance:$("#fuel_allowance").val(),
                        _token:_token
                    },
                    success:function(response){
                        $("#modal-add-allowance").modal("hide")
                    }
                })
            })

            //Delete Allowance
            $("#btn-delete").on("click", function(){
                let id=$(this).data("id");
                let _url=`/allowances/${id}`;
                let _token=$("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type:"DELETE",
                    url:_url,
                    data:{
                        _token:_token
                    },
                    success: function(response) {  
                        //addData(response)
                        $("#modal-delete-allowance").modal("hide")
                        allowanceTable.ajax.reload();
                    }
                });
            })

            //Reimbersed List
            $("#btn-reimburse").on('click', function(){
                if(allowanceTable != null ){
                    allowanceTable.destroy()
                    allowanceTable = $('#tblAllowances').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('re') }}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'user_id', name: 'user_id'},
                            {data: 'target_location', name: 'target_location'},
                            {data: 'start_date', name: 'start_date'},
                            {data: 'days_count', name: 'days_count'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $(this).addClass('active')
                    $("#btn-all").removeClass('active')
                    $("#btn-suspense").removeClass('active')
                    $("#btn-expired").removeClass('active')

                }
            })
            // all allowances list
            $("#btn-all").on('click', function(){
                if(allowanceTable != null ){
                    allowanceTable.destroy()
                    allowanceTable = $('#tblAllowances').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('allowanceajax') }}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'user_id', name: 'user_id'},
                            {data: 'target_location', name: 'target_location'},
                            {data: 'start_date', name: 'start_date'},
                            {data: 'days_count', name: 'days_count'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $(this).addClass('active')
                    $("#btn-reimburse").removeClass('active')
                    $("#btn-suspense").removeClass('active')
                    $("#btn-expired").removeClass('active')

                }
            })

            // suspense allowances list
            $("#btn-suspense").on('click', function(){
                if(allowanceTable != null ){
                    allowanceTable.destroy()
                    allowanceTable = $('#tblAllowances').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('se') }}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'user_id', name: 'user_id'},
                            {data: 'target_location', name: 'target_location'},
                            {data: 'start_date', name: 'start_date'},
                            {data: 'days_count', name: 'days_count'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
                    });
                    $(this).addClass('active')
                    $("#btn-reimburse").removeClass('active')
                    $("#btn-all").removeClass('active')
                    $("#btn-expired").removeClass('active')

                }
            })
        })
    </script>
@endsection