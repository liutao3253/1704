<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>新闻后台管理系统</title>
	</head>
	<body>
		<center>
		<?php //导入公共导航栏
			include("menu.php"); ?>
		<table border=1 width=330>
			<form action="action.php?a=insert" method="post">
				<tr>
					<td>新闻标题：</td>
					<td><input type="text" name="title"/></td>
				</tr>
				<tr>
					<td>新闻作者：</td>
					<td><input type="text" name="author"/></td>
				</tr>
				<tr>
					<td>新闻内容：</td>
					<td><textarea name="content" cols="30" rows="10"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="添加"/>&nbsp;&nbsp;&nbsp;
						<input type="reset" value="取消"/>
					</td>
				</tr>
			</form>
		</table>
		</center>
	</body>
</html>