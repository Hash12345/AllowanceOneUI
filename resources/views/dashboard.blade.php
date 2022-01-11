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
        <div class="row row-deck">
            <div class="col-sm-6 col-xl-3">
                <!-- All Allowances -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">32</dt>
                            <dd class="text-muted mb-0">All Allowances</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                        <a class="font-w500 d-flex align-items-center" href="javascript:void(0)">
                            View all allowances
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
                            <dt class="font-size-h2 font-w700">32</dt>
                            <dd class="text-muted mb-0">Not Reimbursed</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
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
            <div class="col-sm-6 col-xl-3">
                <!-- Reimbursed -->
                <div class="block block-rounded d-flex flex-column">
                    <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="font-size-h2 font-w700">52</dt>
                            <dd class="text-muted mb-0">Reimbursed</dd>
                        </dl>
                        <div class="item item-rounded bg-body">
                            <i class="fa fa-shopping-cart font-size-h3 text-primary"></i>
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
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Latest Allowances</h3>
                <div class="block-options">
                    <a href="{{ route('allowances.index')}}" class="btn btn-link btn-sm">View more</a>
                </div>
            </div>
            {{-- Allowances --}}
            <div class="block-content">
                <div class="table-responsive">
                    <table id="tblAllowance" class="table table-borderless table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="d-none d-sm-table-cell" style="width: 30%;">ስም</th>
                                <th>ቦታ</th>
                                <th class="" style="">ቀን</th>
                                <th class="" style="">የቆይታ ጊዜ /ቀን/</th>
                                <th class="" style="">ምርመራ</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title">All City Allowances</h3>
            </div>
            {{-- City Allowances --}}
            <div class="block-content">
                <div class="table-responsive">
                    <table id="tblcityAllowances" class="table table-bordered table-striped table-vcenter dataTable no-footer">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>የከተማዉ ስም</th>
                                <th>ክልል</th>
                                <th>አበል 1</th>
                                <th>አበል 2</th>
                                <th>አበል 3</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
            let allowanceTable = $('#tblAllowance').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('allo') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'target_location', name: 'target_location'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'days_count', name: 'days_count'},
                    {data: 'status', name: 'status'}
                ]
            });

            let cityTable= $("#tblcityAllowances").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('city')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'allowance1', name: 'allowance1'},
                    {data: 'allowance2', name: 'allowance2'},
                    {data: 'allowance3', name: 'allowance3'},
                ]

            })
        })
    </script>
@endsection