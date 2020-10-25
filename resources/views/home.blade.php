@extends('layouts.home_layout', [
  'page_header' => 'Staff List',
  'dashboard_' => '',
  'menu' => 'active open selected',
  'home' => 'active',
  'staff' => '',
  'staff_report' => '',
  'pfa' => '',
  ])
@section('content')
        
                    <!-- BEGIN BREADCRUMBS -->
        
                    <!-- END BREADCRUMBS -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered"> 
                            <img src="{{asset('img/upload.png')}}" height="215px;"/>  
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered"> 
                            <img src="{{asset('img/upload-2493114_960_720.png')}}" height="215px;" />
                            </div>
                        </div>
                <!-- END PAGE BASE CONTENT -->
                </div>
                @endsection
