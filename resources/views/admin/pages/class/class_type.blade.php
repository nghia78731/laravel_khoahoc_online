@extends('admin.layout.index')

@section('content')
    <form style="background-color: white" class="form-group" method="POST" action="{{ route('class_type.store') }}">
        <h2 style="text-align: center">THÊM THỂ LOẠI LỚP HỌC</h2>
        @if (session()->has('thongbao'))
            <div class="alert alert-success">
                {{ session('thongbao') }}
            </div>
        @endif

        @csrf
        <div class="form-group">
            <label>Tên thể loại lớp học</label>
            <input type="text" name="name" style="width: 100%">
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <input type="text" name="description" style="width: 100%">
        </div>

        <button type="submit" class="btn btn-success">Thêm</button>

    </form>



@endsection