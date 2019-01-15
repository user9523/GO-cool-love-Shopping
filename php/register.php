<?php
header("Content-Type:text/html;charset=utf-8");
	//接收请求数据
$uName = $_POST["zhanghao"];
$pwd = $_POST["mima"];
	//1.连接数据源
$con = mysqli_connect("localhost", "root", "", "coolgo");
	//2.连接数据库
	//mysqli_select_db($con,"studentSYS");//第四个参数
	//3.设置字符编码
mysqli_query($con, "set names utf8");
	//检测数据库中是否存在$uName，如果存在无法注册，如果不存在可以注册
	
	//创建一个查询语句，
$selectSql = "select * from login";

	//查询语句返回的是一个结果集
$row = mysqli_query($con, $selectSql);

	//这里需要将结果集转换成一个数组
	//mysqli_fetch_array($result);这个方法一次只能转一个,当结果集没有数据时返回空值
	/*$resultArr = mysqli_fetch_array($result);
	$resultArr1 = mysqli_fetch_array($result);
	$resultArr2 = mysqli_fetch_array($result);
	$resultArr3 = mysqli_fetch_array($result);
	
	print_r($resultArr);
	print_r($resultArr1);
	print_r($resultArr2);
	print_r("?".$resultArr3);*/

$flag = false;//表示用户名不存在 

while ($resultArr = mysqli_fetch_array($row)) {//当结果集有数据时$resultArr是一行数据，结果集没有数据时$resultArr为空
		//$arr[Array ( [0] => jerry [uname] => jerry ),Array ( [0] => tom [uname] => tom )]
		//$arr[] = $resultArr;

	if ($uName == $resultArr["name"]) {
		$flag = true;//表示用户名存在
		break;
	};
}
if ($flag) {//表示用户名存在
	echo "<script>alert('用户名已存在，请重新注册');location.href = '../pages/register.html';</script>";
} else {//用户名不存在，可以注册
		//定义插入的sql语句
	$sql = "insert into login (name,pwd) values ('$uName','$pwd')";
		//执行sql语句
	// echo $sql;
	$result = mysqli_query($con, $sql);
	if ($result) {
			//插入成功，注册成功
			//跳转到登录页
		echo "<script>alert('注册成功');location.href = '../pages/login.html';</script>";
	} else {
		echo "<script>alert('注册失败');location.href = '../pages/register.html';</script>";
	}
}
?>