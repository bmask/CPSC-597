<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="jquery.tzCheckbox/jquery.tzCheckbox.css" />
<script src="js/jquery.min.js"></script>
<script src="jquery.tzCheckbox/jquery.tzCheckbox.js"></script>
<script src="js/script.js"></script>
  <link href="css/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="js/jquery.min.tabs.js"></script>
  <script src="js/jquery-ui.min.tabs.js"></script>
<link rel="stylesheet" type="text/css" href="css/table.css" />
<script type="text/javascript" src="js/jMenu-VerticalTab.js"></script> 
<link rel="stylesheet" type="text/css" href="css/vertical-Tab.css" />
  <script>
  $(document).ready(function() {
    $("#tabs").tabs();
  });
  </script>
</head>
<!-- http://www.madebytj.com -->
<body bgcolor="#f2f2f2" >
 <style type="text/css"> 
 h2{font-family:Georgia ; font-style: italic;font-variant: small-caps; font-size: 2.5em; color: #C0C0C0; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:50px;}
 h1 {font-size: 4.5em; font-family: "Brush Script MT", cursive; color: #fced01; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:80px;}
 #help {padding:0; margin-top:-130px;margin-bottom:100px;margin-right:-700px;}
 #logo {position:relative; padding:0; margin-top:-130px;margin-bottom:200px;margin-right:-200px;margin-left:200px;}
#page {position:absolute; padding:0; margin-top:-320px;margin-bottom:200px;margin-right:-300px;margin-left:550px;}
#button {position:relative; padding:0; margin-top:-480px;margin-bottom:200px;margin-right:-230px;margin-left:260px;}
#button ul { list-style-type: none; }
 
</style>
<style type="text/css">
 .classname { 
	height: 40px; 
	width: 200px;  
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background-color:#ededed;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #ffffff; 
}.classname:hover {
	background-color:#dfdfdf;
}.classname:active {
	position:relative;
	margin-top:1px;
}
 
</style>
<table border="0" width=100% height=100%>
<tr>
<td style="text-align: center; vertical-align: top;">
<img src="header.jpg" alt="header" />
<h1>University's Contact Info</h1> 
<img src="helpIcon.png" alt="help" id="help" />
</td>
</tr>
<tr>
<td>
<img src="logo.png" alt="logo" id="logo"/>
<div id="button">
 <ul>
	<!--<li><button  class="classname" onClick="history.go(-1)"> << Previous Page</button></li>-->
	<li><button  class="classname" onclick="parent.location='MainPage.php'" > << Home Page </button></li>	
</ul>

</div>
<div id="page" style="font-size:62.5%;">  
  <div id="tabs">

	<?php
	session_start();
	   echo "<ul>";
        echo "<li><a href='#fragment-1'><span>Universities' Info</span></a></li>";
    echo "</ul>";
   // first tab	---------------------------------------------------------  
	echo "<div id='fragment-1'>"; 
 		echo "<div class='accordian'>";
			echo "<ul>";
			$s = count($_SESSION['view']);
			for($j=0; $j < $s; $j++)
			{	
			if($_SESSION['view'][$j]=="taylors"){
				echo "<li>Taylor's University</li>";
				echo "<li>";
					$some_link = 'http://www.taylors.edu.my/en/university/about_taylors/contact_us';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// table" . '[@' . "width='499']"); 
					$i = 0; 
					$myItem = $filtered->item($i++);
					$node = $newDom->importNode( $myItem, true );    // import node			 
					$newDom->appendChild($node);                    // append node
					$str = $newDom->saveHTML();					// convert to string 
					echo $str;
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="sunway"){

				echo "<li>Sunway University</li>";
				echo "<li>";
					$some_link = 'http://sunway.edu.my/university/contact';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// table" . '[@' . "border='0']"); 
					$i = 0;  
					 $myItem = $filtered->item($i++);
					$node = $newDom->importNode( $myItem, true );    // import node			 
					$newDom->appendChild($node);                    // append node
					$str = $newDom->saveHTML();					// convert to string 
					$explode = explode("</p>", $str);						
					echo $explode[0]."<br/>";
					echo $explode[2]."<br/>";	 
					echo $explode[3]."<br/>";
					echo "</td></tr></table>";
					echo "<a href='http://maps.google.com.my/maps?hl=en&georestrict=input_srcid:74b69b665b097db5&ie=UTF8&view=map&cid=9994251088952014563&q=Sunway+University+College&iwloc=A&ved=0CB0QpQY&sa=X&ei=rZIyTK7PEo-6vAOwyLXiBQ' target='_blank' > 
					Find us on Google Maps </a>";				
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="nottingham"){

				echo "<li>Nottingham University</li>";
				echo "<li>";
					$some_link = 'http://www.nottingham.edu.my/AboutUs/ContactUs.aspx';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);
				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// p"); 
					$i = 6;
					$k = 0;
					while( $myItem = $filtered->item($i++) ){
						$node = $newDom->importNode( $myItem, true );    // import node			 
						$newDom->appendChild($node);                    // append node
						$str = $newDom->saveHTML();					// convert to string
						if(strpos($str, "Local ") == true)
						{
							$k++;
							if($k>1)
							{
								break;
							}		
						}
						echo $str;
						$newDom->removeChild($node);					// reset object information 		 
					}	
					echo "<a href='http://maps.google.com.my/maps?hl=en&gl=my&bav=on.2,or.r_gc.r_pw.r_qf.,cf.osb&biw=1366&bih=662&um=1&ie=UTF-8&q=nottingham+malaysia+campus&fb=1&gl=my&hq=nottingham+malaysia+campus&hnear=nottingham+malaysia+campus&cid=0,0,7883083282267956622&ei=0JevT-uyForPrQfiiuX8Aw&sa=X&oi=local_result&ct=image&resnum=1&ved=0CA0Q_BIwAA' target='_blank' > 
					Find us on Google Maps </a>";
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="KDU"){

				echo "<li>KDU University</li>";
				echo "<li>";  
					$some_link = 'http://www.kdu.edu.my/contact/contact.html';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link);				 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// table" . '[@' . "style='width: 560px;']"); 
					$i = 0;
					$myItem = $filtered->item($i++)  ;
					echo $out= $myItem->nodeValue;
					echo "<br/><a href='http://maps.google.com.my/maps?um=1&ie=UTF-8&q=kdu+university&fb=1&gl=my&hq=kdu+university&hnear=0x31cc4ececc1c7c97:0x524c8e31e929bc76,Petaling+Jaya,+Selangor&cid=0,0,13271933286300141834&ei=L5ivT6faGtGsrAe8wLm5CA&sa=X&oi=local_result&ct=image&resnum=1&ved=0CA8Q_BIwAA' target='_blank' > 
					Find us on Google Maps </a>";    
				echo "</li>";
			}
			if($_SESSION['view'][$j]=="UCSI"){

				echo "<li>UCSI University</li>";
				echo "<li>";
					$some_link = 'http://lms.ucsi.edu.my/contact-us;jsessionid=9AD2CF2D2390B3A4AC3C72D871DAB076';
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = false;
					@$dom->loadHTMLFile($some_link); 
					$domxpath = new DOMXPath($dom);
					$newDom = new DOMDocument;
					$newDom->formatOutput = true;
					$filtered = $domxpath->query("// table" . '[@' . "id='table1']"); 
					$i = 0; 	
					$myItem = $filtered->item($i++) ;	
					$node = $newDom->importNode( $myItem, true );    // import node			 
					$newDom->appendChild($node);                    // append node
					$str = $newDom->saveHTML();					// convert to string 
					$explode = explode("</td>", $str);
					echo "<table><tr>";
					echo $explode[2];
					echo "</td></tr></table>";	
					echo "<br/><a href='http://maps.google.com/maps/ms?ie=UTF8&hl=en&msa=0&msid=115508844613836059159.00046689e72a3b6998092&source=embed&ll=3.075863,101.73695&spn=0.007853,0.009602&z=17' target='_blank' > 
					Find us on Google Maps </a>"; 					
				echo "</li>";
			}
			}
			echo "</ul>";
		echo "</div>";
		
	 
	echo " </div>";
	?>
</div>  
</div>
</td> 
</tr>
</table>
</body>
</html>