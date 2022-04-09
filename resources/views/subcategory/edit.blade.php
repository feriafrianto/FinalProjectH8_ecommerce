@extends('adminlte::page')

@section('title', 'Edit Sub Category')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Sub Category</h1>
@stop

@section('content')
    <form action="{{route('subcategory.update', $subcategory)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama Sub Kategori" name="name" value="{{$subcategory->name ?? old('name')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Kategori</label>
                        <select class="form-control select2" name="category_id" data-placeholder="Pilih Parent Kategori" style="width: 100%;">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('subcategory.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop