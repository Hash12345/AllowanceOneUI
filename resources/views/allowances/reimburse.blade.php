@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="block block-rounded">
                    <div class="block-header border-bottom">
                        <h3 class="block-title">Reimbursement form</h3>
                        <div class="block-options">
                            <a class="btn btn-success btn-sm" href="{{ route('generatePDF') }}" class="mr-2"><i class="fa fa-download" data-toggle="click-ripple"></i> Download</a>
                            <a href="{{ route('allowances.index')}}" class="mr-2" data-toggle="click-ripple"><i class="fa fa-save"></i> Save</a>
                        </div>
                    </div>
                     <!-- Personal Information -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block block-round block-content bg-body-light border-bottom">
                                <div class="d-flex justify-content-around">  
                                    <div class="col-md-4">
                                        <div class="block block-rounded block-themed">
                                            <div class="block-header bg-primary">
                                                <h3 class="block-title">የሰራተኛዉ መረጃ</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="form-group mb-0">
                                                    <label for="employee_id"  class="col-form-label">ሙሉ ስም፡ </label>
                                                    <span class="text-right">{{ $allowance->user->full_name }}</span>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label for="" class="col-form-label"> የስራ ከፍል፡ </label>
                                                    <span>{{  $allowance->user->department->name}}</span>                                                
                                                </div> 
                                                <div class="form-group mb-0">
                                                    <label for="" class="col-form-label"> የስራ ድርሻ፡ </label>
                                                    <span>{{  $allowance->user->job_title}}</span>                                                
                                                </div> 
                                                <div class="form-group mb-0">
                                                    <label for="" class="col-form-label"> ደመወዝ፡ </label>
                                                    <span>{{  number_format($allowance->user->salary,2)}}</span>                                   
                                                </div>                                
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="block block-rounded block-themed">
                                            <div class="block-header bg-success">
                                                <h3 class="block-title">የአበል ሁኔታ መግለጫ</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="form-group mb-0">
                                                    <label for="start_location" class="col-form-label"> መነሻ ቦታ፡ </label>
                                                    <span>{{ $allowance->startCity->name}}</span>                                                
                                                </div> 
                                                <div class="form-group mb-0">
                                                    <label for="target_location" class="col-form-label"> መድረሻ ቦታ፡ </label>
                                                    <span>{{ $allowance->targetCity->name}}</span>                                   
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label for="start_date" class="col-form-label"> መነሻ ቀን፡ </label>                                                
                                                    <span>{{ $allowance->start_date}}</span>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label for="return_date" class="col-form-label"> መመለሻ ቀን፡ </label>
                                                    <span>{{ $allowance->return_date}}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="trip_reason" class="col-form-label"> የጉዞ አላማ፡ </label>
                                                    <span>{{ $allowance->trip_reason}}</span>
                                                </div>                                
                                            </div>
                                        </div>    
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="block block-rounded block-themed">
                                            <div class="block-header bg-info">
                                                <h3 class="block-title">በቅድሚያ የተከፈለ ብር</h3>
                                            </div>
                                            <div class="block-content">
                                                <div class="d-flex justify-content-between">
                                                    <label for="trip_allowance" class="">አበል፡</label>
                                                    <div><span class="text-right">{{ ($allowance->trip_allowance) ? number_format( $allowance->trip_allowance,2) : 0}} ብር</span></div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <label for="transport_allowance" class="">ትራንስፓርት፡</label>
                                                    <div><span class="text-right">{{ ($allowance->transport_allowance) ? number_format($allowance->transport_allowance, 2) : 0}} ብር</span></div>                                   
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <label for="feul_allowance" class="text-md-right">ለነዳጅና፡</label>
                                                    <div><span class="text-right">{{ ($allowance->fuel_allowance) ? number_format( $allowance->fuel_allowance, 2) : 0 }} ብር</span></div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <label for="other_expense" class="text-md-right">ተጨማሪ፡</label>
                                                    <div>{{ ($allowance->reserve) ? number_format($allowance->reserve, 2) : 0}} ብር</div>
                                                </div>
                                                <hr>
                                                <div class="d-flex justify-content-between">                                    
                                                    <div><strong>ድምር፡</strong></div>
                                                    <div class="text-success"><span id="total">{{ number_format($allowance->trip_allowance + $allowance->transport_allowance + $allowance->fuel_allowance + $allowance->other_expense, 2)  }}</span> ብር</div>
                                                </div>                                                                
                                            </div>
                                        </div>
                                    </div>                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Travel allowance -->
        <div class="row">
            <div class="col-md-12">
                <div class="block block-round">
                    <div class="block-header">
                        <h5 class="font-w700">ሰራተኛዉ በጉዞ ላይ የቆዩበት ቦታዎች /ለቁርስ፣ ለምሳ፣ ለእራት/ መግለጫ ሰንጠረዥ</h5>
                        <div class="block-options">
                            <a class="btn btn-outline-primary btn-sm" id="btnallowanceedit" href="{{ route('travelallowance.index', [$allowance->id])}}"  class="btn-block-option"><i class="fa fa-pencil-alt"></i> Edit</a>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">መነሻ ቦታ</th>
                                    <th scope="col">ቀን</th>
                                    <th scope="col">ቁርስ</th>
                                    <th scope="col">ምሳ</th>
                                    <th scope="col">እራት</th>
                                    <th scope="col">የዉሎ አበል መጠን</th>
                                    <th scope="col">የበርሃ አበል</th>
                                    <th scope="col">ድምር</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($allowance->travelAllowances) > 0)
                                    @foreach ($allowance->travelAllowances as $data)
                                        <tr>
                                            <td>{{ $data->startCity->name }}</td>
                                            <td>{{ $data->start_date }}</td>
                                            <td>{{ $data->breakfastCity->name }}</td>
                                            <td>{{ $data->lunchCity->name }}</td>
                                            @if ($data->dinner)
                                                <td>{{ $data->dinnerCity->name }}</td>
                                            @else
                                            <td>-</td>
                                            @endif                                                
                                            <td>{{ $data->travel_total }}</td>
                                            <td></td>
                                            <td>{{ $data->travel_total }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="7" style="text-align: right;">ድምር፡</th>
                                        <th >{{ $allowance->travels_sum }}</th>
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
                </div>
        </div>
        
    </div>
    <!-- Stay allowance -->
    <div class="row">
        <div class="col-12">
            <div class="block block-rounded">
                <div class="block-header">
                    <h5 class="font-w700">ሰራተኛዉ ለስራ በቆዩባቸው ቦታዎች መግለጫ ሰንጠረዥ</h5>
                    <div class="block-options">
                        <a class="btn btn-outline-primary btn-sm" id="btneditstayallowance" href="{{ route('stayallowance.index', [$allowance->id])}}" class="btn-block-option" ><i class="fa fa-pencil-alt"></i> Edit</a>
                    </div>
                </div>                                    
                <div class="block-content  block-content-full">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ቀን</th>
                                <th scope="col">ለስራ የታደረበት ቦታ</th>
                                <th scope="col">የቀን ብዛት</th>
                                <th scope="col">የዉሎ አበል</th>
                                <th scope="col">የበረሃ አበል</th>
                                <th scope="col">ድምር</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($allowance->stayAllowances) > 0)
                                @foreach ($allowance->stayAllowances as $stayAllowance)
                                    <tr>
                                        @if (!$stayAllowance->to_date)
                                            <td><b>በ</b> {{ $stayAllowance->from_date }}</td>
                                        @else
                                            <td><b>ከ</b>{{ $stayAllowance->from_date }} <b>እስከ</b> {{ $stayAllowance->to_date }}  </td>
                                        @endif
                                        @if (!$stayAllowance->location)
                                            <td>-</td>
                                        @else
                                            <td>{{ $stayAllowance->city->name }}</td>
                                        @endif
                                        @if ($stayAllowance->days_count == 1)
                                            <td>40 %</td>                                                
                                        @else
                                            <td>{{$stayAllowance->days_count}} </td>
                                        @endif
                                        <td>{{ $stayAllowance->stay_total }}</td>
                                        <td></td>
                                        <td>{{ $stayAllowance->stay_total }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5" style="text-align: right;">ድምር፡</th>
                                    <th >{{$allowance->stays_sum}}</th>
                                </tr>
                            @else
                                <tr>
                                    <th colspan="8" style="text-align: center;">No Stay Allowance Yet. Please Register One</th>
                                    <th  style="text-align: right;">ድምር፡</th>
                                    <th >{{$allowance->stays_sum}}</th>
                                </tr>  
                            @endif
                            <tr>
                                <th colspan="5" style="text-align: right;">ጠቅላላ ድምር፡</th>
                                <th >{{$allowance->allowance_payment}}</th>
                            </tr>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection