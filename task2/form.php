<?php
echo"<p>welcome to php file</p>";
$name="";
$number="";
$mail="";
$city="";
$gender="";
$language="";
$f="";


$nameErr=$numberErr=$mailErr=$generr=$err=$ferr=$lanerr=$lan2err="";


if($_SERVER["REQUEST_METHOD"]=="POST"){

 
  if(empty(test_input($_POST["name"]))){
     $nameErr="please enter the name";
  }else{
         $name=test_input($_POST["name"]);
         if(!preg_match("/^[a-zA-Z' ']*$/",$name)){
             $nameErr="only letters allowed";
         }
    }

    $number=test_input($_POST["number"]);
    if(!preg_match("/^[0-9' ']*$/",$number)){
        $numberErr="please enter numbers";
         $numberErr;
    }if(strlen($number)!=10){
        $numberErr="please enter within limits";
         $numberErr;
    }
    else{
         $number;
    }
    $mail=test_input($_POST["mail"]);
    if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        $mailErr="please enter valid email";
         $mailErr;
    }else{
         $mail;
    }
    $city=$_POST["city"];
    if(empty($city)){
        $err="please enter the city details";
         $err;
    }else{
        $city;
    }
   
    if(empty($_POST["gender"])){
        $generr="please enter gender";
         $generr;
    }else{
        $gender=$_POST["gender"];
    }
    if (isset($_POST['submit'])) {
        //checking facilities
       // $language = $_POST['language'];
          if(empty($_POST['language'])) 
          {
            $lanerr = "please select language";
          } 
         
         if(!empty($_POST['language'])) {
            $no_checked = count($_POST['language']);
            $language = $_POST['language'];
            if($no_checked<2)
            $lanerr2 = "Select at least two options";
            }
        }

        
        $ifile = $_FILES['image']['name'];
      $imageFileType = strtolower(pathinfo($ifile,PATHINFO_EXTENSION));
        if(empty($_FILES["image"]['name']))
        {
            $ferr= "Please select file.";
        }else{

        if(move_uploaded_file($_FILES['image']['tmp_name'],$ifile)){
            $f=$_FILES['image']['name'];
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          $ferr ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          
        }
        }
    }
    function test_input($data) {

        $data = trim($data);
    
        $data = stripslashes($data);
    
        $data = htmlspecialchars($data);
    
        return $data;
    
        }
    ?>
    <?
    echo "<h2>Your Input:</h2>";
if(isset($_POST['submit'])){
if($nameErr == "" && $mailErr== "" && $numberErr == "" && $generr == ""
&& $err == "" && $ferr == "" && $lanerr==""){

echo $name;
echo "<br>";
echo $number;
echo "<br>";
echo $mail; 
echo "<br>";
echo $city;
echo "<br>";
echo $gender;
echo "<br>";
$lan=implode(",",$language);
echo $lan;
echo "<br>";
echo '<img src='.$f.' alt="image.jpg">';
        }
        else{
            echo "Enter the fields correctly ";
        }
    }
?>
