@extends('vendor.layout.layout')

@section('content')
<!-- page title style6 START -->
@include('vendor.header.header',['title'=>'Gallery'])
<!-- page title style6 END -->
<style>

body{
    overflow-x:hidden;
}

#previews{
    overflow-y:scroll;
    padding-left:10px;
    height:450px;
}
</style>
@include('vendor.profile_update_snippet')
<div id="actions" class="row">

      <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button dz-clickable">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
        <button type="submit" class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel upload</span>
        </button>
      </div>

      <div class="col-lg-5">
        <!-- The global file processing state -->
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
          </div>
        </span>
      </div>

    </div>

<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="table table-striped" class="files" id="previews">

            <div id="template" class="file-row">
                <!-- This is used as the file preview template -->
                <div>
                    <span class="preview"><img data-dz-thumbnail /></span>
                </div>
                <div>
                    <p class="name" data-dz-name></p>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <div>
                    <p class="size" data-dz-size></p>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div>
                <button class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                </div>
            </div>

            </div><!-- Preview Table-table-striped -->
        </div><!--col-4 -->
        <div class="col-md-8 col-sm-12">
            @if(count($galleries) == 0)
                <div class="alert alert-success">No Galleries</div>
            @else
                 <form id="delete_gallery" method="post" action="{{url('/delete_gallery')}}">
                    {{csrf_field()}}
                 <input type="submit" class="btn btn-default" value="Delete Selected"/>
                <div  class="cbp cbp-l-grid-team gallery1">
                    <div class="row">
                        @foreach($galleries as $gallery)
                            <div class="col-md-6 col-sm-6">
                                <div class="cbp-item graphics-design">
                                    @php
                                        $image_path = $gallery->is_s3_path ? $gallery->image_name : $path.'/'.$gallery->image_name;
                                    @endphp
                                    <a href="{{$image_path}}" class="cbp-caption nivo-lightbox" data-lightbox-gallery="gallery1">
                                        <div class="cbp-caption-defaultWrap">
                                            <img src="{{$image_path}}" alt="" style="max-width:350px;">
                                        </div>
                                        <div class="cbp-caption-activeWrap">
                                            <div class="cbp-l-caption-alignCenter">
                                                <div class="cbp-l-caption-body">
                                                    <div class="cbp-l-caption-text">ENLARGE</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="checkbox">
                                        <label class="">
                                            <div class="icheckbox_square"><input type="checkbox" value="{{$gallery->image_name}}" name="images[]" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                                        </label>
                                    </div>

                                </div>
                            </div><!--Col-sm-4-->
                @endforeach
                    </div><!--Row-->
                </div>
                </form>
            @endif


        </div>
    </div><!-- End row-->


@endsection

@section('script')

<script src="{{asset('jss/custom/customdropzone.js')}}"></script>

@endsection