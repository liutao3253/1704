<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>新闻后台管理系统</title>
	</head>
	<body>
		<center>
		<?php 
			date_default_timezone_set("PRC");
			//导入公共导航栏
			include("menu.php");
			
		?>
		<table border=1 width=800>
			<tr>
				<th>新闻编号</th>
				<th>新闻标题</th>
				<th>新闻作者</th>
				<th>添加时间</th>
				<th>新闻内容</th>
				<th>操作</th>
			</tr>
			<?php
				//导入数据库配置文件
				require("./config.php");
				//连接数据库
				$link = mysqli_connect(HOST,ROOT,PASS) or die("连接数据库失败");
				//选择数据库
				mysqli_select_db($link,DBNAME);
				//设置字符集
				mysqli_set_charset($link,CHARSET);
				//准备SQL语句
				$sql = "select * from news";
				//执行SQL语句
				$result = mysqli_query($link,$sql);
				//获取结果结，解析结果集
				if(mysqli_num_rows($result)>0){
					//获取一条新闻信息
					// $row = mysqli_fetch_assoc($result);
					// var_dump($row);
					//获取所有新闻信息
					while($row = mysqli_fetch_assoc($result)){
						echo "<tr>";
							echo "<td>{$row['id']}</td>";
							echo "<td>{$row['title']}</td>";
							echo "<td>{$row['author']}</td>";
							echo "<td>".date('Y-m-d H:i:s',$row['addtime'])."</td>";
							echo "<td>{$row['content']}</td>";
							//a标签是超级连接标签 用页面之间的跳转
							echo "<td>
								<a href='action.php?a=delete&id=".$row['id']."'>删除</a>
								<a href='edit.php?id=".$row['id']."'>修改</a>
							</td>";
						echo "</tr>";
					}
					
				}
			?>
		</table>
		</center>
	</body>
</html>