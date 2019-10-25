@extends('admin.layout.index')

@section('content')
    <form style="background-color: white" class="form-group" method="POST" action="{{ route('class.store') }}">
        <h2 style="text-align: center">Thêm Lớp Học</h2>
        @if (session()->has('thongbao'))
            <div class="alert alert-success">
                {{ session('thongbao') }}
            </div>
        @endif

        @csrf
        <div class="form-group">
            <label>Thể loại lớp học</label>
            <select name="class_type_id">
                @foreach($class_type as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tên lớp học</label>
            <input type="text" name="name" style="width: 100%">
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <input type="text" name="description" style="width: 100%">
        </div>

        <div class="form-group">
            <label>Số Lương học sinh</label>
            <input type="text" name="capacity" style="width: 100%">
        </div>

        <div class="form-group">
            <label>Thời gian bắt đầu</label>
            <input type="date" name="start_date" style="width: 100%">
        </div>

        <div class="form-group">
            <label>Thời gian kết thúc</label>
            <input type="date" name="end_date" style="width: 100%">
        </div>
        <input type="hidden" name="completed" value="Chưa hoàn thành">

        <button type="submit" class="btn btn-success">Thêm</button>

    </form>
@endsection