@extends('adminlte::page')

@section('title', 'Tambah Transaksi')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Transaksi</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                Pilih Barang
            </div>
            <div class="card-body">
                <form action="{{ route('cart.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" id="productId">

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="productName" placeholder="Pilih barang..." readonly>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#pilihBarang">Pilih</button>
                            </div>
                        </div>

                        <div class="modal fade" id="pilihBarang">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Pilih Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <table class="table table-hover table-bordered table-stripped tableBarang">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Kategory</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $key => $product)
                                                <tr>
                                                    <td><img src="{{url('/images/'.$product->image)}}" style="border-radius: 50%;height: 80px;width: 80px;" alt="Image" /></td>
                                                    <td><b>{{$product->name}}<b></td>
                                                    <td>@currency($product->price)</td>
                                                    <td>{{$product->subcategory->name}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" onclick="
                                                                        $('#productId').val('{{ $product->id }}')
                                                                        $('#productName').val('{{ $product->name }}')
                                                                        $('#productQty').attr('max', '{{ $product->stock }}')
                                                                    ">
                                                            Pilih
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" min="1" value="1" class="form-control" name="quantity" id="productQty" placeholder="Masukkan jumlah..." required>
                            <div class="input-group-append">
                                <span class="input-group-text">Unit</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Tambah</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <table class="table">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productCarts as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{$product->subcategory->name}}</td>
                    <td>@currency($product->price)</td>
                    <td>{{ $product->cart->quantity }}</td>
                    <td>@currency($product->price * $product->cart->quantity)</td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ubahJumlah{{ $loop->iteration }}">Ubah</button>
                        <form action="{{ route('cart.destroy', $product->cart) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                        <div class="modal fade" id="ubahJumlah{{ $loop->iteration }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ubah Jumlah '{{ $product->name }}'</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('cart.update', $product->cart) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="number" min="1" max="{{ $product->stock }}" value="{{ $product->cart->quantity }}" class="form-control" name="quantity" placeholder="Masukkan jumlah..." required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Unit</span>
                                                        <button type="submit" class="btn btn-primary float-right">Ubah</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Pembayaran
    </div>
    <div class="card-body">
        <form action="{{ route('transaction.store') }}" method="post">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Total Harga</label>

                <div class="input-group col-sm-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="total" value="{{ 
                                        $productCarts->sum(function ($product) {
                                            return $product->price * $product->cart->quantity;
                                        })
                                    }}" placeholder="0" readonly required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Total Bayar</label>

                <div class="input-group col-sm-10">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="pay_total" placeholder="0" min="{{
                                        $productCarts->sum(function ($product) {
                                            return $product->price * $product->cart->quantity;
                                        })
                                    }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="date" value="{{ date('d F Y') }}" disabled>
                </div>
            </div>

            <button type="submit" class="btn btn-primary float-right">Bayar</button>
        </form>
    </div>
</div>



@stop

@section('css')

@stop

@section('js')
<script>
    $('.tableBarang').DataTable({
        "responsive": true,
    });
</script>
@stop