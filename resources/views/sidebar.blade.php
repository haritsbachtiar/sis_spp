<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="{{URL::action('SqlController@getFilter')}}">
          <i class="fa fa-circle-o"></i>
           <span>Kelola Pengguna<span>
          </a>
        </li>
        <li class="">
          <a href="{{URL::action('DatabaseController@index')}}">
          <i class="fa fa-circle-o"></i>
           <span>Kelola Pembayaran<span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>