
@extends('admin.staffmanagement.layouts.staff', [
    'page_header' => 'UPLOAD ELIGIBLE STAFF',
  'dashboard_' => '',
  'menu' => 'active open selected',
  'user_account' => '',
  'home' => '',
  'staff' => 'active',
  'staff_report' => '',
  'pfa' => '',
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
                                    <h3>Bootstrap File Input</h3>
                                    <p> The file input plugin allows you to create a visually appealing file or image input widgets. For more info please check out
                                        <a href="http://www.jasny.net/bootstrap/javascript/#fileinput" target="_blank">the official documentation</a>. </p>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-12">
               
                                        
                                        <!-- BEGIN PORTLET-->
                                        <div class="portlet light form-fit bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-green"></i>
                                                    <span class="caption-subject font-green sbold uppercase">Upload Eligible Staff</span>
                                                </div>
                              
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
            

                                                <form method='post' action="/uploadFile" class="form-horizontal form-bordered" enctype='multipart/form-data' >
                                                {{ csrf_field() }}
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">MDA Full Name *</label>
                                                            <div class="col-md-6"> 
                                                            <input type="text" name="mda" required="required" class="form-control">  
                                                            </div>
                                                        </div>
                                                         
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">MDA Abbreviation *</label>
                                                            <div class="col-md-6"> 
                                                            <input type="text" name="abbrev" required="required" class="form-control">
                                                            </div>
                                                        </div>
                                                         
                                                    </div>
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Eligible Staff</label>
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
                                                                <button type="submit" class="btn green">
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
                                <!-- END PAGE BASE CONTENT -->
                            </div>
                         
@endsection