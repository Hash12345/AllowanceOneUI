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
        {{-- dashboard area --}}
        <div class="row row-deck">
            <div class="col-sm-6 col-xl-3">
                <!-- All Allowances -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt id="dttotal" class="font-size-h2 font-w700">$ {{ number_format( $suspense_sum + $reimbursed_sum) }}</dt>
                            <dd class="text-muted mb-0">Used Budget</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a id="btn-pending" class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View more
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- Not Reimbursed -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt id="dtsuspense" class="font-size-h2 font-w700">$ {{number_format($suspense_sum)}}</dt>
                            <dd class="text-muted mb-0">Suspense Amount</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-ban font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a id="btn-rejected" class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View more
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- Reimbursed -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt id="dtreimbursed" class="font-size-h2 font-w700">$ {{number_format ($reimbursed_sum)}}</dt>
                            <dd class="text-muted mb-0">Reimbursed Amount</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-check font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a id="btn-approved" class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View more
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <!-- Reimbursed -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">$ 200K</dt>
                            <dd class="text-muted mb-0">Budget</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-money-check-alt font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View more
                            <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

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
                        <h3 id="message" class="block-title">Pending Allowances Payments</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <table id="tblAllowances" class="table table-bordered table-striped table-vcenter dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="d-none d-sm-table-cell" style="width: 30%;">ስም</th>
                                    <th>ቦታ</th>
                                    <th class="" style="">ቀን</th>
                                    <th class="" style="">የሚቆይበት የቀን ብዛት /ቀን/</th>
                                    <th class="" style="">የአበል መጠን /ብር</th>
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
        function approvePayment(id){
            $("#modal-accept").modal('show')
            $("#btnaccept").data('id', id)
        }   
        function rejectPayment(id){
            $("#modal-reject").modal('show')
            $("#btnreject").data('id', id)
        }
        $(document).ready(function(){
            let allowanceTable = $('#tblAllowances').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('home.finance') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'target_location', name: 'target_location'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'days_count', name: 'days_count'},
                    {data: 'amount', name: 'amount'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ],
                language: {infoEmpty:     "No pending allowance"}
            });

            //accept Allowance
            $("#btnaccept").on("click", function(){
                let _url="{{ route('allowance.approve.payment')}}"
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
                        $('#messageAccept').val('')
                        $("#dttotal").text('$' + (response.suspense_sum + response.reimbursed_sum).toFixed(2) )
                        $("#dtreimbursed").text('$' + (response.reimbursed_sum).toFixed(2))
                        $("#dtsuspense").text('$' + (response.suspense_sum).toFixed(2))
                        allowanceTable.ajax.reload();
                    }
                })
            })
            //reject Allowance
            $("#btnreject").on("click", function(){
                let _url="{{ route('allowance.reject.payment')}}"
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
                        $('#messageReject').val('')
                        $("#dttotal").text('$' + (response.suspense_sum + response.reimbursed_sum).toFixed(2) )
                        $("#dtreimbursed").text('$' + (response.reimbursed_sum).toFixed(2))
                        $("#dtsuspense").text('$' + (response.suspense_sum).toFixed(2))
                        allowanceTable.ajax.reload();
                    }
                })
            })
            //pending list
            $("#btn-pending").on('click', function(){
                if(allowanceTable != null ){
                    allowanceTable.destroy()
                    allowanceTable = $('#tblAllowances').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('home.head') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'target_location', name: 'target_location'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'days_count', name: 'days_count'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ],
                    language: {infoEmpty:     "No pending allowance"}
                    });
                }
                $("#message").text("Pending Employee's list")
            })
            //Approved list
            $("#btn-approved").on('click', function(){
                if(allowanceTable != null ){
                    allowanceTable.destroy()
                    allowanceTable = $('#tblAllowances').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('home.accepted.head') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'target_location', name: 'target_location'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'days_count', name: 'days_count'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    language: {infoEmpty:     "No Approved allowance"}
                    });
                }
                $("#message").text("Approved Employee's list")
            })
            //Rejected list
            $("#btn-rejected").on('click', function(){
                if(allowanceTable != null ){
                    allowanceTable.destroy()
                    allowanceTable = $('#tblAllowances').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('home.rejected.head') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'target_location', name: 'target_location'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'days_count', name: 'days_count'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},

                    ],
                    language: {infoEmpty:     "No rejected allowance"}
                    });
                }
                $("#message").text("Rejected Employee's list")
            })
        })
    </script>
@endsection