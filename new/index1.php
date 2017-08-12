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
				
				//=============分页开始==============//
				//初始化变量
				$maxrows = 0;//最大条数
				$pagesize = 3;//页大小【每页显示的条数】
				$page = isset($_GET['p'])?$_GET['p']:1;//当前页
				$maxpage = 0;//最大页数
				//查询数据总条数
				//准备SQL语句
				$sql = "select count(*)num from news";
				//执行SQL语句
				$result = mysqli_query($link,$sql);
				if(mysqli_num_rows($result)>0){
					//解析结果集
					$row = mysqli_fetch_assoc($result);
					// var_dump($row);
				}
				//数据总条数
				$maxrows = $row['num'];
				
				//通过运算得到数据的最大页数
				$maxpage = ceil($maxrows/$pagesize);
				// echo $maxpage;
				//limit 从哪里开始，查询几条数据  limit 0,3
				/*
				    从哪里开始  查询几条数据   当前页    换算公式
					0   	 	 3   			1   	(1-1)*3,3  0,3
					3   		 3   			2   	(2-1)*3,3  3,3
					6  			 3  			3  		(3-1)*3,3  6,3
					9  			 3   			4   	(4-1)*3,3  9,3
					
				
				*/
				$limit = " limit ".($page-1)*$pagesize.",".$pagesize;
				// echo $limit;
				if($page>$maxpage){
					$maxpage = $page;
				}
				if($page<0){
					$page = 1;
				}
				//=============分页结束==============//
				//准备SQL语句
				$sql = "select * from news {$limit}";
				// echo $sql;
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
				// echo "<tr align='center'>";
					// echo "<td colspan='6'>
					echo "<a href='index1.php?p=1'>首页</a>&nbsp;&nbsp;&nbsp;";
					// 1-1>1 ? 1-1 : 1
					// 2-1>1 ? 2-1 : 1
					// 3-1>1 ? 3-1 : 1  ==== 2
					echo "<a href='index1.php?p=".(($page-1)>1?($page-1):1)."'>上一页</a>&nbsp;&nbsp;&nbsp;";
					echo "<a href='index1.php?p=".(($page+1)<$maxpage?($page+1):$maxpage)."'>下一页</a>&nbsp;&nbsp;&nbsp;";
					echo "<a href='index1.php?p={$maxpage}'>尾页</a>";
					// </td>";
				// echo "</tr>";
			?>
		</table>
	
		</center>
	</body>
</html>