@extends('layouts.data_layout', [
  'page_header' => 'PFA List',
  'dashboard_' => '',
  'menu' => 'active open selected',
  'user_account' => '',
  'home' => '',
  'staff' => '',
  'staff_report' => '',
  'pfa' => 'active',
])
@section('content') 
                    @if(Session()->has('success')) 
                        <div class="alert alert-success"> 
                        {!! Session::get('success') !!}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Session()->has('error'))
                        <div class="alert alert-danger"> 
                        {!! Session::get('error') !!}
                        </div>
                    @endif 
 
                                    <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption font-dark">
                                                    <i class="icon-settings font-dark"></i>
                                                    PFA Registered List 
                                                </div>
                                                <div class="tools"> </div>
                                            </div>
                                            <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
    
                                                    
                                                    <thead>
                                                        <tr>
                                                         <th>#</th> 
                                                            <th>Form Ref No</th>
                                                            <th>Surname</th>
                                                            <th>First Name</th>
                                                            <th>Othernames</th>
                                                            <th>Gender</th>
                                                            <th>Date Of Birth</th>
                                                            <th>NIN.</th>
                                                            <th>PHONE NO.</th>
                                                            <th>EMAIL</th>
                                                            <th>Institution Name</th>
                                                            <th>Data Of First Appt.</th>
                                                            <th>Staff ID</th>
                                                            <th>PIN Reg Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                        <th>#</th> 
                                                            <th>Form Ref No</th>
                                                            <th>Surname</th>
                                                            <th>First Name</th>
                                                            <th>Othernames</th>
                                                            <th>Gender</th>
                                                            <th>Date Of Birth</th>
                                                            <th>NIN.</th>
                                                            <th>PHONE NO.</th>
                                                            <th>EMAIL</th>
                                                            <th>Institution Name</th>
                                                            <th>Data Of First Appt.</th>
                                                            <th>Staff ID</th>
                                                            <th>PIN Reg Date</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    @forelse($pfa_list as $key => $pfa)
                                                    @if($pfa) 
                                                        <tr>
                                                        <th>{{ $key }}</th> 
                                                            <td>{{$pfa->form_ref_no}}</td>
                                                            <td>{{$pfa->surname}}</td>
                                                            <td>{{$pfa->firstname}}</td>
                                                            <td>{{$pfa->othernames}}</td>
                                                            <td>{{$pfa->gender}}</td>
                                                            <td>{{$pfa->date_of_birth}}</td>
                                                            <td>{{$pfa->nin}}</td>
                                                            <td>{{$pfa->phone_no}}</td>
                                                            <td>{{$pfa->email}}</td>
                                                            <td>{{$pfa->institution_name}}</td>
                                                            <td>{{$pfa->date_of_first_appt}}</td>
                                                            <td>{{$pfa->staff_id}}</td>
                                                            <td>{{$pfa->pin_reg_date}}</td>
                                                      </tr>
   
                                                      @endif
                                                     @empty 
                                                      <tr>
                                                            <td colspan=12> No Record(s) Found </td> 
                                                      </tr>
                                                      @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>




 @endsection