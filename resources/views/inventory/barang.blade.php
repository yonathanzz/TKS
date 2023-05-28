@extends('layout.conquer')

@section('title', 'List Produk Page')

@section('konten')
    <div class="container">

        <h2>Barang</h2>
        <p>List Barang</p>

        <a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Barang Baru</a>

        <div class="modal fade" id="modalcreate" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Add New Supplier</h4>
                    </div>
                    <form role="form" method="POST" action="{{ route('barang.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" class="form-control" id="stok" name="stok">
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                                </div>
                                <div class="form-group">
                                    <label>HPP</label>
                                    <input type="text" class="form-control" id="hpp" name="hpp">
                                </div>
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url('barang') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Jual</th>
                <th>HPP</th>
                <th>Barcode</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangs as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->stok }} Pcs</td>
                    <td>Rp. {{ $b->harga_jual }}</td>
                    <td>Rp. {{ $b->hpp }}</td>
                    <td>{{ $b->barcode }}</td>
                    <td><a class='btn btn-xs btn-warning' data-toggle='modal' href='#modalEdit'
                            onclick='getEditForm({{ $b->id }})'>+ Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

        <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modalContent">
                    {{-- @include('inventory.getEditForm') --}}
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('javascript')
    <script>
        function getEditForm(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('barang.getEditForm') }}',
                data: {
                    '_token': '<? php echo csrf_token ?>',
                    'id': id
                },
                success: function(data) {
                    $('#modalContent').html(data.msg);
                }
            })
        }
    </script>
@endsection
