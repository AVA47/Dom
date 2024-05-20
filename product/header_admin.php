<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style_admin.css">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/prettyPhoto.css" rel="stylesheet">
	<link href="../css/price-range.css" rel="stylesheet">
	<link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/main1.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<link rel="shortcut icon" href="../images/favicon.ico">
	<title>Редактор</title>
</head>

<body>
	<header id="header">
		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="../index.php"><img src="../images/home/logo главная.png" style="text-align: center" /></a>
							<?php
							if ($_SESSION['user']) {
								// Если вошел пользователь (любого типа), показываем "Выход"
								if ($_SESSION['user']['type'] == 1) {
									// Если тип пользователя - admin, показываем "Редактор"
									echo  "<div class='editor1'> 
							<a href='../function/logout.php'><input type='submit' value='Выйти' style='
								border: 2px solid #fe980f;
								padding: 3px 19px;
								border-radius: 5px;
								background-color: white;
								cursor: pointer;
								margin-left: 7px;
								color: #600c00;
							'></a>
							</div>";
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>