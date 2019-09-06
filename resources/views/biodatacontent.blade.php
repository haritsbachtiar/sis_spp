@extends('main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola User
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="#">Tables</a></li> -->
        <li class="active">Kelola User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <section class="content-header">
                <h3 class="box-title">Daftar User</h3>
                <div class="breadcrumb">
                  <button type="button" class="btn btn-primary form-input-tagihan">Buat Tagihan Baru</button>
                </div>
                <br><br>
                <form action="{{ URL::action('SqlController@getUsers') }}" method="POST">
                  {{csrf_field()}}
              <div class="form-group">
                <label>Kelas</label>
                  <select class="form-control" name="kelas">
                    <option>X</option>
                    <option>XI</option>
                    <option>XII</option>
                  </select>
                </div>  
                <div class="form-group">
                  <label>Jurusan</label>
                  <select class="form-control" name="jurusan">
                    <option>TBSM</option>
                    <option>TKR</option>
                    <option>TP</option>
                    <option>RPL</option>
                    <option>TKJ</option>
                    <option>TITL</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-warning">Lihat Kelas</button>
              </form>
            </section>
            </div>
            <!-- /.box-header -->
            @if(isset($users))
            <h3 class="box-title">Kelas : {{$kelas}}</h3>
            <br>
            <h3 class="box-title">Jurusan : {{$jurusan}}</h3>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp.</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Tagihan</th>
                    <!-- <th>Aksi</th> -->
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)  
                <tr>
                    <td>{{$user->nis}}</td>
                    <td>{{$user->nama}}</td>
                    <td>{{$user->alamat}}</td>
                    <td>{{$user->no_telp}}</td>
                    <td>{{$user->kelas}}</td>
                    <td>{{$user->jurusan}}</td>
                    <td>
                    @foreach($user->bulan as $bulan)
                    {{$bulan}}&nbsp;
                    @endforeach
                    </td>
                    <!-- <td><button type="button" class="btn btn-primary form-submit-course" data-key="">edit</button> -->
                    <!-- <a href=""><button type="button" class="btn btn-primary">delete</button></a></td> -->
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
              @endif
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- MODAL INPUT -->
<div class="modal modal-info fade" id="modal-inputBiodata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{ URL::action('DatabaseController@setBiodata') }}" method="POST">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          <div class="modal-header">
          <center>
          <h1 class="modal-title" id="exampleModalLabel">Tambah User</h1>
          </center>
          </div>
          <div class="modal-body">
          {{csrf_field()}}
            <div>
            <label>NIS</label>
            <input class="form-control" type="text" name="username" required/>
            </div>
            <div>
            <label>Password</label>
            <input class="form-control" type="text" name="password" required/>
            </div>
            <div>
            <label>Nama</label>
            <input class="form-control" type="text" name="nama" required/>
            </div>
            <div>
            <label>Alamat</label>
            <input class="form-control" type="text" name="alamat" required/>
            </div>
            <div>
            <label>No Telp</label>
            <input class="form-control" type="text" name="no_telp" required/>
            </div>
            <div class="form-group">
                  <label>Jurusan</label>
                  <select class="form-control" name="jurusan">
                    <option>TBSM</option>
                    <option>TKR</option>
                    <option>TP</option>
                    <option>RPL</option>
                    <option>TKJ</option>
                    <option>TITL</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <select class="form-control" name="kelas">
                    <option>X</option>
                    <option>XI</option>
                    <option>XII</option>
                  </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline">Save</button>
          </div>
      </div>
	  </form>
  </div>
</div>

  <!-- MODAL INPUT TAGIHAN -->
  <div class="modal modal-info fade" id="modal-inputTagihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{ URL::action('SqlController@setPrices') }}" method="POST">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          <div class="modal-header">
          <center>
          <h1 class="modal-title" id="exampleModalLabel">Tambah Tagihan</h1>
          </center>
          </div>
          <div class="modal-body">
          {{csrf_field()}}
          <input class="form-control" type="hidden" name="status" value="Belum" required/>
            <div class="form-group">
                  <label>Bulan</label>
                  <select class="form-control" name="bulan">
                    <option>Januari</option>
                    <option>Februari</option>
                    <option>Maret</option>
                    <option>April</option>
                    <option>Mei</option>
                    <option>Juni</option>
                    <option>Juli</option>
                    <option>Agustus</option>
                    <option>September</option>
                    <option>Oktober</option>
                    <option>November</option>
                    <option>Desember</option>
                  </select>
            </div>
            <div>
            <label>Tahun</label>
            <input class="form-control" type="text" name="tahun" required/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline">Save</button>
          </div>
      </div>
	  </form>
  </div>
</div>

  @endsection