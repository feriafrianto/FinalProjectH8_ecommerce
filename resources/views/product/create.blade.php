@extends('adminlte::page')

@section('title', 'Tambah Produk')

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Produk</h1>
@stop

@section('content')
    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable
        {
            min-height: 320px !important;
            max-height: 800px !important;
        }
    </style>
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Produk" name="name" value="{{old('name')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" placeholder="Masukan Deskripsi" name="description"></textarea>
                        @error('description') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
        <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control select2" name="status" data-placeholder="Pilih Kategori" style="width: 100%;">
                            <option selected>Pilih Status</option>
                            <option value="Draf">Draf</option>
                            <option value="Publish">Publish</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_category_id">Kategori</label>
                        <select class="form-control select2" name="sub_category_id" data-placeholder="Pilih Parent Kategori" style="width: 100%;">
                        <option selected>Pilih Kategory</option>
                            @foreach($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Harga Produk" name="price" value="{{old('price')}}">
                        @error('price') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">Berat</label>
                        <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" placeholder="Berat Produk" name="weight" value="{{old('weight')}}">
                        @error('weight') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNameProduct">Foto Produk</label>
                        <input type="file" name="image" class="form-control">
                        @error('name_produk') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('category.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
    console.error( error );
    } );
</script>
@stop