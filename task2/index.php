<html>
<title>application form</title>
<body>
    <style>
    .table {
        
        border:5px double black;
       
        border-collaspe:collapse;
        cursor: pointer;
      
           
        }
        table.center{
            background-color:grey;
            border-radius: 12px;
            margin-left:auto;
            margin-right:auto;
            border:2px solid black;
            height:50%;
            width:35%;
            cursor: pointer;
            
        
        }
       .error{
            color:yellow;
        }
        .button {
  background-color: green; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 2px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
}.button:hover {
  box-shadow: 0 4px 4px 0 rgba(0,0,0,0.24),0 4px 4px 0 rgba(0,0,0,0.19);
}

    </style>
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
//include "db.php";

// $servername = "localhost";
//         $username = "root";
//         $password = "";
//         $dbname = "formdata";
        
//         // Create connection
//         $conn = new mysqli($servername, $username, $password, $dbname);
//         // Check connection
//         if ($conn->connect_error) {
//           die("Connection failed: " . $conn->connect_error);
//         }else{
//             echo "connection created ";
//             echo "<br>";
//         }
//         $sql="select * from formdata where (number='$number' or mail='$mail');";

//         $res=mysqli_query($conn,$sql);
    
//        // if (mysqli_num_rows($res) > 0) {
          
//           $row = mysqli_fetch_assoc($res);


if(isset($_POST['submit'])){

 
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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "formdata";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }else{
            echo "connection created ";
            echo "<br>";
        }
        

     $sql_u = "SELECT * FROM formdata WHERE number='$number'";
     $sql_e = "SELECT * FROM formdata WHERE mail='$mail'";
     $res_u = mysqli_query($conn, $sql_u);
     $res_e = mysqli_query($conn, $sql_e);
     
     
     if (mysqli_num_rows($res_u) > 0) {

       $numberErr = "Sorry number already taken";    
     
     }
       if(mysqli_num_rows($res_e) > 0){
       $mailErr = "Sorry... email already taken";    
     }
    
     if($nameErr == "" && $mailErr== "" && $numberErr == "" && $generr == ""
     && $err == "" && $ferr == "" && $lanerr==""){
       
    $name=$_POST['name'];
    $number=$_POST['number'];
    $mail=$_POST['mail'];
    $city=$_POST['city'];
    $gender=$_POST['gender'];
    $language=$_POST['language'];
    $lan= implode(",",$language);
    $f= $_FILES['image']['name'];
    $filepath=realpath($f);
    $file=mysqli_real_escape_string($conn,$filepath);
        
        $sql = "INSERT INTO formdata VALUES  ('0','$name','$number','$mail','$city','$gender','$lan','$f','$file')";
        
        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully"."<br>";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
     

}


    function test_input($data) {

        $data = trim($data);
    
        $data = stripslashes($data);
    
        $data = htmlspecialchars($data);
    
        return $data;
    
        }
    ?>
    
   
  <p><span class="err">*required fields</span></p>  
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    
            <table class="center">
            <tr>
            <th>Name</th>
            <td><input type="text" name="name" maxlength = "10" value="<?php echo $name;?>">
         <span class="error">*<?php echo $nameErr; ?></span></td><br><br>
            </tr>
            <tr>
                <th>Mobile no</th>
                <td><input type="text" name="number" maxlength = "10" value="<?php echo $number;?>">
              <span class="error">*<?php echo $numberErr; ?></span></td><br><br>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="text" name="mail" value="<?php echo $mail;?>">
                  <span class="error">*<?php echo $mailErr; ?></span></td><br><br>
                </tr>
                <tr>
                    <th>City</th>
                    <td><select name="city">
                    <option value="">select</option>
                    <!-- <//?php if ($tag_1 == 'yes') echo "checked='checked'"; ?> -->
                        <option value="Chennai" <?php if($city == 'Chennai')  echo "selected='selected'";?> >Chennai</option>
                        <option value="Villupuram" <?php if($city == 'Villupuram') echo "selected='selected'";?> >Villupuram</option>
                        <option value="Banglore" <?php if($city == 'Banglore') echo "selected='selected'"; ?> >Banglore</option>
                        </select>
                       <span class="error">*<?php echo $err; ?></span></td><tr>
                    
                
                <tr>
                    <th>Gender</th>
                    <td><input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender=="female") echo "checked='checked'";?> >Female
                        <input type="radio" name="gender"  value="male" <?php if (isset($gender) && $gender=="male")  echo "checked='checked'";?>>Male
                        <input type="radio" name="gender"  value="other" <?php if (isset($gender) && $gender=="other")  echo "checked='checked'";?>>Other  
                        <span class="error">* <?php echo $generr;?></span>
  <br><br>
                </td>
                </tr>
                <tr>
                    <th>Languages</th>
        <td><input type="checkbox" name="language[]" value="Tamil" <?php if(isset($_POST['submit']) && isset($_POST['language'][0])) echo "checked"; ?>>Tamil
            <input type="checkbox" name="language[]" value="English"<?php if(isset($_POST['submit']) && isset($_POST['language'][1])) echo "checked"; ?>>English
            <input type="checkbox" name="language[]" value="Hindi" <?php if(isset($_POST['submit']) && isset($_POST['language'][2])) echo "checked"; ?>>Hindi
            <span class="error">*<?php echo $lanerr; ?></span>
        </br></br>
</td>
</tr>
                <tr>
                    <th>Resume</th>
                    <td><input type="file" name="image" value="<?php echo $f ;?>">
                <span class="error"> *<?php echo $ferr;?></span></td>
</tr>
                <tr>
                    <td> </td>
                    <td><input type="submit" name="submit" class="button"></td>
                </tr>

                    </table>
        </form>
    <?php
    
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
echo "<br>";        }
        else{
            echo "Enter the fields correctly ";
        }
    }
?>
<?php
    
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
if(isset($_POST['submit'])){
    if($nameErr == "" && $mailErr== "" && $numberErr == "" && $generr == ""
    && $err == "" && $ferr == "" && $lanerr==""){
$mail = new PHPMailer(true);

try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'developerxmedia052@gmail.com';                     //SMTP username
    $mail->Password   = 'cqqlbbjumjbnrgre';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($_POST['mail'], 'Mailer');
    $mail->addAddress($_POST['mail']); 
    $mail->addAddress('gopi@xmedia.in');
    $f= $_FILES['image']['name'];
    $filepath=realpath($f);

    $mail->addAttachment($filepath);         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'application form';
    $lan=implode(",",$language);
    $message="Name :".$name."<br>"."Number :".$number."<br>"."City :".$city."<br>"."Gender :".$gender."<br>"."Language :".$lan."<br>"."File Name :".$_FILES['image']['name'];
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
}
    
    ?>


</body>
</html>