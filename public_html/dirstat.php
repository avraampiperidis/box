<?php


function dirstat($folder) {


$dir    = "../resources/users/".$folder;
$files1 = scandir($dir);
$lenght = count($files1);
for( $i =2; $i < $lenght ; $i++) {
echo '<pre><p class="button-link" ><a href="',"../resources/users/".$folder.'/'.$files1[$i],'" > ';
print_r($files1[$i]); 
if (strpos($files1[$i],'.pdf')) {
  echo " "; // echo '</a><font color="Yellow"> <b  >    pdf </b> </font>';
  echo " ";	//echo '    <a href="',$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
  echo " "; //echo '</a></p></pre>';
}
 else if (strpos($files1[$i],'.html')) {
  echo " ";    // echo '<font color="red">  html </font>';
  echo " ";    //echo '</a></p></pre>';
}
 else if (strpos($files1[$i],'.txt')) {
   echo " ";// echo '<font color="white">  txt </font>';
   echo " ";//echo '</a></p></pre>';
}
	else if (strpos($files1[$i],'.doc')) {
    echo " ";//echo '<font color="purple">  doc </font>';
    echo " ";//echo '</a></p></pre>';
    }
	else if (strpos($files1[$i],'.docx')) {
    echo " ";//echo '<font color="purple">  docx </font>';
    echo " ";//echo '</a></p></pre>';
    }
	else if (strpos($files1[$i],'.zip')) {
    echo " ";//echo '<font color="purple">  zip </font>';
    echo " ";//echo '</a></p></pre>';
    }
	else if (strpos($files1[$i],'.rar')) {
    echo " ";//echo '<font color="purple">  rar </font>';
    echo " ";//echo '</a></p></pre>';
    }
	else if (strpos($files1[$i],'.ppt')) {
    echo " ";//echo '<font color="purple">  ppt </font>';
    echo " ";//echo '</a></p></pre>';
    }
	else if (strpos($files1[$i],'.pptx')) {
    echo " ";//echo '<font color="purple">  pptx </font>';
    echo " ";//echo '</a></p></pre>';
    }
	else {
	echo " ";//echo '<font color="red">  pptx </font>';
    echo " ";//echo '</a></p></pre>';
	}
  }
}


function dirstat2($folder) {

$dir    = "../resources/users/".$folder;
$files1 = scandir($dir);
$lenght = count($files1);
for( $i =2; $i < $lenght ; $i++) {
echo '<pre><p class="button-link2" >';  
echo " ";//print_r($files1[$i]); 
if (strpos($files1[$i],'.pdf')) {
    echo '<font color="Yellow"> <b> pdf</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'"download>  <font color="white"> <b >Download</b> </font>  ';
echo '</a></p></pre>';
}
 else if (strpos($files1[$i],'.html')) {
    echo '<font color="white"><b> html</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download</b> </font>  ';
echo '</a></p></pre>';
}
 else if (strpos($files1[$i],'.txt')) {
    echo '<font color="white"> <b> txt</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
echo '</a></p></pre>';
}
else if (strpos($files1[$i],'.doc')) {
    echo '<font color="blue"> <b> doc</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
echo '</a></p></pre>';
}
else if (strpos($files1[$i],'.docx')) {
    echo '<font color="blue"> <b> docx</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
echo '</a></p></pre>';
}
else if (strpos($files1[$i],'.zip')) {
    echo '<font color="orange"> <b> zip</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
echo '</a></p></pre>';
}
else if (strpos($files1[$i],'.rar')) {
    echo '<font color="purple"> <b> rar</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
echo '</a></p></pre>';
}
else if (strpos($files1[$i],'.ppt')) {
    echo '<font color="red"> <b> ppt</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
echo '</a></p></pre>';
}
else if (strpos($files1[$i],'.pptx')) {
    echo '<font color="purple"> <b> pptx</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
echo '</a></p></pre>';
  }
  else {
    echo '<font color="red"> <b> unknown</b> </font>';
	echo '    <a class="button-link" href="',"../resources/users/".$folder.'/'.$files1[$i],'" download> <font color="white"> <b >Download </b> </font> ';
    echo '</a></p></pre>';
  }
 }
}

?>