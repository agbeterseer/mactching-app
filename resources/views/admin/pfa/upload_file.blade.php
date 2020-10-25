
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
 
                @if(Session()->has('error'))
   
                        <div class="alert alert-danger"> 
                        {!! Session::get('error') !!}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                        </div>
                        @endif

                                <!-- BEGIN PAGE BASE CONTENT -->
                                <!-- <div class="note note-success">
                                    <h3>Registered List</h3>
                                    <p> The file input plugin allows you to create a visually appealing file or image input widgets. For more info please check out
                                       </p>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-12">
                                  
                                        <div class="col-md-8">
                                            
                                        <!-- BEGIN PORTLET-->
                                        <div class="portlet light form-fit bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-green"></i>
                                                    <span class="caption-subject font-green sbold uppercase">Upload PIN Registration Report List</span>
                                                </div>
                      
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form method='post' action="{{ route('upload.reg_list') }}" class="form-horizontal form-bordered" enctype='multipart/form-data' >
                                                {{ csrf_field() }}
                                                <input type="hidden" value="{{$mda_id}}" name="mda_id"/>
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Registered List</label>
                                                            <div class="col-md-3">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="input-group input-large">
                                                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                            <span class="fileinput-filename"> </span>
                                                                        </div>
                                                                        <span class="input-group-addon btn default btn-file">
                                                                            <span class="fileinput-new"> Select file </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="file" required="required"> </span>
                                                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button class="btn green" type="submit">
                                                                    <i class="fa fa-check"></i> Submit</button>
                                                                <a href="javascript:;" class="btn btn-outline grey-salsa">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <!-- END FORM-->
                                            </div>
                                        </div> 
                                        <!-- END PORTLET-->
                                      </div> 
                                    </div>
                                </div>
                                <!-- END PAGE BASE CONTENT -->
                            
@endsection
 
