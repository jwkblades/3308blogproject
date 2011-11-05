<!doctype HTML>
<html>
	<head>
		<title>[[page:title]] - [[title]]</title>
		<style type="text/css">
			body{
				margin: 0px;
			}
			.header{
				display: block;
				background: #9cf;
				padding: 5px;
				height: 20px;
			}
			.container{
				width: 800px;
				max-width: 800px;
				margin: 0px auto;
			}
			.nav{
				display: inline-block;
				float: left;
				width: 200px;
			}
			.nav ul{
				list-style: none;
				margin: 0px;
				padding: 0px;
			}
			.content{
				display: inline-block;
				margin: 0px;
				padding: 0px;
			}
			h1{
				font-size: 24px;
				margin: 0px;
				padding: 0px;
			}
			p{
				margin: 5px 0px 0px 0px;
			}
			.right{
				float: right;
			}
			form{
				display: inline;
				margin: 0px;
				padding: 0px;
			}
		</style>
	</head>
	<body>
		<div class="header">
			[[template:headerBar]]
		</div>
		<div class="container">
			<div class="nav">
				[[template:nav]]
			</div>
			<div class="content">
				[[page:content]]
			</div>
		</div>
	</body>
</html>
