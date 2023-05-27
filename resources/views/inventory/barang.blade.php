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
                            <td><a class="btn btn-success" data-toggle="modal"
                                    data-target="#show{{ $barang->id }}">ShowProfile</a></td>
                            <div class="modal fade" id="show{{ $barang->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Nama Barang : {{ $barang->nama }}</p><br>
                                            <p>Stok Barang : {{ $barang->stok }}</p><br>
                                            <p>Harga Jual : {{ $barang->harga_jual }}</p><br>
                                            {{-- <p>{{ $barang->hpp }}</p><br> --}}
                                            {{-- <p>{{ $barang->barcode }}</p><br> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
