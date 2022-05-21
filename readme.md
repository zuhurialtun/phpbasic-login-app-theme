# Patika.dev - PhpBasics

### İşlemler
- **SESSİON** kullanarak kullanıcı bilgilerinin saklanması ve bu bilgilerle kullanıcı girişi kontrolünün yapılması.
```
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
```
- **SERVER['HTTP_REFERER']** kullanarak kullanıcıyı geldiği sayfaya geri gönderme.
```
header('Location:'.$_SERVER['HTTP_REFERER'] ?? 'index.php');
```
-  **COOKİE** kullanarak sayfalara dark-mode efekti kazandırılması.
```
if(get('islem') == 'renk'){
    setcookie('color',get('color'), time() + (86400 * 360));

    header('Location:'.$_SERVER['HTTP_REFERER'] ?? 'index.php');
}
```
- **file_put_contents** kullanarak her kullanıcı için hakkımda yazısının saklandığı dosyanın oluşturulması.
```
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
```
- **file_get_contents** kullanarak giriş yapan kullanıcının hakkımda yazısının getirilmesi.
```
$hakkimda = file_get_contents('db/'.session('kullanici_adi').'.txt');
```

### Login Uygulamasında Kullanılan Tasarım

> ![img.png](img.png)

[Patika: zuhurialtun](https://app.patika.dev/zuhurialtun)