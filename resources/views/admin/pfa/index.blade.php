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
                                                    Staff Eligibility List 
                                                </div>
                                                <div class="tools"> </div>
                                            </div>
                                            <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover" id="sample_1">
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
                                                    </tfoot>
                                                    <tbody>
                                                    @forelse($staff_list as $key => $staff)
                                                    @if($staff) 
                                                        <tr>
                                                        <th>{{ $key }}</th> 
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
                                                      <tr>
                                                            <td colspan=12> No Record(s) Found </td> 
                                                      </tr>
                                                      @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>




 @endsection