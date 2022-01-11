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
                            <dt id="dtpending" class="font-size-h2 font-w700">{{ $pending }}</dt>
                            <dd class="text-muted mb-0">pending Allowances</dd>
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
                            <dt id="dtrejected" class="font-size-h2 font-w700">{{ $rejected }}</dt>
                            <dd class="text-muted mb-0">rejected Allowances</dd>
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
                            <dt id="dtaccepted" class="font-size-h2 font-w700">{{ $accepted }}</dt>
                            <dd class="text-muted mb-0">accepted allowances</dd>
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

        {{-- Content area --}}
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
                        <table id="tblAllowances1" class="table table-bordered table-striped table-vcenter dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="d-none d-sm-table-cell" style="width: 30%;">ስም</th>
                                    <th>ቦታ</th>
                                    <th class="" style="">ቀን</th>
                                    <th class="" style="">የቆይታ ጊዜ /ቀን/</th>
                                    <th class="" style="">ምርመራ</th>
                                    <th class="" style="width: 15%;">Status</th>
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
        $(document).ready(function(){
            let allowanceTable1 = $('#tblAllowances1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('home.user') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'target_location', name: 'target_location'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'days_count', name: 'days_count'},
                    {data: 'reimbursed', name: 'reimbursed'},
                    {data: 'status', name: 'status', orderable: false, searchable: false}
                ]
            });
            //pending list
            $("#btn-pending").on('click', function(){
                if(allowanceTable1 != null){
                    allowanceTable1.destroy()
                    allowanceTable1 = $('#tblAllowances1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('home.user') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'target_location', name: 'target_location'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'days_count', name: 'days_count'},
                        {data: 'reimbursed', name: 'reimbursed'},
                        {data: 'status', name: 'status', orderable: false, searchable: false}
                    ]})
                }
            })
            //Approved list
            $("#btn-approved").on('click', function(){
                console.log("Hello")
                if(allowanceTable1 != null ){
                    allowanceTable1.destroy()
                    allowanceTable1 = $('#tblAllowances1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('home.accepted.user') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'user_id', name: 'user_id'},
                        {data: 'target_location', name: 'target_location'},
                        {data: 'start_date', name: 'start_date'},
                        {data: 'days_count', name: 'days_count'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    language: {infoEmpty: "No Approved allowance"}
                    });
                }
            })
            //Rejected list
            $("#btn-rejected").on('click', function(){
                if(allowanceTable != null ){
                    allowanceTable.destroy()
                    allowanceTable = $('#tblAllowances').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('home.rejected.user') }}",
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