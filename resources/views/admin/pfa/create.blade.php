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
    <div class="page-content-container">
        <div class="page-content-row">
    <div class="page-sidebar">
                                <nav class="navbar" role="navigation">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <ul class="nav navbar-nav margin-bottom-35">
                                        <li class="active">
                                            <a href="index.html">
                                                <i class="icon-home"></i> Home </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('staff.index') }}">
                                                <i class="icon-note"></i> Upload Staff List </a>
                                        </li> 
                                  
                                    </ul>
                                    <h3>Quick Actions</h3>
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="#">
                                                <i class="icon-envelope "></i> Inbox
                                                <label class="label label-danger">New</label>
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </nav>
                            </div>
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
                                <div class="note note-success">
                                    <h3>Bootstrap File Input</h3>
                                    <p> The file input plugin allows you to create a visually appealing file or image input widgets. For more info please check out
                                        <a href="http://www.jasny.net/bootstrap/javascript/#fileinput" target="_blank">the official documentation</a>. </p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                        
                                        <!-- BEGIN PORTLET-->
                                        <div class="portlet light form-fit bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-green"></i>
                                                    <span class="caption-subject font-green sbold uppercase">Upload Eligible Staff</span>
                                                </div>
                                                <div class="actions">
                                                    <input type="checkbox" class="make-switch" checked data-on="success" data-on-color="success" data-off-color="warning" data-size="small"> </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
            

                                                <form method='post' action="" class="form-horizontal form-bordered" enctype='multipart/form-data' >
                                                {{ csrf_field() }}
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">MDA</label>
                                                            <div class="col-md-6">
                                                             
                                                            <input type="text" name="mdg" required="required" class="form-control">  
                                                             
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
                                                                <a href="javascript:;" class="btn green">
                                                                    <i class="fa fa-check"></i> Submit</a>
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
                                        <div class="col-md-6">
                                            
                                        <!-- BEGIN PORTLET-->
                                        <div class="portlet light form-fit bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-settings font-green"></i>
                                                    <span class="caption-subject font-green sbold uppercase">Upload MDA's Registered List</span>
                                                </div>
                                                <div class="actions">
                                                    <input type="checkbox" class="make-switch" checked data-on="success" data-on-color="success" data-off-color="warning" data-size="small"> </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form method='post' action="{{ route('upload.reg_list') }}" class="form-horizontal form-bordered" enctype='multipart/form-data' >
                                                {{ csrf_field() }}
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
                                                                <button class="btn green" >
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
                            </div>
                          </div>
                        </div>
@endsection