@extends('layouts.main',['title' => 'تعديل خبر' , 'js'=>'liven'])

@section('content')
    {{--for validation errors--}}
    <validation class="validation hide">
        <error class="validation-error">
            <div class="form-control-feedback">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block">Error input</span>
        </error>
    </validation>
    {{--for validation errors--}}


    <!-- Main charts -->
    <div class="row">
        <div class="col-lg-12">


            {{--add users form --}}
            <form action="post" method="put" id="post_submit_form" route="{{route('post.update',[$post])}}"
                  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                @method('put')
                {{ csrf_field() }}
                <a href="#" class="blockMe" style="display: none"></a>
                <div class="panel panel-flat" id="table-block">
                    <div class="panel-heading">
                        <h5 class="panel-title">تعديل خبر</h5>

                    </div>

                    <div class="panel-body">

                        <div class="form-group">
                            <label class="col-lg-2 control-label">العنوان:</label>
                            <div class="col-lg-5">
                                <input type="text" name="title" class="title form-control " value="{{$post->title ?? ''}}"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">المحتوى:</label>
                            <div class="col-lg-10">
                                <textarea class="form-control editoren" id="editoren" name="description">{{$post->content ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">اليتيم:</label>
                            <div class="col-lg-5">
                                <select name="orphan_id" id="orphan_id" class="form-control orphan_id">
                                    <option value="" {{$post->orphan_id == '' ? 'selected' : ''}} >بلا يتيم</option>
                                    @foreach($orphan as $item)
                                    <option value="{{$item->id}}" {{$post->orphan_id == $item->id ? 'selected' : ''}}   >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">الكافل:</label>
                            <div class="col-lg-5">
                                <select name="sponsor_id" id="sponsor_id" class="form-control sponsor_id">
                                    <option value="" selected>الكل</option>
                                    @foreach($sponsor as $item)
                                    <option value="{{$item->id}}" {{$post->sponsor_id == $item->id ? 'selected' : ''}}  >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="text-right">
                            <button type="submit" class="btn btn-primary " id="add-button">
                                <i class=" icon-floppy-disk position-right" style="margin-top: 2px"></i>
                                حفظ التغييرات
                                <i class="icon-spinner2 spinner position-left hide loader"
                                   style="margin-top: 3px;float: left;"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </form>

        </div>


    </div>


    <!-- Footer -->

@endsection

@section('js_code')
@section('js_code')
    <script>


        function CKupdate(){
            for ( instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();
        }
        function init_ckeditor() {

            var conf = {
                config: {
                    allowedContent: 'a[!href,target];img[src,alt,width,height]; span[*](*)',
                }
                ,
                basePath :'/portal/assets/js/ckeditor/',

                //    extraPlugins: 'image2',
                height: 300,

                // Upload images to a CKFinder connector (note that the response type is set to JSON).
                uploadUrl: '{{route('ck_upload_image')}}',

                // Configure your file manager integration. This example uses CKFinder 3 for PHP.
                filebrowserBrowseUrl: '',
                filebrowserImageBrowseUrl: '',
                filebrowserUploadUrl: '{{route('ck_upload_image')}}',
                filebrowserImageUploadUrl: '{{route('ck_upload_image')}}',

                font_names: 'TheSans-Plain/TheSans-Plain;' + 'DINNextLTW23-Light/DINNextLTW23-Light;',


                contentsCss: [
                    '/website/css/ckeditorcontents.css'
                ],

                fullPage : false
            }
            CKEDITOR.replace('editoren', conf);

            CKEDITOR.on('instanceReady', function () {
                CKEditor_loaded = true;


            });


        }

        init_ckeditor();
        CKupdate();
    </script>
@endsection
@section('js_assets')
    <script src="https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script>
@endsection
