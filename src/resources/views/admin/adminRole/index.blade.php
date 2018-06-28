@extends('admin.layouts.admin')

@section('title', '角色列表')

@section('css')
    <link rel="stylesheet" href="{{ asset('static/admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('js')
    <script src="{{ asset('static/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('static/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        var dataTable = null;
        $(function(){
            //数据表格
            dataTable = $("#dataTable").DataTable({
                lengthChange: false,
                searching: false,
                processing: false,
                serverSide: true,
                ajax: {
                    url: '/adminApi/adminRole'
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, render: function (data, type, full, meta) {
                            return ++meta.row;
                        }},
                    {data: 'name', name: 'name', orderable: false},
                    {data: 'count', name: 'count', orderable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                language : {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json"
                }
            });

            dataTable.on('preXhr.dt', function () {
                loadShow();
            });
            dataTable.on('draw.dt', function () {
                loadShow(0);
            });
        })

        /**
         * 删除数据
         * @param $id
         */
        function delData(id)
        {
            id = parseInt(id);
            fc_confirm("您要确认删除该角色么?", function(){
                fc_ajax("/adminApi/adminRole/"+id, {_method:'delete'}, 'post', 'json', function(res){
                    if(res.status == 'successful'){
                        //刷新数据
                        dataTable.ajax.reload();
                        fc_msg("删除成功!", 1);
                        return;
                    }
                    fc_msg(res.errors.message, 0);
                });
            });
        }
    </script>
@endsection

@section('content')

    <div class="box">
    <div class="box-header with-border">
    <h3 class="box-title">角色列表</h3>
    </div>
        <div class="box-body table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th colspan="6">
                        @if(adminAuth('admin.adminRole.create'))
                        <a href="{{ url('admin/adminRole/create') }}" class='btn btn-success btn-sm'>新增角色</a>
                        @endif
                    </th>
                </tr>
                <tr>
                    <th>序号</th>
                    <th>角色</th>
                    <th>下属账号数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div>
@endsection
