$(".form-input-biodata").click(function(){
    console.log('Hello');
    $("#modal-inputBiodata").modal('show');
});

$(".form-input-tagihan").click(function(){
    console.log('Hello');
    $("#modal-inputTagihan").modal('show');
});

$(".form-konfirmasi").click(function(){
    console.log('Hello');
    let nis=$(this).attr("data-key1");
    let keys=$(this).attr("data-key2");
    let imgUrl=$(this).attr("data-key3");
    let nama=$(this).attr("data-key4");
    let bulan=$(this).attr("data-key5");
    let jumlah=$(this).attr("data-key6");
    console.log(nis,keys,imgUrl);
    // $.ajax({
        // url: "/value/detail/"+id_nilai,
    // }).done(function(res){
    //     console.log(res); 
    //     let id_nilai=res.data.id_nilai;
    //     let nama_mk=res.data.nav.nama_mk;
    //     // console.log(nama_mk);
    //     let nilai=res.data.nilai;
        
    let image = '<center> <img src="'+imgUrl+'" width="550" /></center>';
    $("input[name='nis']").val(nis);
    $("input[name='key']").val(keys);
    $( "divisi" ).data( "test", { 
        first: nama,
        next: bulan,
        last: jumlah    
        } );
    $( "span-nama" ).text( $( "divisi" ).data( "test" ).first );
    $( "span-bulan" ).text( $( "divisi" ).data( "test" ).next );
    $( "span-jumlah" ).text( $( "divisi" ).data( "test" ).last );
        
    $("#modal-konfirmasi").modal('show');
    $('#modal-konfirmasi').on('shown.bs.modal', function() {
        $('#modal-konfirmasi').find('.modal-image').append(image);
      });
    // }).catch(function(err){
    //     alert(err.message)
    // })
    // $("#modal-konfirmasi").modal('show');
});