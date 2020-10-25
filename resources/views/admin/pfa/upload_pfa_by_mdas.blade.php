@extends('admin.staffmanagement.layouts.staff', [
    'page_header' => 'Match Records',
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
                                         
                                  
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class=" icon-layers font-green"></i>
                                                    <span class="caption-subject font-green bold uppercase">PFA Registration PIN Reports</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="mt-element-card mt-element-overlay">
                                                    <div class="row">
                                                    @if($mdas)
                                                    @forelse($mdas as $mda)
                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
                                                            <div class="mt-card-item">
                                                                <div class="mt-card-avatar mt-overlay-1">
                                                                    <img src="{{asset('img/7.jpg')}}" />
                                                                    <div class="mt-overlay">
                                                                        <ul class="mt-info">
                                                                            <li>
                                                                                <a class="btn default btn-outline" href="{{ route('show_pfas', $mda->mda_id) }}">
                                                                                    <i class="icon-eye"></i>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="btn default btn-outline" href="javascript:;">
                                                                                    <i class="icon-link"></i>
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div> 
                                                                <div class="mt-card-content">
                                                                    <h3 class="mt-card-name"> {{ $mda->mda_id }}   </h3>
                                                                    <p class="mt-card-desc font-grey-mint"> </p>
                                                                    <p class="mt-card-desc font-grey-mint"> </p>
                                                                    <div class="mt-card-social"> 
                                                                    
                                                                    <a href="#" class="btn btn-success">View Registered List</a>  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        No Record(s) Found! 
                                                        @endforelse

                                                        @else
                
                                                        @endif

                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                          </div>
@endsection