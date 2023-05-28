@extends('layout.conquer')

@section('title', 'List Supplier Page')

@section('konten')
<div class="container">
    <h2>Supplier</h2>
        <p>List Supplier</p>

        <a data-target="#modalcreate" data-toggle="modal" class="btn btn-info">+ Supplier Baru</a>
        <div class="modal fade" id="modalcreate" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                      <h4 class="modal-title">Add New Supplier</h4>
                  </div>
                  <form role="form" method="POST" action="{{ route('supplier.store') }}">
                      @csrf
                      <div class="modal-body">
                          <div class="form-body">
                              <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" class="form-control" id="nama" name="nama">
                              </div>
                              <div class="form-group">
                                  <label>No Telp</label>
                                  <input type="text" class="form-control" id="no_telp" name="no_telp">
                              </div>
                              <div class="form-group">
                                  <label>Alamat</label>
                                  <input type="text" class="form-control" id="alamat" name="alamat">
                              </div>
                              <div class="form-group">
                                  <label>Nama Sales</label>
                                  <input type="text" class="form-control" id="nama_sales" name="nama_sales">
                              </div>
                              <div class="form-group">
                                  <label>No Rekening</label>
                                  <input type="text" class="form-control" id="no_rekening" name="no_rekening">
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <div class="form-actions">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <a href="{{ url('supplier') }}" class="btn btn-default" data-dismiss="modal">Cancel</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>

    <div class="row">
        @foreach ($suppliers as $supplier)
        <div class="card">
            <img src="profile-image.jpg" class="card-img-top" alt="Profile Image">
            <div class="card-body">
              <h5 class="card-title">{{$supplier->nama}}</h5>
              <p class="card-text">{{$supplier->no_telp}}</p>
              <td><a class="btn btn-success" data-toggle="modal" data-target="#show{{$supplier->id}}">ShowProfile</a></td>
            <div class="modal fade" id="show{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Nama Supplier : {{$supplier->nama}}</p><br>
                    <p>Nomor Telepon : {{$supplier->no_telp}}</p><br>
                    <p>Alamat : {{$supplier->alamat}}</p><br>
                    <p>Nama Sales : {{$supplier->nama_sales}}</p><br>
                    <p>Nomor Rekening : {{$supplier->no_rekening}}</p><br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
