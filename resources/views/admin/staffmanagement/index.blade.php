@extends('admin.staffmanagement.layouts.staff', [
    'page_header' => 'Match Records',
  'dashboard_' => '',
  'menu' => 'active open selected',
  'home' => '',
  'staff' => 'active',
  'staff_report' => '',
  'pfa' => '',
 
])
 
@section('content')
 
                             <!-- Message -->
                        @if(Session::has('message'))
                            <p >{{ Session::get('message') }}</p>
                        @endif
                            <!-- BEGIN PAGE BASE CONTENT -->
                            <!-- <div class="note note-success">
                                <h3>Bootstrap File Input</h3>
                                <p> The file input plugin allows you to create a visually appealing file or image input widgets. For more info please check out
                                    <a href="http://www.jasny.net/bootstrap/javascript/#fileinput" target="_blank">the official documentation</a>. </p>
                            </div> 
                            -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class=" icon-layers font-green"></i>
                                                    <a href="{{ route('staff.create') }}" class="btn btn-primary"> Add Staff Eligibility List</a>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="mt-element-card mt-element-overlay">
                                                    <div class="row"> 
                                                        @forelse($groupByMDA as $data)


                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
                                                            <div class="mt-card-item">
                                                                <div class="mt-card-avatar mt-overlay-1">
                                                                    <img src="{{asset('img/7.jpg')}}" />
                                                                    <div class="mt-overlay">
                                                                        <ul class="mt-info">
                                                                            <li>
                                                                                <a class="btn default btn-outline" href="{{route('stafflist', $data->mda)}}" title="View List">
                                                                                    <i class="icon-eye"></i>
                                                                                </a>
                                                                            </li>
                                                                            <li>
                                                                            <form action="{{route('staff.destroy', $data->mda)}}" method="POST">
                                                                                {{csrf_field()}}
                                                                                {{method_field('DELETE')}}
                                                                                <input class="btn btn-danger btn-outline" type="submit" value="Delete" data-toggle="confirmation" data-singleton="true">
                                                                                <!-- <input class="btn btn-danger btn-outline" type="submit" value="Delete" data-toggle="confirmation" data-singleton="true"> -->
                                                                                </form>
                                                                             
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div> 
                                                                <div class="mt-card-content">
                                                                    <h3 class="mt-card-name">  </h3>
                                                                    <p class="mt-card-desc font-grey-mint">{{$data->mda}}</p>
                                                                    <div class="mt-card-social"> 
                                                                    
                                                                    <a href="{{route('upload_form', array('mda_id'=>$data->mda))}}" class="btn btn-success">Add PFA List</a>  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- <div class="col-md-3">
                                                            <div class="card mb-4">
                                                                <img class="card-img-top" src="{{asset('img/7.jpg')}}" alt="Card image cap" height="250px">
                                                                <div class="card-body">
                                                                <h5 class="card-title">{{$data->mda}} Staff List</h5> 
                                                                <table>
                                                                    <tr>
                                                                        <td>
                                                                        <a href="{{route('upload_form', array('mda_id'=>$data->mda))}}" class="btn btn-success btn-sm" title="Pair PIN Registration Report with selected MDA list ">Add PFA</a> 
                                                                        </td>
                                                                        <td>&nbsp;</td>
                                                                        <td>
                                                                        <form action="{{route('staff.destroy', $data->mda)}}" method="POST">
                                                                                {{csrf_field()}}
                                                                                {{method_field('DELETE')}}
                                                                                <input class="btn btn-danger btn-outline" type="submit" value="Delete" data-toggle="confirmation" data-singleton="true">
                                                                                </form> 
                                                                        
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div> -->

                                 
                                                            
                                                        @empty
                                                        No Record(s) Found!  
                                                        @endforelse 
                                                    </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                          </div>
                           
@endsection