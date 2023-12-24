@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- tambah products --}}
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-header">{{ __('Add Products') }}</div>

                <div class="card-body">

                    <form action="{{ route('products.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                          <label for="name">Products Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Products Name">

                          @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">Products Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Products Description">
                          </div>
                          @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                          <div class="form-group mb-3">
                            <label for="name">Products Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Products Price">
                          </div>
                          @error('price')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                          <div class="form-group mb-3">
                            <label for="image">Products Image</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Products Image">
                          </div>
                          @error('image')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>
        </div>

        {{-- table --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List Products') }}</div>

                <div class="card-body">

                    <table class="table-bordered">
                        <th>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Description</td>
                            <td>Image</td>
                            <td>Status</td>
                        </th>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->image }}</td>
                            <td>{{ $product->status }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td>No Products Found</td>
                        </tr>
                        @endforelse
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
