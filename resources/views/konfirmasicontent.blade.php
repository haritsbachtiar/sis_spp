@extends('main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelola Konfirmasi Pembayaran
        <!-- <small>advanced tables</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="#">Tables</a></li> -->
        <li class="active">Kelola Konfirmasi Pembayaran</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Konfirmasi Pembayaran</h3>
              <!-- <br><button type="button" class="btn btn-primary form-input-biodata">Tambah</button> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th >NIS</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($users))
                @foreach($users as $user)
                @for($i=0;$i<$user->keys_length;$i++)  
                <tr>
                    <td>{{$user->nis}}</td>
                    <td>{{$user->nama}}</td>
                    <td>{{$user->jurusan}}</td>
                    <td>{{$user->kelas}}</td>
                    <td>
                    <img src="{{$user->imgUrl[$i]}}" height="42" width="42"/>          
                    </td>
                    <td><button type="button" class="btn btn-warning form-konfirmasi" 
                    data-key1="{{$user->nis}}" 
                    data-key2="{{$user->keys[$i]}}" 
                    data-key3="{{$user->imgUrl[$i]}}"
                    data-key4="{{$user->nama}}"
                    data-key5="{{$user->bulan[$i]}}"
                    data-key6="{{$user->jumlah[$i]}}" >Konfirmasi</button></td>
                    <!-- <td> <a href=""><button type="button" class="btn btn-primary">delete</button></a></td> -->
                </tr>
                @endfor
                @endforeach
                @endif
                </tbody>
              </table>
            </div>
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
 <div class="modal modal-info fade" id="modal-konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{ URL::action('DatabaseController@konfirmasi') }}" method="POST">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          <div class="modal-header">
          <center>
          <h1 class="modal-title" id="exampleModalLabel"><divisi><span-nama></span-nama></divisi></h1>
          </center>
          </div>
          <div class="modal-body">
          {{csrf_field()}}
          <h3>Bulan yang dibayarkan : <divisi><span-bulan></span-bulan></divisi></h3>
          <h3>Jumlah biaya yang di transfer : <divisi><span-jumlah></span-jumlah></divisi></h3>
          <h3>Bukti Pembayaran</h3>
          <div class="modal-image"></div>
          
          <input class="form-control" type="hidden" name="nis" required/>
          <input class="form-control" type="hidden" name="key" required/>

          <!-- <div class="col-md-6"> -->
              <div class="form-group">
                <label>Bulan yang dibayarkan</label>
                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State"
                style="width: 100%;" tabindex="-1" aria-hidden="true"
                name="bulan[]">
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
              <!-- /.form-group -->
            <!-- </div> -->
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline">Konfirmasi</button>
          </div>
      </div>
	  </form>
  </div>
</div>

@endsection