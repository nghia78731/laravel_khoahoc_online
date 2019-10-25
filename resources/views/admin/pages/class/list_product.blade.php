@extends('admin.layout.index')

@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Danh sách sản phẩm</li>
            </ol>

            @if (session('thongbao'))
                <div class="alert alert-success">
                    <ul>
                        <li>{{ session('thongbao') }}</li>
                    </ul>
                </div>
            @endif

            <h2 style="text-align: center">Danh sách sản phẩm</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Giảm giá</th>
                        <th>Hình ảnh</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->unit_price }}</td>
                            <td>{{ $product->promotion_price }}</td>
                            <td><img style="width: 100px; height: 100px" src="{{ asset('images/product').'/'.$product->image }}"></td>
                            <td><a href="{{ route('dashboard.showeditproduct', $product->id) }}"><i class="fa fa-bath" ></i></a></td>
                            <td><a onclick="return confirm('Bạn có muốn xóa ko')" href="{{ route('dashboard.deleteproduct', $product->id) }}"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection