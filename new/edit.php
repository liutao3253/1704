<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>新闻后台管理系统</title>
	</head>
	<body>
		<center>
		
		<?php
			//导入公共导航栏
			include("menu.php");
			//获取要修改的新闻信息
			$id = $_GET['id'];
			// echo $id;
			//导入数据库配置文件
			require("./config.php");
			//连接数据库
			$link = mysqli_connect(HOST,ROOT,PASS) or die("连接数据库失败");
			//选择数据库
			mysqli_select_db($link,DBNAME);
			//设置字符集
			mysqli_set_charset($link,CHARSET);
			//准备SQL语句
			$sql = "select * from news where id={$id}";
			//执行SQL语句
			$result = mysqli_query($link,$sql);
			//判断是否执行成功，并解析结果集
			if(mysqli_affected_rows($link)>0){
				$rows = mysqli_fetch_assoc($result);
				// var_dump($rows);
			}
		?>
		<table border=1 width=330>
			<form action="action.php?a=update" method="post">
				<input type="hidden" name="id" value="<?php echo $rows['id']; ?>"/>
				<tr>
					<td>新闻标题：</td>
					<td><input type="text" name="title" value="<?php echo $rows['title'];?>"/></td>
				</tr>
				<tr>
					<td>新闻作者：</td>
					<td><input type="text" name="author" value="<?php echo $rows['author'];?>"/></td>
				</tr>
				<tr>
					<td>新闻内容：</td>
					<td><textarea name="content" cols="30" rows="10"><?php echo $rows['content']; ?></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="修改"/>&nbsp;&nbsp;&nbsp;
						<input type="reset" value="取消"/>
					</td>
				</tr>
			</form>
		</table>
		</center>
	</body>
</html>