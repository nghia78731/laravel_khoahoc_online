@extends('admin.layout.index')

@section('content')

            @if (session('thongbao'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ session('thongbao') }}</li>
                    </ul>
                </div>
            @endif


            <table style="background-color: white" class="table">
                <h2 style="text-align: center">DANH SÁCH THỂ LOẠI LỚP HỌC</h2>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên thể loại lớp học</th>
                    <th>Mô tả</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listClassTypes as $listClassType)
                    <tr>
                        <td>{{ $listClassType->id }}</td>
                        <td>{{ $listClassType->name }}</td>
                        <td>{{ $listClassType->description }}</td>
                        <td><a href=""><i class="fa fa-bath" ></i></a></td>
                        <td><a onclick="return confirm('Bạn có muốn xóa ko')" href="{{ route('class_type.destroy', $listClassType->id) }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection