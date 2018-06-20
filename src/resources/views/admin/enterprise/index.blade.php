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
                    url: '/adminApi/enterprises',
                    data: function (d) {
                        d.search = $('#search').val();
                        d.province = $('input[name=choose_province]').val();
                        d.city = $('input[name=choose_city]').val();
                        d.begin = $('#d4311').val();
                        d.end = $('#d4312').val();
                    }
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false, render: function (data, type, full, meta) {
                        return ++meta.row;
                    }},
                    {data: 'name', name: 'name', orderable: false},
                    {data: 'mobile', name: 'mobile', orderable: false},
                    {data: 'address_province', name: 'address_province', orderable: false, render: function (data, type, row) {
                        var city = row['address_city'] === null ? '' : row['address_city'];
                            return row['address_province'] + city + row['address_district'];
                        }},
                    {data: 'company_name', name: 'company_name', orderable: false},
                    {data: 'origin_from', name: 'origin_from', orderable: false, render: function (data, type, row) {
                            if (parseInt(row['origin_from']) === 1) {
                                return '网站';
                            } else {
                                return '后台';
                            }
                        }},
                    {data: 'created_at', name: 'created_at', orderable: false},
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
                        url: '/adminApi/enterprises/' + id + '/delete'
                    }).done(function (data) {
                        layer.msg('删除成功', {icon: 1});
                        dataTable.draw();
                    })
                });
            });

            $('#search-submit').on('click', function(e) {
                dataTable.draw();
                e.preventDefault();
            });

            $('#date-submit').on('click', function(e) {
                var d1 = $('#d4311').val();
                var d2 = $('#d4312').val();
                if (d1 === '' || d2 === '') {
                    layer.msg('需要同时选择开始和结束时间');
                } else {
                    dataTable.draw();
                    e.preventDefault();
                }
            });

            // Excel import
            $('.btn-excel').on('click', function () {
                $('#excel').click();
            });
            $('#excel').on('change', function (e) {
                var formData = new FormData();
                formData.append('file', $('#excel')[0].files[0]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('adminApi/enterprises/import') }}",
                    type: 'POST',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json'
                }).done(function (data) {
                    if (data.status === 1) {
                        layer.msg('文件导入成功');
                    } else {
                        layer.msg(data.message);
                    }
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                });
            });

            // 导出
            $('body').on('click', '.btn-export', function () {
                var id = $(this).data('id');
                //示范一个公告层
                layer.open({
                    type: 1
                    ,title: '选择时间' //不显示标题栏
                    ,closeBtn: false
                    ,area: '300px;'
                    ,shade: 0.5
                    ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,resize: false
                    ,btn: ['导出', '取消']
                    ,btnAlign: 'r'
                    ,moveType: 1 //拖拽模式，0或者1
                    ,content: '<div style="padding: 10px;">' +
                    '<p class="length" style="margin-top: 10px;width: 100%;">开始时间： <input type="text" name="arrive_time" id="arrive_time" class="form-control" onclick="WdatePicker({dateFmt:\'yyyy-MM-dd HH:mm\'})" value="{{ date('Y-m-d H:i') }}"></p>' +
                    '<p class="length" style="margin-top: 10px;width: 100%;">结束时间：<input type="text" name="leave_time" id="leave_time" class="form-control" onclick="WdatePicker({dateFmt:\'yyyy-MM-dd HH:mm\'})" value=""></p>' +
                    '</div>'
                    ,yes: function (index, layero) {
                        var arrive_time = $('#arrive_time').val();
                        var leave_time = $('#leave_time').val();
                        if (arrive_time && leave_time) {
                            layer.msg('导出成功');
                            layer.close(index);
                            window.location.href = '{{ url('adminApi/enterprises/export') }}' + '?begin_time='+arrive_time+'&end_time='+leave_time;
                        } else {
                            layer.msg('请选择开始时间和结束时间');
                        }
                    }
                });
            });

            $('.cities').citys({
                required: false,
                nodata: '',
                onChange: function (data) {
                    $('input[name=choose_province]').val(data['province']);
                    $('input[name=choose_city]').val(data['city']);
                    dataTable.draw();
                    e.preventDefault();
                }
            });
        });

    </script>
@endsection

@section('content')
    <input type="hidden" name="choose_province">
    <input type="hidden" name="choose_city">
    <div class="box">
        <div class="box-body table-responsive">
            <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th colspan="10">
                        <a href="{{ url('admin/enterprises/create') }}" class='btn btn-success btn-sm'>新增</a>
                        <a href="#" class='btn btn-success btn-sm btn-excel'>导入</a>
                        <input type="file" name="excel" id="excel" style="display: none;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        <a href="#" class='btn btn-success btn-sm btn-export'>导出</a>
                        <div  style="float: right">
                            筛选：
                            <span class="cities">
                                <select name="province" id="province"></select>
                                <select name="city" id="city"></select>
                            </span>
                            <input type="text" id="d4311" class="WdatePicker form-control" onclick="WdatePicker({maxDate:'#F{$dp.$D(\'d4312\')||\'2020-10-01\'}'})"> -
                            <input type="text" id="d4312" class="WdatePicker form-control" onclick="WdatePicker({minDate:'#F{$dp.$D(\'d4311\')}',maxDate:'2020-10-01'})">
                            <button type="button" id="date-submit" class="btn btn-default btn-flat">时间查询</button>
                            <input type="text" class="form-control" id="search" placeholder="请输入联系称呼/联系方式搜索">
                            <button type="button" id="search-submit" class="btn btn-default btn-flat">搜索</button>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>序号</th>
                    <th>联系称呼</th>
                    <th>联系方式</th>
                    <th>公司地址</th>
                    <th>公司名称</th>
                    <th>来源</th>
                    <th>提交时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
