@extends('layouts.data_layout', [
  'page_header' => 'Staff List',
  'dashboard_' => '',
  'menu' => 'active open selected',
  'user_account' => '',
  'staff_report' => '',
  'pfa' => '',
])
 
@section('content')
    <!-- BEGIN PAGE SIDEBAR -->
 
  
                            <!-- END PAGE SIDEBAR -->
                    <div class="page-content-col"> 
                        @if(Session()->has('error')) 
                            <div class="alert alert-danger"> 
                            {!! Session::get('error') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                                <!-- BEGIN PAGE BASE CONTENT -->
                                <div class="note note-default"> 
                                    <p> The combined list </p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <!-- BEGIN PORTLET-->
                                        <div >
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-green"></i>
                                                    <span class="caption-subject font-green sbold uppercase">Matched Staff List</span>
                                                </div> 
                                            </div>
                                            <div >
                                                <!-- BEGIN FORM--> 
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr>
                                <th>
                                 #
                                </th>
                                <th>RSA PIN</th>	 
                               <th>SURNAME	</th>
                               <th> FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	 
                               <th>PHONE NO</th> 
                               <th>PFA NAME</th>
                               <th>STAFF ID	</th>	
                               <th>GROSSN PAY</th>		
                               <th>10% EMPLOYER CONTRIBUTION</th> 
                               <th>8% EMPLOYEE CONTRIBUTION</th> 

                               <th>RSA PIN</th>	 
                               <th>SURNAME	</th>
                               <th> FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	 
                               <th>PHONE NO</th> 
                               <th>PFA NAME</th>
                               <th>STAFF ID	</th>	
                               <th>GROSSN PAY</th>		
                               <th>10% EMPLOYER CONTRIBUTION</th> 
                               <th>8% EMPLOYEE CONTRIBUTION</th> 
                             </tr>
                        </thead>
                             <tfoot>
                      <tr>
                             <th>
                             #
                                </th>
                                <th>RSA PIN</th>	 
                               <th>SURNAME	</th>
                               <th> FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	 
                               <th>PHONE NO</th> 
                               <th>PFA NAME</th>
                               <th>STAFF ID	</th>	
                               <th>GROSSN PAY</th>		
                               <th>10% EMPLOYER CONTRIBUTION</th> 
                               <th>8% EMPLOYEE CONTRIBUTION</th> 

                               <th>RSA PIN</th>	 
                               <th>SURNAME	</th>
                               <th> FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	 
                               <th>PHONE NO</th> 
                               <th>PFA NAME</th>
                               <th>STAFF ID	</th>	
                               <th>GROSSN PAY</th>		
                               <th>10% EMPLOYER CONTRIBUTION</th> 
                               <th>8% EMPLOYEE CONTRIBUTION</th>  
                              </tr>
                            </tfoot>
                        <tbody>
                        @forelse($computedList as $key => $data)
                           @if($data)
                              <tr class="odd gradeX">
                                <td> {{$key}} </td> 
                            
                                <td>{{$data->rsa_pin}}</td>
                                <td>{{$data->surname}}</td>
                                <td>{{$data->firstname}}</td>
                                <td>{{$data->othernames}}</td>
                                <td>{{$data->gender}}</td>
                                <td>{{$data->phone_no}}</td>
                                <td>{{$data->pfa_name}}</td>
                                <td>{{$data->staff_id}}</td>
                                <td>{{$data->gross_pay}}</td>
                                <td>{{$data->ten_percent}}</td>
                                <td>{{$data->eight_percent}}</td>

                                <td>{{$data->rsa_pin1}}</td>
                                <td>{{$data->surname1}}</td>
                                <td>{{$data->firstname1}}</td>
                                <td>{{$data->othernames1}}</td>
                                <td>{{$data->gender1}}</td>
                                <td>{{$data->phone_no1}}</td>
                                <td>{{$data->pfa_name1}}</td>
                                <td>{{$data->staff_id1}}</td>
                                <td>{{$data->gross_pay1}}</td>
                                <td>{{$data->ten_percent1}}</td>
                                <td>{{$data->eight_percent1}}</td> 
                             
                                </tr>
                            @endif
                            @empty 
                            No Record(s) Found!.
                                </tbody>
                            @endforelse
                        </table>     
                          
                                 
                                                <!-- END FORM-->
                                            </div>
                                        </div> 
                        <!-- END PORTLET--> 
                                 
<h2> Unmatched </h2>

            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Unmatched Staff List</span>
                    </div> 
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM--> 
             <table class="table table-striped table-bordered table-hover" id="sample_2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>RSA PIN</th>	 
                               <th>SURNAME</th>
                               <th>FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	 
                               <th>PHONE NO</th> 
                               <th>PFA NAME</th>
                               <th>STAFF ID</th>	
                               <th>GROSSN PAY</th>		
                               <th>10% EMPLOYER CONTRIBUTION</th> 
                               <th>8% EMPLOYEE CONTRIBUTION</th>  
                             </tr>
                        </thead>
                             <tfoot>
                      <tr>
                             <th> # </th>
                             <th>RSA PIN</th>	 
                               <th>SURNAME</th>
                               <th>FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	 
                               <th>PHONE NO</th> 
                               <th>PFA NAME</th>
                               <th>STAFF ID</th>	
                               <th>GROSSN PAY</th>		
                               <th>10% EMPLOYER CONTRIBUTION</th> 
                               <th>8% EMPLOYEE CONTRIBUTION</th> 
                              </tr>
                            </tfoot>
                        <tbody>
                        @forelse($unmatched as $data)
                           @if($data)
                              <tr class="odd gradeX">
                                  <td>#</td> 
                                <td>{{$data->rsa_pin}}</td>
                                <td>{{$data->surname}}</td>
                                <td>{{$data->firstname}}</td>
                                <td>{{$data->othernames}}</td>
                                <td>{{$data->gender}}</td>
                                <td>{{$data->phone_no}}</td>
                                <td>{{$data->pfa_name}}</td>
                                <td>{{$data->staff_id}}</td>
                                <td>{{$data->gross_pay}}</td>
                                <td>{{$data->ten_percent}}</td>
                                <td>{{$data->eight_percent}}</td>
                                </tr>
                            @endif
                        @empty 
                            No Record(s) Found!.
                                </tbody>
                        @endforelse
                        </table>      
                                     <!-- END FORM-->
                                </div>
                            </div>     
                        </div>
                    </div>
                        <!-- END PAGE BASE CONTENT -->
            </div>
               
@endsection