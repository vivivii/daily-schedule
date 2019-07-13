<?php 
    header("Content-Type: text/html; charset=utf8");
    include('connect.php');
    if(!isset($_POST['submit'])){
        exit("错误执行");
    }

    $name = $_POST['name'];
    $password = $_POST['password'];  
    $confirm = $_POST['confirm'];
    if($name == "" || $password == "" || $confirm == "")  
        {  
            echo "<script>alert('信息填写不完整哟 =v='); history.go(-1);</script>";  
        } 
    
    else
    {
        if($password == $confirm)
        {

            $sql = $db->prepare('SELECT * FROM users WHERE username = :name');
            $sql->bindValue(':name',$name);
            $sql->execute();
            $num = count($sql->fetchAll());
            if($num) echo "<script>alert('这个用户名被注册过啦 QAQ'); history.go(-1);</script>";     
            else{
                $q = $db ->prepare('INSERT INTO users(username,password) VALUES (:name,:password);');
                $q -> bindValue(':name', $name);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $q -> bindValue(':password', $password);
                $result = $q->execute();
        
                if ($result == true){
                    echo '有账号啦！快去登录鸭 QWQ';
                    header("Refresh:2;url=login.html");
                }
                else echo "不知道为什么注册失败 QAQ";
            }
        }
        else 
        {  
            echo "<script>alert('两次输入密码不一致＞﹏＜'); history.go(-1);</script>";  
        }  
    }

?>
