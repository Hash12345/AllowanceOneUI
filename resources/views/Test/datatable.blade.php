@extends('layouts.main')
@section('style_lib')
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/select2/css/select2-bootstrap4.min.css')}}">
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('OneUI/assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css')}}">

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h1 class="mb-3 block-title">Laravel Datatables Example </h1>
                    </div>
                    <div class="block-content block-content-full">
                        <table id="datatable1" class="table table-bordered table-striped table-vcenter dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 80px;">#</th>
                                    <th>Name</th>
                                    <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Hassen</td>
                                    <td>xxx</td>
                                    <td>dddd</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Hassen</td>
                                    <td>xxx</td>
                                    <td>dddd</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Hassen</td>
                                    <td>xxx</td>
                                    <td>dddd</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Hassen</td>
                                    <td>xxx</td>
                                    <td>dddd</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            
        </div>

        {{-- Allowance --}}
        <div class="row">
            <div class="col-12">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h1 class="mb-3 block-title">Laravel Datatables Example </h1>
                    </div>
                    <div class="block-content block-content-full">
                        <table id="datatable2" class="table table-bordered table-striped table-vcenter dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell" style="width: 30%;">ስም</th>
                                    <th>ቦታ</th>
                                    <th class="" style="">ቀን</th>
                                    <th class="" style="">የቀን ብዛት</th>
                                    <th class="" style="">ምርመራ</th>
                                    <th style="width: 15%;">Action</th>
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
        $(document).ready(function() {
            var table = $('#datatable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('data') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            var table1 = $('#datatable2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('allowanceajax') }}",
                columns: [
                    {data: 'employee_id', name: 'employee_id'},
                    {data: 'target_location', name: 'target_location'},
                    {data: 'return_date', name: 'return_date'},
                    {data: 'days_count', name: 'days_count'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'}
                ]
            });
        });
    </script>
@endsection