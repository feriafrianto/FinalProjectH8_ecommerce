@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Transaksi</h1>
@stop

@section('content')
    <div class="container">
            <table class="table table-hover table-bordered table-stripped" id="DetailTransaksi">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $detail)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->product->subcategory->name }}</td>
                            <td>
                                <img src="{{url('/images/'.$detail->product->image)}}" width="50px" height="50px">
                            </td>
                            <td>Rp {{ $detail->product->price }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>Rp {{ $detail->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
@stop

@section('css')

@stop

@section('js')
<script>
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    $('#DetailTransaksi').DataTable({
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
@stop
