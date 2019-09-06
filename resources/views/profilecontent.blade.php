@extends('main')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box bg-gray color-palette">
            <div class="box-header">
              <center>
              <h1>DATA DIRI</h1>
              </center>
            </div>
            <!-- /.box-header -->
                @if($profile == null)
            <!-- form start -->
            <form  action="{{ URL::action('DatabaseController@setBiodata') }}" method="POST">
              <div class="box-body">
              {{csrf_field()}}
              <input type="hidden" name="nim_nip_nidk" value="{{\Session::get('userid')}}"/>
              <input type="hidden" name="status" value="success"/>
                <div class="form-group">
                    <label>NAMA</label>
                    <input type="text" class="form-control" name="nama" placeholder="Enter ..." required>
                </div>
                <div class="form-group">
                  <label>JENIS KELAMIN</label>
                  <select class="form-control" name="jenis_kelamin">
                    <option>Pria</option>
                    <option>Wanita</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">E-MAIL</label>
                  <input type="email" class="form-control" name="e_mail" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label>NO. TELEPON</label>
                    <input type="text" class="form-control" name="no_telp" placeholder="Enter ...">
                </div>
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Submit</button>
              </div>
              <!-- /.box-body -->
            </form>
                @endif

                @if($profile != null)
                <div class="box-body">
                <h3><center>
                  <table>
                  <tr>
                    <td><p>NIM/NIP/NIDK</p></td>
                    <td><p>&nbsp;:&nbsp;{{$profile->nim_nip_nidk}}</p></td>
                  </tr>
                  <tr>
                    <td><p>Nama</p></td>
                    <td><p>&nbsp;:&nbsp;{{$profile->nama}}</p></td>
                  </tr>
                  <tr>
                    <td><p>Jenis Kelamin</p></td>
                    <td><p>&nbsp;:&nbsp;{{$profile->jenis_kelamin}}</p></td>
                  </tr>
                  <tr>
                    <td><p>E-Mail</p></td>
                    <td><p>&nbsp;:&nbsp;{{$profile->e_mail}}</p></td>
                  </tr>
                  <tr>
                    <td><p>No. Telp</p></td>
                    <td><p>&nbsp;:&nbsp;{{$profile->no_telp}}</p></td>
                  </tr>
                  </table>
                </center></h3>
                <button type="button" class="btn btn-primary pull-right form-submit-profile" data-key="{{$profile->nim_nip_nidk}}"><i class="fa fa-edit"></i>Edit</button>
            </div>
                @endif
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      <!-- </div> -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<!-- MODAL UPDATE -->
<div class="modal modal-success fade" id="modal-update-profile" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ URL::action('DatabaseController@setBiodata') }}" method="POST">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-header">
          <center>
          <h1 class="modal-title" id="exampleModalLabel">Edit Data Diri</h1>
          </center>
        </div>
        <div class="modal-body">
	        <!-- <h5>form update</h5> -->
        	{{csrf_field()}}
          
            <input type="hidden" name="nim_nip_nidk" required/>
          
          <div class="form-group">
            <label>Nama</label>
            <input class="form-control" type="text" name="nama" required/>
            </div>
            <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin">
                    <option>Pria</option>
                    <option>Wanita</option>
                  </select>
            </div>
          <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="text" name="e_mail" required/>
          </div>
          <div>
            <label>No. Telp</label>
            <input class="form-control" type="text" name="no_telp"/>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline">Save changes</button>
        </div>
	    </div>
  	</form>
  </div>
</div>

@endsection