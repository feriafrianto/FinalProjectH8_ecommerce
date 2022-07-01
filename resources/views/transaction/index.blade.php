@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <h1 class="m-0 text-dark">List Transaksi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('transaction.create')}}" class="btn btn-primary mb-2">
                        Tambah Transaksi
                    </a>
                    <a href="{{route('transaction.export')}}" class="btn btn-info mb-2">
                        Export PDF
                    </a>
                    <table class="table table-hover table-bordered table-stripped" id="dataTransaksi">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kasir</th>
                            <th>Total Harga</th>
                            <th>Total Bayar</th>
                            <th>Waktu Transaksi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $key => $transaction)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$transaction->user->name}}</td>
                                <td>Rp {{ $transaction->total }}</td>
                                <td>Rp {{ $transaction->pay_total }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>
                                    <a href="{{ route('transaction.show', $transaction) }}">
                                        <button class="btn btn-sm btn-info">Lihat</button>
                                    </a>
                                    <form action="{{ route('transaction.destroy', $transaction) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
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

@section('css')

@stop

@section('js')
<script>
    $('#dataTransaksi').DataTable({
        "responsive": true,
    });
</script>
@stop