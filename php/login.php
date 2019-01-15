<?php 
//print_r($con);
//接收请求数据
header("Content-Type:text/html;charset=utf-8");

$uname = $_GET["uname"];
$pwd = $_GET["pwd"];

//连接数据源，数据库
$con = mysqli_connect("localhost", "root", "", "coolgo");
//设置字符编码
mysqli_query($con, "set names utf8");
/*
 * a.获取请求过来的为数据
	   b.查询数据库里所有的用户名和密码
		c.用查到的用户名和密码对请求过来的用户和密码进行比较，
			如果用户名没有匹配的就说明用户名不存在
			如果用户民名存在，还需要匹配密码，密码不匹配，说明密码有误
		d.用户名和密码都匹配成功后，说明登录成功，成功跳转到学生信息页。
 */
$selectSql = "select * from login";
//返回一个结果集
$result = mysqli_query($con, $selectSql);
$flag = false;//表示用户名不存在
while ($arr = mysqli_fetch_array($result)) {
        //echo $arr["username"];
    if ($uname == $arr["name"]) {
        $flag = true;//表示用户名存在；
            //echo $arr["password"];
        if ($pwd == $arr["pwd"]) {
            echo "<script>alert('登录成功');location.href = '../index.html?name=$uname';</script>";
        } else {
            echo "<script>alert('登录失败');location.href = '../pages.login.html';</script>";
        }
        break;
    }
}
if ($flag == false) {//表示该用户明不存在；
    echo "<script>alert('用户名有误，请重新登录！');location.href = '../pages.login.html';</script>";
}



?>