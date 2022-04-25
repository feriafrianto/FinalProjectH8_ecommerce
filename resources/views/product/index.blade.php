@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h1 class="m-0 text-dark">Product</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('product.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Create At</th>
                            <th>Status</th>
                            <th>Actionn</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            <tr>
                                <td><img src="{{url('/images/'.$product->image)}}" style="border-radius: 50%;height: 80px;width: 80px;"alt="Image"/></td>
                                <td><b>{{$product->name}}<br>Kategori : <span class="badge bg-info text-dark">{{$product->subcategory->name}}</span><br>Berat : <span class="badge bg-info text-dark">{{$product->weight}} gr</span></b></td>
                                <td>@currency($product->price)</td>
                                <td>{{$product->created_at->format('d-m-Y H:i')}}</td>
                                <td><span class="badge {{ $product->status == 'Draf' ? 'bg-secondary' : 'bg-success' }}">{{$product->status}}</span></td>
                                <td>
                                    <a href="{{route('product.edit', $product)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('product.destroy', $product)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>
@endpush