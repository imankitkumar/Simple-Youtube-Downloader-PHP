<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Youtube Downloader</title>
	<style> 
.btn{ background-color: dodgerblue;width:50%;margin: 60px; height: 50px; color: #fff; margin: 10px; border-radius: 5px; outline: none; padding: 12px 30px; cursor: pointer; font-size: 15px; } 
.btn:hover { background-color: #2EE59D; box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.4); color: #fff; transform: translateY(-7px); } .btn:active { box-shadow: 0 5px #666; transform: translateY(4px); } #img { padding:1px; border:8px solid #021a40; }
input { padding: 20px;
text-align: center;
width: 80%;
border: 2px solid blue;
font-size: 15px;} 
h1 {text-align:center}
</style>
</head>
<body>
<h1>// Simple Youtube Downloader //</h1><br>
<form action="" method="post">
	<center><input type="url" name="url" placeholder="Enter Youtube Video URL" required>
	<input class="btn" type="submit" value="Extract Video Links"></center>
	</form>
	
	<?php
	$ur = $_REQUEST['url'];
	if(isset($ur)){
	$id = substr($ur,-11,11);
	$info = file_get_contents("https://www.youtube.com/get_video_info?video_id={$id}");
	 parse_str($info);
$dt = $player_response;
		$dcode = json_decode($dt, true);
$thumb = $dcode['videoDetails']['thumbnail']['thumbnails'][0]['url'];
echo "<br><center><img style='border:6px solid black' src='$thumb' width='50%'></center>";
$title = $dcode['videoDetails']['title'];
echo "<h1>$title</h1><br>";
echo "<h3 style='color:red'>Videos with Sound</h3><br>";			
$format = $dcode['streamingData']['formats'];
foreach($format as $key => $value){
$link = $value['url'];
$q1 = $value['qualityLabel'];
echo "<br><center><a  class='btn' href='$link'>Download in $q1</a></center><br>";
}
echo "<h3 style='color:red'>More Videos (No Sound) & Audio Qualities</h3><br>";
$format2 = $dcode['streamingData']['adaptiveFormats'];
foreach($format2 as $key => $value){
$link2 = $value['url'];
$q2 = $value['qualityLabel'];
echo '<center><a class="btn" href="'.$link2.'">Download in '.$q2.'</a></center><br>';
}
}

	?>
	
</body>
</html>
