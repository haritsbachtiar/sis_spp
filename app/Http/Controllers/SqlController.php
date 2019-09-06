<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;
use App\User;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class SqlController extends Controller
{
    //
    public function login(){
        return view('login');
    }

    public function loginHandler(Request $req){
        $username = $req->input('username');
        $password = $req->input('password'); 
        if($username == 'admin'){
            if($password == '123'){
                \Session::put('token', 'admin_sis_spp' );
                return redirect()->action('SqlController@getFilter');
            }else{
                $message = 'Password Salah';
                return view('login',['message'=>$message]);
            }
        }else{
            $message = 'Username Salah';
            return view('login',['message'=>$message]);
        }
    }

    public function logout(){
        \Session::put('token', null);
        return view('login');
    }

    public function getFilter(){
        return view('biodatacontent');
    }

    public function getUsers(Request $req){
        $kelas = $req->input('kelas');
        $jurusan = $req->input('jurusan');
        $users = User::where('kelas', $kelas)->where('jurusan', $jurusan)->get();
        // foreach($users as $user){
        //     var_dump($user->nama);
        // }      
        // die();
        // var_dump($users);
        // $users = User::all();
        set_time_limit(60000);    
        
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
		$firebase	= (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
        ->create();
        $database 	= $firebase->getDatabase();
        
        foreach($users as $user){
            // var_dump($user->nis);
            $user->keys_length = 0;
            $temp_bulan = [];
            $user->bulan = [];
            $check_pembayaran = $database->getReference('Request/'.$user->nis.'/tagihan')->getValue();
            if($check_pembayaran != NULL){
                $keys = array_keys($database->getReference('Request/'.$user->nis.'/tagihan')->shallow()->getValue());
                foreach($keys as $key){
                    $status = $database->getReference('Request/'.$user->nis.'/tagihan'.'/'.$key.'/status')->getValue();
                    $bulan = $database->getReference('Request/'.$user->nis.'/tagihan'.'/'.$key.'/bulan')->getValue();
                    if($status == "Belum"){ 
                        $user->keys_length++;
                        array_push($temp_bulan, $bulan);
                    }else{
                    }
                }
                $user->bulan = $temp_bulan;
            }else{
            }
        }
        return view('biodatacontent', [
            'users'=>$users,
            'kelas'=>$kelas,
            'jurusan'=>$jurusan
        ]);
    }

    public function setUsers(){
        $users = User::all();
        // $users = User::where('id',">", 649)->get();
        // die($users);
        set_time_limit(60000);    
        foreach($users as $user){

            $username = $user->nis;
            $password = $user->password;
            
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
            $firebase	= (new Factory)
                        ->withServiceAccount($serviceAccount)
                        ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
                        ->create();
		    $database 	= $firebase->getDatabase();
		    $newAccount = $database
                            ->getReference('user')
		                    ->push([
                                'username' => $username,
                                'password' => $password
                                ]);
            echo"<pre>";
            print_r($newAccount->getvalue());
            $newPost    = $database
                            ->getReference('Request/'.$username)
                            ->set([
                                'nama' =>$user->nama,
                                'alamat' => $user->alamat,
                                'jurusan' => $user->jurusan,
                                'kelas' => $user->kelas,
                                'nis' => $user->nis,
                                'no_telp' => $user->no_telp
                                ]);
                                echo"<pre>";
            print_r($newPost->getvalue());
        }
    }

    public function getPrice($id){
        $user = User::find($id);
        $price_spp = Price::where('kelas', $user->kelas)->where('jurusan', $user->jurusan)->value('spp');
        var_dump($price_spp);
    }

    public function setPrices(Request $req){
        $users = User::all();

        // FIREBASE TAGIHAN
        $bulan = $req->input('bulan');
        $tahun = $req->input('tahun');
        $status = $req->input('status');

        set_time_limit(6000);
        
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'\aplikasipengirimwhatsapp-firebase-adminsdk-y5vli-7ff78094e3.json');
        $firebase	= (new Factory)
                    ->withServiceAccount($serviceAccount)
                    ->withDatabaseUri('https://aplikasipengirimwhatsapp.firebaseio.com')
                    ->create();
        $database 	= $firebase->getDatabase();
        
        foreach($users as $user){
            var_dump($user->nis);
            $price_spp = Price::where('kelas', $user->kelas)->where('jurusan', $user->jurusan)->value('spp');
            $harga = "$price_spp";

            $username = $user->nis;
            $newPost    = $database
                            ->getReference('Request/'.$username.'/tagihan')
                            ->push([
                                'bulan' => $bulan,
                                'tahun' => $tahun,
                                'harga' => $harga,
                                'status' => $status
                                ]);    
        }
        var_dump('done');
        // return redirect()->action('DatabaseController@getBiodata');
    }
}
