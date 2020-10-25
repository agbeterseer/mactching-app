@extends('layouts.data_layout', [
  'page_header' => 'Staff List / PFA Registered List',
  'dashboard_' => '',
  'menu' => 'active open selected',
  'user_account' => '',
  'home' => '',
  'staff' => '',
  'staff_report' => '',
  'pfa' => 'active',
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
                                    <form action="{{ route('match_monthly_records') }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" name="match" class="btn btn-success" value="{{$mda_id}}" >Match Records</button>
                                    </form> 
                                    <!-- <p> The file input plugin allows you to create a visually appealing file or image input widgets. For more info please check out
                                        <a href="#" target="_blank">the official documentation</a>. </p> -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <div class="col-md-6"> 
                                        <!-- BEGIN PORTLET-->
                                        <div>
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-green"></i>
                                                    <span class="caption-subject font-green sbold uppercase">Staff Payment Report </span>
                                                </div>
                      
                                            </div>
                                            <div>
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
                               <th>Code</th> 
                               
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
                               <th>Code</th> 
                               
                              </tr>
                            </tfoot>
                        <tbody>
                        @forelse($staff_payment_list as $staff)
                           @if($staff) 
                              <tr class="odd gradeX">
                                  <td>
                                 #
                                    </td>
                                <td>{{$staff->rsa_pin}}</td>
                                <td>{{$staff->surname}}</td>
                                <td>{{$staff->firstname}}</td>
                                <td>{{$staff->othernames}}</td>
                                <td>{{$staff->gender}}</td>
                                <td>{{$staff->phone_no}}</td>
                                <td>{{$staff->pfa_name}}</td>
                                <td>{{$staff->staff_id}}</td>
                                <td>{{$staff->gross_pay}}</td>
                                <td>{{$staff->ten_percent}}</td>
                                <td>{{$staff->eight_percent}}</td>
                                <td>{{$staff->mda}}</td>
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
                                      </div> <!-- end 6 --> 
                                      <div class="col-md-6">
                                            
                                            <!-- BEGIN PORTLET-->
                                            <div >
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-settings font-green"></i>
                                                        <span class="caption-subject font-green sbold uppercase">Staff Monthly Payment Report</span>
                                                    </div>
                          
                                                </div>
                                                <div >
                                                    <!-- BEGIN FORM-->
                                             
 <table class="table table-striped table-bordered table-hover" id="sample_2">
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
                               <th>Code</th> 
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
                               <th>Code</th> 
                              </tr>
                            </tfoot>
                        <tbody>
                        @forelse($monthly_report_list as $reportData)
                           @if($reportData)
                              <tr class="odd gradeX">
                                  <td>
                                    #
                                    </td>
                                    <td>{{$reportData->rsa_pin}}</td>
                                <td>{{$reportData->surname}}</td>
                                <td>{{$reportData->firstname}}</td>
                                <td>{{$reportData->othernames}}</td>
                                <td>{{$reportData->gender}}</td>
                                <td>{{$reportData->phone_no}}</td>
                                <td>{{$reportData->pfa_name}}</td>
                                <td>{{$reportData->staff_id}}</td>
                                <td>{{$reportData->gross_pay}}</td>
                                <td>{{$reportData->ten_percent}}</td>
                                <td>{{$reportData->eight_percent}}</td>
                                <td>{{$reportData->mda}}</td>
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
                                          </div> <!-- end 6 --> 
                                    </div>
                                </div>
                                <!-- END PAGE BASE CONTENT -->
                            </div>
               
@endsection