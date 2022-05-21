<?php
session_start();
include 'fonksiyon/helper.php';
/// kullanıcı bilgileri
$user = [
    'zuhurialtun' => [
        'eposta' => 'zuhuri312@gmail.com',
        'password' => '123456',
        'darkmode' => false
    ],
    'osmankalayci' => [
        'eposta' => 'osmankalayci@gmail.com',
        'password' => '123456',
        'darkmode' => true
    ]
];

if(get('islem') == 'giris'){
        $_SESSION['username']= post('username');
        $_SESSION['password']= post('password');
    if(!post('username')){
        $_SESSION['error'] = 'Lütfen kullanıcı adınızı giriniz!';
        header('Location:login.php');
        exit();
    }
    elseif(!post('password')){
        $_SESSION['error'] = 'Lütfen şifrenizi giriniz!';
        header('Location:login.php');
        exit();
    }
    else{
        if(array_key_exists(post('username'),$user)){
            if($user[post('username')]['password'] == post('password')){
                $_SESSION['login']=true;
                $_SESSION['kullanici_adi']=post('username');
                $_SESSION['kullanici_eposta']=$user[post('username')]['eposta'];
                $sonuc = file_exists('db/'.session('kullanici_adi').'.txt');
                if ($sonuc){
                    header('Location:index.php?islem=true');
                }
                else{
                    $islem = file_put_contents('db/'.session('kullanici_adi').'.txt','Yeni Kullanıcı');
                    if($islem){
                        header('Location:index.php?islem=true');
                    }
                    else{
                        $_SESSION['error']='Dosya Oluşturma Hatası.';
                    }
                }
                $_SESSION['error']='Dosya Oluşturma Hatası.';
                header('Location:index.php');
                exit();
            }
            else{
                $_SESSION['error'] = 'Kullanıcı kaydı bulunamadı';
                header('Location:login.php');
                exit();
            }
        }
        else{
            $_SESSION['error'] = 'Kullanıcı kaydı bulunamadı';
            header('Location:login.php');
            exit();
        }
    }
}
if(get('islem') == 'hakkimda'){
    $hakkimda = post('hakkimda');
    $islem = file_put_contents('db/'.session('kullanici_adi').'.txt',htmlspecialchars($hakkimda));
    if($islem){
        header('Location:index.php?islem=true');
    }
    else{
        header('Location:index.php?islem=false');
    }
    
}
if(get('islem') == 'logout'){
    session_destroy();
    session_start();
    $_SESSION['error']='Oturum Sonlandırıldı.';
    header('Location:login.php');
}
if(get('islem') == 'renk'){
    setcookie('color',get('color'), time() + (86400 * 360));

    header('Location:'.$_SERVER['HTTP_REFERER'] ?? 'index.php');
}