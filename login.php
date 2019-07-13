<?PHP
    header("Content-Type: text/html; charset=utf8");
    if(!isset($_POST["submit"])){
        exit("错误执行");
    }

    session_start();
    include('connect.php');//链接数据库
    @$name = $_POST['name'];//post获得用户名表单值
    $password = $_POST['password'];//post获得用户密码单值

    if ($name && $password){
             $sql = 'SELECT * FROM users WHERE username = ?';
             $pdo = $db->prepare($sql);
             $pdo->execute([$name]);
             $result = $pdo->fetch();
             if($result){
             $hash = $result['password'];
             $check = password_verify($password,$hash);

             if($check){
                   $_SESSION['name'] = "$name";
                   header("refresh:0;url=welcome.html");
                   exit;
             }
             else{
                echo "<script>alert('密码错误 QAQ'); history.go(-1);</script>";
             }}
             else echo "<script>alert('用户名不存在 QAQ'); history.go(-1);</script>";

             

    }else{
                echo "<script>alert('表单要填写完整哟'); history.go(-1);</script>";
    }
?>
