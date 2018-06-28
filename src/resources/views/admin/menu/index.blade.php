@extends('admin.layouts.admin')

@section('title', '服务商入驻')

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
                    url: '/adminApi/menus'
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, render: function (data, type, full, meta) {
                        return ++meta.row;
                    }},
                    {data: 'name', name: 'name', orderable: false},
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

            $('body').on('click', '.delete', function () {
                var id = $(this).data('id');
                //询问框
                layer.confirm('确定删除？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/adminApi/menus/' + id + '/delete'
                    }).done(function (data) {
                        layer.msg('删除成功', {icon: 1});
                        if (parseInt(data) === 1) {
                            $('#dataTable thead').prepend("<tr>\n" +
                                "                    <th colspan=\"10\">\n" +
                                "                        <a href=\"{{ url('admin/menus/create') }}\" class='btn btn-success btn-sm'>新增</a>\n" +
                                "                    </th>\n" +
                                "                </tr>");
                        }
                        dataTable.draw();
                    })
                });
            });

        });

    </script>
@endsection

@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                @if ($count < 5)
                <tr>
                    <th colspan="10">
                        <a href="{{ url('admin/menus/create') }}" class='btn btn-success btn-sm'>新增</a>
                    </th>
                </tr>
                @endif
                <tr>
                    <th>序号</th>
                    <th>名称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
