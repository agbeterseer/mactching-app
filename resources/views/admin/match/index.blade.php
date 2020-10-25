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
                              </tr>
                            </tfoot>
                        <tbody>
                        @forelse($computedList as $key => $data)
                           @if($data)
                              <tr class="odd gradeX">
                                  <td>
                                {{$key}}
                                    </td> 
                                <td>{{$data->staff_id1}}</td>
                                <td>{{$data->surname1}}</td>
                                <td>{{$data->firstname1}}</td>
                                <td>{{$data->othernames1}}</td>
                                <td>{{$data->gender1}}</td>
                                <td>{{$data->date_of_birth1}}</td>
                                <td>{{$data->date_of_first_appt1}}</td>
                                <td>{{$data->grade_level1}}</td>
                                <td>{{$data->qualification1}}</td>
                                <td>{{$data->confirmation1}}</td>
                                <td>{{$data->gross_pay1}}</td>

                               <td>{{$data->rsa_pin}}</td>	
                               <td>{{$data->form_ref_no}}</td>	
                               <td>{{$data->surname}}</td>
                               <td>{{$data->firstname}}</td>	
                               <td>{{$data->othernames}}</td>	
                               <td>{{$data->gender}}</td>	
                               <td>{{$data->date_of_birth}}</td>	
                               <td>{{$data->nin}}</td>	
                               <td>{{$data->phone_no}}</td>	
                               <td>{{$data->email}}</td>	
                               <td>{{$data->institution_name}}</td>	
                               <td>{{$data->date_of_first_appt}}</td>	
                               <td>{{$data->staff_id}}</td>
                               <td>{{$data->pin_reg_date}}</td> 
                             
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
                             <th> # </th>
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
                        @forelse($unmatched as $data)
                           @if($data)
                              <tr class="odd gradeX">
                                  <td>#</td> 
                                <td>{{$data->staff_id}}</td>
                                <td>{{$data->surname}}</td>
                                <td>{{$data->firstname}}</td>
                                <td>{{$data->othernames}}</td>
                                <td>{{$data->gender}}</td>
                                <td>{{$data->date_of_birth}}</td>
                                <td>{{$data->date_of_first_appt}}</td>
                                <td>{{$data->grade_level}}</td>
                                <td>{{$data->qualification}}</td>
                                <td>{{$data->confirmation}}</td>
                                <td>{{$data->gross_pay}}</td> 
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