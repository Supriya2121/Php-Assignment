
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $capErr="";
$name = $email = $gender = $comment = $website = $cap= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "life span is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  
  if (empty($_POST["cap"]))
  {
    $capErr = "✔";
  }
  else 
  {
   $capErr = "please check capcha";
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Assignment</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Category:
  <input type="radio" name="email" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="herbivores">herbivores
  <input type="radio" name="email" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="omnivores">omnivores
  <input type="radio" name="email" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="camivores">camivores
  <br><br>
  Image: <input type="file" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Description: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Life expectancy:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="0-1 year">0-1 year
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="1-5 year">1-5 year
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="5-10 year">5-10 year
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="10+ year">10+ year
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Captcha:
  <input type="text" name="cap" > 10+3 <br><br>
  
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>