<!DOCTYPE HTML>
<?php include('seasons.php') ?>
<head>
<style type="text/css">

.box {
	text-align: center;
	font-family: "Helvetica Neue", sans-serif;
	padding: 15px;
}

.spring {
	color: white;
	background-color: #99ff00;
}

.summer {
	color: white;
	background-color: #ffcc00;
}

.autumn {
	color: #ff9933;
	background-color: #663300;
}

.winter {
	color: #cc33cc;
	background-color: #3399cc;
}

.christmas {
	background-color: #33ff00;
	color: red;
}

.taxday {
	color: white;
	background-color: black;
}

</style>
	<title>Dynamic Seasons CSS Classes</title>
</head>
<body>
<div class="<?php print_active_seasons($seasons); ?>box"
	<p>The CSS class of this element will change with the seasons.</p>
</div>
</body>