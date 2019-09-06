<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\User;

class DatabaseController extends Controller
{
    //
    public function index(){
        $users = User::where('nis', '7221')->get();
        // $users = User::all();

        set_time_limit(60000);    
        
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
        ->create();
        $database 	= $firebase->getDatabase();
        
        
        foreach($users as $user){
            $user->keys_length = 0;
            $temp_imgUrl = [];
            $user->imgUrl = [];
            $temp_bulan = [];
            $user->bulan = [];
            $temp_jumlah = [];
            $user->jumlah = [];
            $user->keys = [];
            $check_pembayaran = $database->getReference('Request/'.$user->nis.'/Pembayaran')->getValue();
            if($check_pembayaran != NULL){
                $keys = array_keys($database->getReference('Request/'.$user->nis.'/Pembayaran')->shallow()->getValue());
                foreach($keys as $key){
                    $imgUrl = $database->getReference('Request/'.$user->nis.'/Pembayaran'.'/'.$key.'/imgUrl')->getValue();
                    $status = $database->getReference('Request/'.$user->nis.'/Pembayaran'.'/'.$key.'/status')->getValue();
                    $bulan = $database->getReference('Request/'.$user->nis.'/Pembayaran'.'/'.$key.'/bulan')->getValue();
                    $jumlah = $database->getReference('Request/'.$user->nis.'/Pembayaran'.'/'.$key.'/jumlah')->getValue();
                    if($status != NULL){ 
                    }else{
                        $user->keys_length++;
                        array_push($temp_imgUrl, $imgUrl);
                        array_push($temp_bulan, $bulan);
                        array_push($temp_jumlah, $jumlah);
                    }
                }
                $user->imgUrl = $temp_imgUrl;
                $user->bulan = $temp_bulan;
                $user->jumlah = $temp_jumlah;
                $user->keys = $keys;
            }else{
            }
        }
        return view('konfirmasicontent', ['users'=>$users]);
    }

    public function konfirmasi(Request $req){
        $nis = $req->input('nis');
        $key = $req->input('key');
        $bulan_input = $req->input('bulan');
        
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
        ->create();
        $database 	= $firebase->getDatabase();
        
        // $database->getReference('Request/'.$nis.'/Pembayaran'.'/'.$key.'/status')->set('1');
        foreach($bulan_input as $bulan_single){
            var_dump($bulan_single);
        
            $keys = array_keys($database->getReference('Request/'.$nis.'/tagihan')->shallow()->getValue());
            foreach($keys as $key){
                $status = $database->getReference('Request/'.$nis.'/tagihan'.'/'.$key.'/status')->getValue();
                $bulan = $database->getReference('Request/'.$nis.'/tagihan'.'/'.$key.'/bulan')->getValue();
                var_dump('testing');
                if($status == 'Belum' && $bulan == $bulan_single ){
                    var_dump('test');
                    $database->getReference('Request/'.$nis.'/tagihan'.'/'.$key.'/status')->set('Sudah');
                }else{
                }
            }
        }
        return redirect()->action('DatabaseController@index');
    }

    public function setUser(){
        $username = '5235154090';
        $password = 'IniPass';

		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
                        ->create();
		$database 	= $firebase->getDatabase();
		$newPost    = $database
                        ->getReference('user')
		                ->push([
                            'username' => $username,
                            'password' => $password
                            ]);
		echo"<pre>";
		print_r($newPost->getvalue());
    }

    public function setTagihan(Request $req){
        $bulan = $req->input('bulan');
        $tahun = $req->input('tahun');
        $harga = $req->input('harga');
        $status = $req->input('status');

		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
                        ->create();
        $database 	= $firebase->getDatabase();
        
        $keys = array_keys($database->getReference('Request')->shallow()->getValue());
        $keys_length = count($keys);
        var_dump($keys,$keys_length);

        for($i=0;$i<$keys_length;$i++){
            $username = $keys[$i];
            $newPost    = $database
                            ->getReference('Request/'.$username.'/tagihan')
                            ->push([
                                'bulan' => $bulan,
                                'tahun' => $tahun,
                                'harga' => $harga,
                                'status' => $status
                                ]);
        }
        
        return redirect()->action('DatabaseController@getBiodata');
    }
    
    public function setBiodata(Request $req){
        $username = $req->input('username');
        $password = $req->input('password');
        $nis = $username;
        $nama = $req->input('nama');
        $alamat = $req->input('alamat');
        $no_telp = $req->input('no_telp');
        $jurusan = $req->input('jurusan');
        $kelas = $req->input('kelas');

		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
                        ->create();
        $database 	= $firebase->getDatabase();
        $newAccount    = $database
                        ->getReference('user/')
                        ->push([
                            'username' =>$username,
                            'password' => $password,
                            ]);
		$newPost    = $database
                        ->getReference('Request/'.$username)
                        ->set([
                            'nama' =>$nama,
                            'alamat' => $alamat,
                            'jurusan' => $jurusan,
                            'kelas' => $kelas,
                            'nis' => $nis,
                            'no_telp' => $no_telp
                            ]);
        
		// echo"<pre>";
		// print_r($newPost->getvalue());
    }
    
    public function getBiodata(){
		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
                        ->create();
        $database 	= $firebase->getDatabase();
        $keys = array_keys($database->getReference('Request')->shallow()->getValue());
        $keys_length = count($keys);
        
        // $connect = $database->getReference('Request/'.$keys[$i]);
        // $data = $connect->getSnapshot()->getValue();
        // echo"<pre>";
        // print_r($data);
        
        for($i=0;$i<$keys_length;$i++){
            $nis[$i] = $database->getReference('Request/'.$keys[$i].'/nis')->getValue();
            $nama[$i] = $database->getReference('Request/'.$keys[$i].'/nama')->getValue();
            $alamat[$i] = $database->getReference('Request/'.$keys[$i].'/alamat')->getValue();
            $no_telp[$i] = $database->getReference('Request/'.$keys[$i].'/no_telp')->getValue();
            $jurusan[$i] = $database->getReference('Request/'.$keys[$i].'/jurusan')->getValue();
            $kelas[$i] = $database->getReference('Request/'.$keys[$i].'/kelas')->getValue();
        }
        // print_r($keys); 
        // var_dump(count($keys));
        // var_dump($nis,$nama,$alamat,$no_telp,$jurusan,$kelas);
        return view('biodatacontent', [
            'keys'=>$keys_length,
            'nis'=>$nis,
            'nama'=>$nama,
            'alamat'=>$alamat,
            'no_telp'=>$no_telp,
            'jurusan'=>$jurusan,
            'kelas'=>$kelas
            ]);
    }

    public function getImage(){
        $users = User::take(5)->get();
        set_time_limit(60000);    
        
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
        ->create();
        $database 	= $firebase->getDatabase();
        
        foreach($users as $user){
            // $user->nis = '7403';
            $check_pembayaran = $database->getReference('Request/'.$user->nis.'/Pembayaran')->getValue();
            if($check_pembayaran != NULL){
                print_r('ada');

                $keys = array_keys($database->getReference('Request/'.$user->nis.'/Pembayaran')->shallow()->getValue());
                $user->keys_length = 0;
                foreach($keys as $key){
                    // var_dump($key);
                    $imgUrl = $database->getReference('Request/'.$user->nis.'/Pembayaran'.'/'.$key.'/imgUrl')->getValue();
                    $status = $database->getReference('Request/'.$user->nis.'/Pembayaran'.'/'.$key.'/status')->getValue();
                    // var_dump($imgUrl);
                    // var_dump($status);
                    if($status != NULL){
                        print_r('saya');
                    }else{
                        $user->keys_length++;
                        print_r('kosong');
                    }
                }
                var_dump($user->keys_length);
            }else{
                print_r('tidak ada');
            }
            // die();
        }
    }

    public function getPayment(Request $req){
        $nis = $req->input('nis');
        var_dump($nis);
        die($nis);
    }
    
}
