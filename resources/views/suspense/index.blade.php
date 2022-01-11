@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Allowances/ Suspense/</h3>
                        <div class="block-options">
                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-add-allowance"><i class="fa fa-plus"></i> New Allowance </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>አበል ቁጥር</th>
                                    <th>የሰራተኛዉ ሙሉ ስም</th>
                                    <th>የስራ ክፍል</th>
                                    <th>መነሻ ቦታ</th>
                                    <th>መድረሻ ቦታ</th>
                                    <th>የቆይታ ጊዜ</th>
                                    <th>የቀን ብዛት</th>
                                    {{-- <th>አበል</th> --}}
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allowances as $allowance)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $allowance->id}}</td>
                                        <td>{{ $allowance->employee->full_name }}</td>
                                        <td>{{ $allowance->employee->department->name }}</td>
                                        <td>{{ $allowance->startCity->name }}</td>
                                        <td>{{ $allowance->targetCity->name }}</td>
                                        @if (!$allowance->return_date)
                                            <td><b>በ</b> {{ $allowance->start_date }}</td>
                                        @else
                                            <td><b>ከ</b>{{ $allowance->start_date }} <b>እስከ</b> {{ $allowance->return_date }}  </td>
                                        @endif
                                        <td>{{ $allowance->days_count }}</td>
                                        {{-- <td>{{ $allowance->trip_allowance }}</td> --}}
                                        <td><a href="#"><i class="fas fa-pencil-alt"></i></a> <a href="#"><i class="fas fa-times-circle" style="color: rgb(233, 49, 104);"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Allowance Modal -->
    <div class="modal fade" id="modal-add-allowance" role="dialog">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Create Allowance</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-content">                        
                        <div class="form-group">
                            <label for="employee_id"  class="col-form-label">የሰራተኛዉ ስም፡ </label>
                            <div class="col-12">
                                <select name="employee_id" id="employee_id" class="form-control form-control-sm">
                                    @foreach ($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                        </div>
                        <div class="form-row">                        
                            <div class="form-group col-6">
                                <label for="start_location" class="col-form-label"> መነሻ ቦታ፡ </label>
                                <div class="col-12">
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
                            <div class="form-group col-6">
                                <label for="target_location" class="col-form-label"> መድረሻ ቦታ፡ </label>
                                <div class="col-12">
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
                        <div class="form-group">
                            <label for="trip_reason" class="col-form-label"> የጉዞ አላማ/ምክንያት፡ </label>
                            <div class="col-12">
                                <textarea name="trip_reason" id="trip_reason"  rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="start_date" class="col-form-label"> መነሻ ቀን፡ </label>
                                <div class="col-md-12">
                                    <input class="form-control form-control-sm" type="date" id="start_date" name="start_date" >
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="return_date" class="col-form-label"> መመለሻ ቀን፡ </label>
                                <div class="col-12">
                                    <input class="form-control form-control-sm" type="date" id="return_date" name="return_date" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="trip_allowance" class="col-form-label">ለዉሎ አበል የተከፈለ ብር፡</label>
                                <div class="col-12">
                                    <input type="number" name="trip_allowance" id="trip_allowance" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="fuel_allowance" class="col-form-label">ለነዳጅና ቅባት ብር፡</label>
                                <div class="col-12">
                                    <input type="number" name="fuel_allowance" id="fuel_allowance" class="form-control form-control-sm">
                                </div>
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
@endsection