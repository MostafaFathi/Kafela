@extends('layouts.main',['title' => 'إدارة الاخبار' , 'js'=>'liven'])

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

    <div class="panel-body">
        <form action="" method="get" class="form-horizontal"
              style="    background: white;padding: 3px;border-radius: 0px;border: 1px solid #eaeaea;">
            <h5 style="    padding: 10px;">بحث</h5>
            <div class="form-group">
                <div class="form-group col-md-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-wrapping">الاسم</span>
                    </div>
                    <input type="text" class="form-control" name="name" value="{{request()->get('name')}}"
                           aria-describedby="addon-wrapping">
                </div>
                <div class="form-group col-md-3">
                    <button class="btn btn-success" style="margin: 19px 0px;" type="submit">
                        بحث
                    </button>

                </div>



            </div>
        </form>
    </div>
    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>
                <a href="{{route('post.create')}}" class="btn bg-green-400 btn-labeled new-center-btn"
                   style="float:left;margin-top: -25px;">
                    <b><i class=" icon-user-plus"></i></b> جديد
                </a>
                <div class="heading-elements">

                    <span class="heading-text">إدارة الايتام</span>

                </div>
            </div>


            <div class="table-responsive">
                <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                    <thead>
                    <tr>
                        <th>رقم الخبر</th>
                        <th>العنوان</th>
                        <th>اليتيم</th>
                        <th>الكافل</th>
                        <th>حالة الخبر</th>
                        <th>عمليات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($posts as $key => $item)
                        <tr>
                            <td class="orphan_file_no">{{ $item->id ?? '' }}</td>
                            <td class="name">{{ $item->title ?? '' }}</td>
                            <td class="gender">{{ $item->orphan->name ?? '' }}</td>
                            <td class="orphan_old_year">{{ $item->sponsor->name ?? '' }}</td>
                            <td class="mother_name">{{ $item->status_text ?? '' }}</td>
                            <td class="text-center">

                                <a href="{{route('post.edit',[$item])}}" >
                                    <i class="  icon-pencil7 update-icon"></i>
                                </a>
                                <a href="#" class="delete-orphan-btn"
                                   route="{{route('orphan.delete',['id'=>$item->id ?? ''])}}" style="margin: 0px 3px;">
                                    <i class="  icon-cancel-square delete-icon"
                                       style=" color: #d84315;font-size: 18px;"></i>
                                </a>
                                <input type="hidden" name="orphan" class="orphan" value="{{$item->id ?? ''}}"/>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div style="padding: 22px;">
                    {{ $posts->links() }}
                </div>

            </div>

        </div>
    </div>
    <script>
        //        $(document).on('click', '.details-rows', function () {
        //            alert($(this).index());
        //        });
        $(document).on('click', '.print_excel', function () {

            TableExport.prototype.charset = "charset=utf-8";
            var lang = true;

            var table = TableExport(document.getElementById("requestsTable"), {
                headers: true,
                footers: true,
                formats: ['xlsx'],
                filename: 'submitted applications',
                bootstrap: true,
                exportButtons: false,
                position: 'bottom',
                ignoreRows: null,
                ignoreCols: null,
                trimWhitespace: true,
                RTL: lang,
                sheetname: 'submitted applications'
            });

            var exportData = table.getExportData();
            var xlsxData = exportData.requestsTable.xlsx;
            table.export2file(xlsxData.data, xlsxData.mimeType, xlsxData.filename, xlsxData.fileExtension, xlsxData.merges, xlsxData.RTL, xlsxData.sheetname)
        });
        $(document).on('change', '.delete_all', function () {
            $('.delete_item').prop('checked',$(this).prop('checked'));
        });
    </script>
    <!-- Footer -->

@endsection


