@extends('layout.conquer')

@section('title', 'List Produk Page')

@section('konten')
<div class="container">
    <div class="row">
        @foreach ($barangs as $barang)
            <div class="col-md-4">
                <div class="card">
                    {{-- <img src="{{ $barang->image }}" class="card-img-top" alt="{{ $barang->name }}"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $barang->nama }}</h5>
                        <p class="card-text">{{ $barang->harga_jual }}</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
