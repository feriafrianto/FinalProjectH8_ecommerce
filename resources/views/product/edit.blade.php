@extends('adminlte::page')

@section('title', 'Edit Produk')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Produk</h1>
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
    <form action="{{route('product.update', $products)}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nama Produk" name="name" value="{{ $products->name }}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        @isset($products)
                        <textarea class="form-control" id="description" placeholder="Masukan Deskripsi" name="description">{{ $products->description }}</textarea>
                        @else
                        <textarea class="form-control" id="description" placeholder="Masukan Deskripsi" name="description"></textarea>
                        @endIf
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
                            <option value="Draf" {{ $products->status == 'Draf' ? 'selected' : ''}}>Draf</option>
                            <option value="Publish" {{ $products->status == 'Publish' ? 'selected' : ''}}>Publish</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_category_id">Kategori</label>
                        <select class="form-control select2" name="sub_category_id" data-placeholder="Pilih Parent Kategori" style="width: 100%;">
                        <option selected>Pilih Kategory</option>
                            @foreach($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}" {{ $sub_category->id == $products->sub_category_id ? 'selected' : ''}}>{{ $sub_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Harga Produk" name="price" value="{{ $products->price }}">
                        @error('price') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="weight">Berat</label>
                        <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" placeholder="Berat Produk" name="weight" value="{{ $products->weight }}">
                        @error('weight') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNameProduct">Foto Produk</label>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <img src="{{ URL::to('/') }}/images/{{ $products->image }}" id="profile-img-tag" height="100" width="100">
                            </div>
                        </div>
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