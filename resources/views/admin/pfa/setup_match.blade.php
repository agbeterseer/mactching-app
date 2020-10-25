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
                <div class="col-md-12">
                    <div class="col-md-6">
                  
                            <div >
                              
                                <form action="{{ route('matchrecords') }}" method="POST">
                                <div class="col-md-6">
                                {{ csrf_field() }}
                                    <select  class="form-control" required="required" name="match_option">
                                    <option value="">... Select Match Option ...</option>
                                        <option value="match_by_name">Match By Name</option>
                                        <option value="match_by_staff_id">Match By Staff ID</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="match" class="btn btn-success" value="{{$mda_id}}" >Match Records</button>
                                </div>
                                  
                            </form>
                        
                    <!-- <p> The file input plugin allows you to create a visually appealing file or image input widgets. For more info please check out
                        <a href="#" target="_blank">the official documentation</a>. </p> -->
                    </div>
                </div>
            </div>
            <div class="space">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-12">
                                  
                                        <div class="col-md-6">
                                            
                                        <!-- BEGIN PORTLET-->
                                        <div>
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-green"></i>
                                                    <span class="caption-subject font-green sbold uppercase">Staff List</span>
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
                                <th>Staff ID</th>
                                <th>Surname</th>
                                <th>First Name</th>
                                <th>Othernames</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Data Of First Appt.</th>
                                <th>Grade Level</th>
                                <th>Qualification</th>
                                <th>Confirmation</th>
                                <th>Gross Pay</th>
                               
                             </tr>
                        </thead>
                             <tfoot>
                      <tr>
                             <th>
                                #
                                </th>
                                <th>Staff ID</th>
                                <th>Surname</th>
                                <th>First Name</th>
                                <th>Othernames</th>
                                <th>Gender</th>
                                <th>Date Of Birth</th>
                                <th>Data Of First Appt.</th>
                                <th>Grade Level</th>
                                <th>Qualification</th>
                                <th>Confirmation</th>
                                <th>Gross Pay</th>
                               
                              </tr>
                            </tfoot>
                        <tbody>
                        @forelse($eligible_staff as $staff)
                           @if($staff)
                              <tr class="odd gradeX">
                                  <td>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                      <input type="checkbox" class="checkboxes" value="1" />
                                        <span></span>
                                    </label>
                                    </td>
                                    <td>{{$staff->staff_id}}</td>
                                <td>{{$staff->surname}}</td>
                                <td>{{$staff->firstname}}</td>
                                <td>{{$staff->othernames}}</td>
                                <td>{{$staff->gender}}</td>
                                <td>{{$staff->date_of_birth}}</td>
                                <td>{{$staff->date_of_first_appt}}</td>
                                <td>{{$staff->grade_level}}</td>
                                <td>{{$staff->qualification}}</td>
                                <td>{{$staff->confirmation}}</td>
                                <td>{{$staff->gross_pay}}</td>
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
                                                        <span class="caption-subject font-green sbold uppercase">PFA's Registered List</span>
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
                               <th>FORM REF NO.</th>	
                               <th>SURNAME	</th>
                               <th> FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	
                               <th>DATE OF BIRTH</th>	
                               <th>NIN</th>	
                               <th>PHONE NO</th>	
                               <th>EMAIL</th>	
                               <th>INSTITUTION NAME</th>	
                               <th>DATE OF FIRST APPT.</th>	
                               <th>STAFF ID	</th>
                               <th>PIN REG DATE</th> 
                               <th>Code</th> 
                             </tr>
                        </thead>
                             <tfoot>
                        <tr>
                        <th>
                                #
                                </th> 
                                <th>RSA PIN</th>	
                               <th>FORM REF NO.</th>	
                               <th>SURNAME	</th>
                               <th> FIRSTNAME</th>	
                               <th>OTHERNAMES</th>	
                               <th>GENDER</th>	
                               <th>DATE OF BIRTH</th>	
                               <th>NIN</th>	
                               <th>PHONE NO</th>	
                               <th>EMAIL</th>	
                               <th>INSTITUTION NAME</th>	
                               <th>DATE OF FIRST APPT.</th>	
                               <th>STAFF ID	</th>
                               <th>PIN REG DATE</th> 
                               <th>Code</th> 
                              </tr>
                            </tfoot>
                        <tbody>
                        @forelse($pfa_list as $pfa)
                           @if($pfa)
                              <tr class="odd gradeX">
                                  <td>
                                    #
                                    </td>
                                    <td>{{$pfa->rsa_pin }}</td> 
                                    <td>{{$pfa->form_ref_no }}</td>
                                    <td>{{$pfa->surname}}</td> 
                                    <td>{{$pfa->firstname}}</td>
                                    <td>{{$pfa->othernames}} </td> 
                                    <td>{{$pfa->gender}}</td> 
                                    <td>{{$pfa->date_of_birth}}</td>
                                    <td>{{$pfa->nin}}</td> 
                                    <td>{{$pfa->phone_no}}</td>
                                    <td>{{$pfa->email}} </td> 
                                    <td>{{$pfa->institution_name}}</td> 
                                    <td>{{$pfa->date_of_first_appt}}</td>
                                    <td>{{$pfa->staff_id}}</td> 
                                    <td>{{$pfa->pin_reg_date}}</td>
                                    <td>{{$pfa->mda_id}} </td>
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