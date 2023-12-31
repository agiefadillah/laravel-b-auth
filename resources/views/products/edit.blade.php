@extends('layouts.app')

@push('custom_script')
<script>
    let btnAddNewImage = document.getElementById('btnAddNewImage');
    btnAddNewImage.addEventListener('click', function() {
        let btnAddImageContainer = document.getElementById('btnAddImageContainer');
        let imageInputContainer = document.createElement('div');
        imageInputContainer.classList.add('form-group');
        imageInputContainer.classList.add('mb-3');

        let imageCounter = 2;

        let imageInputEl = document.createElement ('input');
        imageInputEl.setAttribute('type', 'file');
        imageInputEl.setAttribute('name', 'images' + '-' + imageCounter);
        imageInputEl.setAttribute('data-id', imageCounter);

        imageInputContainer.appendChild(imageInputEl);

        btnAddImageContainer.insertAdjacentElement('afterend', imageInputContainer);
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- tambah products --}}
        <div class="col-md-8 mb-5">
            <div class="card">
                <div class="card-header">{{ __('Add Products') }}</div>

                <div class="card-body">

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-group mb-3">
                          <label for="name">Products Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Products Name" value="{{ $product->name }}">

                          @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Products Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Products Description" value="{{ $product->description }}">
                          </div>
                          @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                          <div class="form-group mb-3">
                            <label for="price">Products Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Products Price" value="{{ $product->price }}">
                          </div>
                          @error('price')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror

                      <div class="form-group">
                        <img src="{{ asset('storage/' . $product->image_path )}}" alt="{{ $product->name }}" width="20%">
                      </div>

                          <div class="form-group mb-3" id="btnAddImageContainer">
                            <label for="image">Products Image</label>
                            <button type="button" id="btnAddNewImage" class="btn btn-info btn-sm"> + </button>
                          </div>

                          <div class="form-group mb-3">
                            <input type="file" class="form-control" id="image" name="images[]" multiple>
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

    </div>
</div>
@endsection
