<?php
	//对新闻信息执行增、删、改操作
	//导入数据库配置文件
	require("./config.php");
	//连接数据库
	$link = mysqli_connect(HOST,ROOT,PASS) or die("连接数据库失败");
	//选择数据库
	mysqli_select_db($link,DBNAME);
	//设置字符集
	mysqli_set_charset($link,CHARSET);
	// var_dump($_GET);
	// var_dump($_POST);
	//根据参数a来决定执行那一项操作
	switch($_GET['a']){
		case 'insert'://执行添加操作
		$title = $_POST['title'];
		$author = $_POST['author'];
		$content = $_POST['content'];
		//time() 获取当前时间的时间戳
		$addtime = time();
		// echo $addtime;
		//准备SQL语句
		$sql = "insert into news values(null,'{$title}','{$author}','{$addtime}','{$content}')";
		// echo $sql;
		//执行SQL语句
		$result = mysqli_query($link,$sql);
		//判断是否执行成功
		if(mysqli_insert_id($link)>0){
			echo "添加成功！";
			header("location:index.php");
		}else{
			echo "添加失败！";
		}
		break;//终止执行添加操作
		
		case 'delete'://执行删除操作
		//获取要删除的新闻信息的唯一数据ID
		$id = $_GET['id'];
		//准备SQL语句
		$sql = "delete from news where id={$id}";
		//echo $sql;
		//exit;
		//执行SQL语句
		$result = mysqli_query($link,$sql);
		$a = mysqli_affected_rows($link);
		// var_dump($a);
		if($result && mysqli_affected_rows($link)>0){
			echo "删除成功！";
			header("location:index.php");
		}else{
			echo "删除失败！";
		}
		break;//终止执行删除操作
		case 'update'://执行修改操作
		//接收要修改的新闻信息
		// var_dump($_POST);
		$id = $_POST['id'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$content = $_POST['content'];
		//准备SQL语句
		$sql = "update news set title='{$title}',author='{$author}',content='{$content}' where id={$id}";
		//echo $sql;
		//执行SQL语句
		$result = mysqli_query($link,$sql);
		//判断是否执行成功
		if(mysqli_affected_rows($link)>0){
			echo "修改成功！";
			header("location:index.php");
		}else{
			echo "修改失败！";
		}
		break;//终止执行修改操作
	}
	//关闭数据库
	mysqli_close($link);
