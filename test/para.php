<?

include('headert.php');
include('config3.php');


global $con3;
$con3 = new mysqli($it_db_host, $it_db_user, $it_db_pwd,$it_db_name); //connect to MySql
if ($con3->connect_error) {//Output any connection error
    die('Error : ('. $con3->connect_errno .') '. $con3->connect_error);
}
function checkData($word){
global $con3;
$querysub = "select * from speller where tword ='$word' limit 1";
$resultSub = mysqli_query($con3,$querysub) or die(mysqli_error($con3)) ;
  if(mysqli_num_rows($resultSub)>=1)
  {
    return 1;

  }else{
    return 0;
    }



}
// array("Volvo", "BMW", "Toyota");
$discardw=array('the','be','but','and','if','then','for');


?>
<link rel="stylesheet" href="css/foundation-icons.css" />
<style>
  /*icon styles*/
  .fi-social-facebook {
    color: dodgerblue;
    font-size: 2rem;
  }
  .fi-social-youtube {
    color: red;
    font-size: 2rem;
  }
  .fi-social-pinterest {
    color: darkred;
    font-size: 2rem;
  }
  i.fi-social-instagram {
    color: brown;
    font-size: 2rem;
  }
  i.fi-social-tumblr {
    color: navy;
    font-size: 2rem;
  }
  .fi-social-twitter {
    color: skyblue;
    font-size: 2rem;
  }
</style>
<header>
  <script src="ajaxword.js"></script>
  <? include('topbar.php'); ?>
  <!-- logo and ad break -->
  <br>
  <article class="grid-container">
    <div class="grid-x grid-margin-x">
      <div class="medium-4 cell">

        <img alt="The OSpell Project" longdesc="The OSpell Project Open Source Spell Checker" src="img/OSD-250.png">
      </div>
      <div class="medium-8 cell">
       <div class="callout primary center">
       <div class="text-center">
      <h4> The OSpell Project</h4>
       Open Source Spell Checker Database
       </div>

       </div>
      </div>
    </div>
  </article>
  <!-- / logo and ad break -->
  <br>
  <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle></button>
    <div class="title-bar-title">Menu</div>
  </div>
  <div class="top-bar align-center" id="main-menu">
    <center>
    <ul class="menu vertical medium-horizontal medium-text-center" data-responsive-menu="drilldown medium-dropdown">
      <li>
        </li>


    </ul>
  </center>
  </div>
</header>
<br>
<article class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="medium-8 cell">
    <div class="callout">
<?
$outstring="";

if (isset($_POST['doitpara'])){
  $message=$_POST['para'];
  ?> <div class="callout"><?
  // now we take it apart
  //echo $message;
  // strip commas etc
  $newstring=str_replace("\r\n", " ",$message);
  $newstring=str_replace("\n", " ",$newstring);
  $newstring=str_replace("<br>", " ",$newstring);
  $newstring=str_replace("    ", " ",$newstring);
  $newstring=str_replace("   ", " ",$newstring);
  $newstring=str_replace(",", " ",$newstring);
  $newstring=str_replace('"', " ",$newstring);
  $newstring=str_replace("’", "_",$newstring);
  $newstring=str_replace("'", " ",$newstring);

  $newstring=str_replace('“', " ",$newstring);
  $newstring=str_replace('”', " ",$newstring);

  $newstring=str_replace('.', " .",$newstring);
  $newstring=str_replace('?', " ?",$newstring);
  $newstring=str_replace('!', " !",$newstring);
  $newstring=str_replace(':', " :",$newstring);
  $newstring=str_replace(';', " ;",$newstring);



  $estring=explode(" ",$newstring);
  $badwords="";
    //$myfile = fopen("testck.txt", "w") or die("Unable to open file!");
  foreach($estring as $word){
$word=trim($word);
//$tword=strtolower($word);
if ( preg_match('/\s/',$word) ){
//  echo "yes $string contain whitespace";
} else {



//  echo "Match not found $word <br>";
  //$outarray[]=trim($word);
  // check to see if in Database
  $ck=checkData($word);
  //$word=trim($word);
  if ($ck==0){





    switch ($word){
      case " ":
      $outstring .=" ";
      break;
      case "  ":
      $outstring .=" ";
      break;
      case "   ":
      $outstring .=" ";
      break;
      case "    ":
      $outstring .=" ";
      break;
      case "'":
      $outstring .="'";
      break;
      case '"':
      $outstring .='"';
      break;

      case ".":
      $outstring .=".";
      break;
      case "?":
      $outstring .="?";
      break;
      case "!":
      $outstring .="!";
      break;
      case ":":
      $outstring.= ":";
      break;
      case ";":
      $outstring .=";";
      break;
      default:
      $word=str_replace("_","’",$word);
      $outstring.="<span class='spe'><u>$word</u></span> ";
      if ( preg_match('/\s/',$word) ){
      //  echo "yes $string contain whitespace";
    } else {
      if ($word==""){
      }else{
        $badwords .=trim($word).",";
      }
      }


      break;
    }

    // do link
//    echo "Found Word  $word<br>";
    // <a class="button expanded" href="#" onclick="ajaxRC('dorandom','0')">Generate Random</a>

  }else{
//    echo "NOT Found   $word <br>";
$word=trim($word);
$word=str_replace("_","’",$word);
$outstring.=$word." ";
}


}
}
//$txt = $word;
//fwrite($myfile, $badwords);
//fclose($myfile);
echo $outstring;

  ?>
</div>
  	<textarea name="para" cols="180" rows="25"><?=$message?></textarea><br>
    <?
}else{

?>

      <p>Paragraph </p>
      <form method="post" action="para.php">

      	<textarea name="para" cols="180" rows="25"></textarea><br>
        <input class="button large rounded" name="Submit1" type="submit" value=" SEND " />
      		<input name="doitpara" type="hidden" value="1">

      </form>
<?
} // end if set doitpara
?>






      </div>
    </div>
    <div class="medium-4 cell callout">
      <div id="results"></div>
<?
if ($badwords<>""){
  $bstring=explode(",",$badwords);
    foreach($bstring as $eword){
    $eword=trim($eword);
      if ( $eword=="" ){
        //echo "yes $string contain whitespace";
      } else {
      //  echo "$string clear no whitespace ";
        if ($eword=="<br>"){
          // do nothing
        }else{
          echo $eword ."<br>";
        }
      }


    }
}
?>


    </div>
  </div>
</article>
<hr>
<article class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="grid-x large-12 cell">
<div class="text-center">
  <h4 style="margin: 0;" class="text-center">BREAKING NEWS</h4>
  <div class="grid-x large-1#2 cell">
    WE are working hard getting the first database up and running. So far we are referencing over Eight Thousand words. Hopefully soon we will have the database ready for distribution.
  </div>
</div>
</div>
    <hr>
    <div class="grid-x large-12 cell">
      <div class="text-center">

  </div>




        </div>
      </div>

    </div>
</article>

<?
include('footert.php');
?>
