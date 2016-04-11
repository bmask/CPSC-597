<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/styles.css" />
<link rel="stylesheet" type="text/css" href="jquery.tzCheckbox/jquery.tzCheckbox.css" />
<script src="js/jquery.min.js"></script>
<script src="jquery.tzCheckbox/jquery.tzCheckbox.js"></script>
<script src="js/script.js"></script>
<script>
	var select = 0;
	function addOption1(x) {
	sOption=document.getElementById('textBox1').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox1').value="Nottingham University;\n"+x+"\n";
	}
	function addOption2(x) {
	sOption=document.getElementById('textBox2').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox2').value="Taylor's University;\n"+x+"\n";
	}
	function addOption3(x) {
	sOption=document.getElementById('textBox3').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox3').value="Sunway University;\n"+x+"\n";
	}
	function addOption4(x) {
	sOption=document.getElementById('textBox4').value;
	sOptions=sOption.split("\n");
	document.getElementById('textBox4').value="KDU University;\n"+x+"\n";
	}
	function dropdown(sel) {
	if(select !=0)
	{
		document.getElementById(select).style.display='none';
	}
	var value = sel.options[sel.selectedIndex].value;				 
	select = value;
	document.getElementById(value).style.display='block';			 
	}
</script>
</head>
<!-- http://www.madebytj.com -->
<body bgcolor="#f2f2f2">
 <style type="text/css"> 
 h2{font-family:Georgia ; font-style: italic;font-variant: small-caps; font-size: 2.5em; color: #C0C0C0; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:50px;}
 h1 {font-size: 4.5em; font-family: "Brush Script MT", cursive; color: #fced01; text-align:left; padding:0; margin-top:-80px;margin-bottom:100px;margin-right:50px;margin-left:80px;}
 #help {padding:0; margin-top:-130px;margin-bottom:100px;margin-right:-700px;}
 #logo {position:relative; padding:0; margin-top:-130px;margin-bottom:200px;margin-right:-200px;margin-left:200px;}
#page {position:absolute; padding:0; margin-top:-500px;margin-bottom:200px;margin-right:-300px;margin-left:600px;}
.textarea {position:absolute; padding:0; margin-top:150px;margin-bottom:200px;margin-right:350px}
#button {position:relative; padding:0; margin-top:-480px;margin-bottom:200px;margin-right:-230px;margin-left:260px;}
#button ul { list-style-type: none; }
.UCSI {position:absolute; padding:0; margin-top:-135px;margin-bottom:200px;margin-right:-40px;margin-left:365px;}
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
<h1>Fees Information</h1> 
<img src="helpIcon.png" alt="help" id="help" />
</td>
</tr>
<tr>
<td>
<img src="logo.png" alt="logo" id="logo"/>
<div id="button">
<ul>
	<!--<li><button  class="classname" onClick="history.go(-1)" > << Previous Page </button></li>	-->
	<li><button  class="classname" onclick="parent.location='MainPage.php'" > << Home Page </button></li>	
</ul>
</div>
<div id="page">  

<?php
	// get nottingham fees info
	$some_link = 'http://www.nottingham.edu.my/Applications/Fees/UG.aspx';
	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = false;
	@$dom->loadHTMLFile($some_link);
 
    $domxpath = new DOMXPath($dom);
    $newDom = new DOMDocument;
    $newDom->formatOutput = true;

	$filtered = $domxpath->query("// td"); 
    $i = 0;
	$k = 0;
    while( $myItem = $filtered->item($i++) ){
	
        $node = $newDom->importNode( $myItem, true );    // import node			 
        $newDom->appendChild($node);                    // append node
		$first = $newDom->saveHTML();					// convert to string
		if(strpos($first, "RM") == true ){
 		//$nottinghamFees[$k] = $first;								
		//$k++;
		$newDom->removeChild($node);	
		$myItem = $filtered->item($i);
        $node = $newDom->importNode( $myItem, true );    // import node			 
        $newDom->appendChild($node);                    // append node	 
		$nottinghamFees[$k] = "Malaysian-Fees;".trim($first)."International-Fees;".trim($newDom->saveHTML());
		$nottinghamFees[$k] = str_replace("<td>", "", $nottinghamFees[$k]);
		$nottinghamFees[$k] = str_replace("</td>", "", $nottinghamFees[$k]);
		$nottinghamFees[$k] = str_replace(" ", "", $nottinghamFees[$k]);
		$nottinghamFees[$k] = trim ($nottinghamFees[$k]);
		$k++;
		$i=$i+1;
		}
		$newDom->removeChild($node);					// reset object information 		 
    }	
    $i = 0;
	$j = 0;
    while( $myItem = $filtered->item($i++) ){
	
        $node = $newDom->importNode( $myItem, true );    // import node			 
        $newDom->appendChild($node);                    // append node
		$first = $newDom->saveHTML();					// convert to string
		if(($i-2)%5==0 ){
		$first = str_replace("<td>", "", $first);
		$first = str_replace("</td>", "", $first);
		$first = str_replace(" ", "", $first);
		$first = trim ($first);
		$nottinghamCourses[$j] = $first;
		$j++;
		}
		$newDom->removeChild($node);					// reset object information 		 
    }
	
	// get taylors fees info
	$some_link = 'http://www.taylors.edu.my/en/university/programmes_a-z';
	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = false;
	@$dom->loadHTMLFile($some_link);
 
    $domxpath = new DOMXPath($dom);
    $newDom = new DOMDocument;
    $newDom->formatOutput = true;

	$filtered = $domxpath->query("// a" . '[@' . "class='link_general']");
    $i = 0;
	$j = 0;
    while( $myItem = $filtered->item($i++) ){	
        $node = $newDom->importNode( $myItem, true );    // import node			 
        $newDom->appendChild($node);                    // append node
		$test = $newDom->saveHTML();					// convert to string
		$taylorsProgrammes[$j] = $test;								// display node info 
		$j++;
		$newDom->removeChild($node);					// reset object information 
    }
	
	
	// get the UCSI programmes info
	function getAttribute($attrib, $tag){
	  //get attribute from html tag
	  $re = '/'.$attrib.'=["\']?([^"\' ]*)["\' ]/is';
	  preg_match($re, $tag, $match);
	  if($match){
		return urldecode($match[1]);
	  }else {
		return false;
	  }
	}
	$some_link = 'http://lms.ucsi.edu.my/fee-schedules';	// input URL address as a variable
	$dom = new DOMDocument;						// create DOM object
	$dom->preserveWhiteSpace = false;
	@$dom->loadHTMLFile($some_link);			// Load the HTML file

    $domxpath = new DOMXPath($dom);
    $newDom = new DOMDocument;
    $newDom->formatOutput = true;
    $filtered = $domxpath->query("//a" . '[@' . "target='_blank']");	// Create the Query 
    $i = 0;
	$r = 0;
    while( $myItem = $filtered->item($i++) ){
		$out= $myItem->nodeValue;					// Extract Node values
		if(strpos($out, "Fee" ) ==true )			
		{											// if any keyword is mentioned to "Fee", save it
			$UCSIFees[$r] = $out;
		}
        $node = $newDom->importNode( $myItem, true );    // import node			 
        $newDom->appendChild($node);                    // append node
		$test = $newDom->saveHTML();					// convert to string
		if(strpos($test, "Fee" ) ==true )		
		{												// gets the fees' pdf URL address
			$href = "http://lms.ucsi.edu.my".getAttribute('href', $test);
			$UCSILinks[$r] = $href;
			$r++;
		}
		$newDom->removeChild($node);					// reset object information 
    }		
	
	// get KDU programmes info
	$some_link = 'http://www.kdu.edu.my/programmes';
	$dom = new DOMDocument;
	$dom->preserveWhiteSpace = false;
	@$dom->loadHTMLFile($some_link);
    $domxpath = new DOMXPath($dom);
    $newDom = new DOMDocument;
    $newDom->formatOutput = true;
	// programmes
    $filtered = $domxpath->query("//div" . '[@' . "title='Bachelor Degree']");
    $i = 0;
    $myItem = $filtered->item($i++);	
    $node = $newDom->importNode( $myItem, true );    // import node			 
    $newDom->appendChild($node);                    // append node
	$test = $newDom->saveHTML();					// convert to string
	$newString = str_replace("+", "  ", $test);   
	$KDU = explode("<p>", $newString);
	
	//get the sunway programmes info
	$sunway = array ("Diploma in Business Administration","BSc (Hons) Accounting & Finance","BSc (Hons) Business Management","BSc (Hons) Business Studies",
	"Diploma in Information Technology","BSc (Hons) in Computer Science","BSc (Hons) Information Systems","BSc (Hons) Information Technology",
	"Diploma in Graphic and Multimedia Design","Diploma in Interior Design","Diploma in Fine Art","BSc (Hons) Psychology");	
	echo "<div class='textarea'>";
	echo "<div >";
	echo "<lable style='color:#bbb;font-size:20px;'>To Get Tuition Fees' Info, Choose Your Programmes;</lable></br></br>";	
	//sunway drop down	 
	echo "<lable style='color:#bbb;font-size:15px;'>Sunway University's Programmes</lable>";	 
	echo "<select name=selectBox3 id=selectBox3 onchange=addOption3(value); style='width: 550px; background-color:#f2f2f2;'>";
	echo "<option value=''>Sunway University's Programmes</option>";
	$N = count($sunway);
	for($i=0; $i < $N; $i++){
	echo "<option value='first semester in Sunway are required to make an initial payment between RM16,000 and RM18,000 depending on program' >$sunway[$i]</option>";
	}
	echo "</select>";
	echo "</br>";
	// nottingham drop down
	echo "<lable style='color:#bbb;font-size:15px;'>Nottingham University's Programmes</lable>";	
	echo "<select name=selectBox1 id=selectBox1 onchange=addOption1(value); style='width: 550px; background-color:#f2f2f2;'>";
	echo "<option value=''>Nottingham University's Programmes</option>";
	$N = count($nottinghamCourses);
	for($i=0; $i < $N; $i++){
	echo "<option value='$nottinghamFees[$i]'>$nottinghamCourses[$i]</option>";
	}
	echo "</select>";	
	echo "</br>";	
	//taylors drop down
	echo "<lable style='color:#bbb;font-size:15px;'>Taylor University's Programmes</lable>";	
	echo "<select name=selectBox2 id=selectBox2 onchange=addOption2(value); style='width: 550px; background-color:#f2f2f2;'>";
	echo "<option value=''>Taylors University's Programmes</option>";
	$N = count($taylorsProgrammes);
	for($i=0; $i < $N; $i++){
	echo "<option value='There is no information'>$taylorsProgrammes[$i]</option>";
	}
	echo "</select>";
	//KDU drop down	
	echo "<lable style='color:#bbb;font-size:15px;'>KDU University's Programmes</lable>";	
	echo "<select name=selectBox4 id=selectBox4 onchange=addOption4(value); style='width: 550px; background-color:#f2f2f2;'  >";
	echo "<option selected='selected'  value=''>KDU University's Programmes</option>";
	$N = count($KDU);
	for($i=1; $i < $N; $i++){
		echo "<option value='There is no information'>$KDU[$i]</option>";		 
	}
	echo "</select>";
	//UCSI drop down	
	echo "<lable style='color:#bbb;font-size:15px;'>UCSI University's Programmes</lable>";	
	echo "<select   style='width: 550px; background-color:#f2f2f2;' onchange='dropdown(this);'>";
	echo "<option selected='selected'  value=''>UCSI University's Programmes</option>";
	$N = count($UCSIFees);
	for($i=0; $i < $N; $i++){
		echo "<option value='$UCSIFees[$i]'>$UCSIFees[$i]</option>";		 
	}
	echo "</select>";
	
	echo "</div>";
	echo "<br/>";
	echo "<div>";
	//nottingham text area
	echo "<textarea rows=8 name=textBox1 id=textBox1 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";	
	//taylors text area
	echo "<textarea rows=8 name=textBox2 id=textBox2 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";	
	//sunway text area
	echo "<textarea rows=8 name=textBox3 id=textBox3 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";
	//KDU text area
	echo "<textarea rows=8 name=textBox4 id=textBox4 style='border: 0px solid #000000;background-color:#f2f2f2;'>";
	echo "</textarea>	";	
	// UCSI text area
	$N = count($UCSIFees);	
	for($i=0; $i < $N; $i++){
	echo "<div class='UCSI' id='$UCSIFees[$i]' style='display:none;' >";
	echo "<label style=;font-family:Times New Roman;'><textarea rows=8  style='border: 0px solid #000000;background-color:#f2f2f2;'>UCSI University;		$UCSIFees[$i]	 Download the pdf file 
	</textarea><a href='$UCSILinks[$i]' target='_blank'> <img src='click.png'/>  </a></label>";	
	echo "</div>";	 	 
	}
	echo "</div>";
	echo "</div>";
?>
</div>
</td> 
</tr>
</table>
</body>
</html>