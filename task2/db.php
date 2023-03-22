
<?php
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
        }  $sql="select * from formdata where (number='$number' or mail='$mail');";

        $res=mysqli_query($conn,$sql);
    
        if (mysqli_num_rows($res) > 0) {
          
          $row = mysqli_fetch_assoc($res);
        
          if($_POST['number']==isset($row['number']))
          { //PRINT_R($_POST['number']); PRINT_R($row['number']); EXIT();
              $numberErr="number already exists";
          }else{
            $number;
          }
          if($_POST['mail']==isset($row['mail']))
          {
                  $mailErr= "email already exists";
          }else{
            $mail;
          }
        }
        else{  
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
        ?>