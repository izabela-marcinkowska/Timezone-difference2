<?php
// Check if username is not empty and between 2 and 50 characters long
function isValidUsername($username)
{
  return !empty($username) && strlen($username) >= 2 && strlen($username) <= 50;
}

// Use PHP's filter_var() function to validate the email
function isValidEmail($email)
{
  // This code validates that the given email address is valid.
  // It returns true if the address is valid, and false otherwise.
  // It uses the built-in PHP function filter_var, which is documented
  // at http://php.net/manual/en/function.filter-var.php.
  // It uses the FILTER_VALIDATE_EMAIL filter, which is documented at
  // http://php.net/manual/en/filter.filters.validate.php.
  // The filter_var function returns false if the email is invalid, and
  // returns the email if it is valid.
  return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Try to create a DateTime object with the string
// If it fails, the datetime string is not valid
function isValidDatetime($datetime)
{
  return DateTime::createFromFormat('Y-m-d\TH:i', $datetime) !== false;
}

// Check if the timezone is in the list of PHP's valid timezones
function isValidTimezone($timezone)
{
  return in_array($timezone, timezone_identifiers_list());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css">
  <style>
    .container {
      max-width: 600px;
      margin: 0 auto;
    }

    h1 {
      text-align: center;
    }
  </style>
  <title>Calculated result</title>
</head>

<body>
  <div class="container">
    <?php
    // check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // get the form data
      $errors = [];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $datetime1 = $_POST['datetime1'];
      $timezone1 = $_POST['timezone1'];
      $datetime2 = $_POST['datetime2'];
      $timezone2 = $_POST['timezone2'];

      // validate the inputs
      // check if username is valid
      if (!isValidUsername($username)) {
        // add an error to the errors array
        $errors[] = 'Invalid username. It must be 2 to 50 characters long.';
      }
      // check if email is valid
      if (!isValidEmail($email)) {
        // add an error to the errors array
        $errors[] = 'Invalid email.';
      }
      // check if datetime and timezone are valid
      if (!isValidDatetime($datetime1) || !isValidDatetime($datetime2)) {
        // add an error to the errors array
        $errors[] = 'Invalid datetime. It must be in the format: "YYYY-MM-DDTHH:MM".';
      }
      // check if timezone is valid
      if (!isValidTimezone($timezone1) || !isValidTimezone($timezone2)) {
        // add an error to the errors array
        $errors[] = 'Invalid timezone.';
      }

      // create DateTime objects
      $date1 = new DateTime($datetime1, new DateTimeZone($timezone1));
      $date2 = new DateTime($datetime2, new DateTimeZone($timezone2));

      // calculate the difference
      $interval = $date1->diff($date2);

      // calculate timezone difference
      $timeOffset1 = $date1->getOffset();
      $timeOffset2 = $date2->getOffset();
      $timezoneDiff = ($timeOffset1 - $timeOffset2) / 3600;

      // If there are validation errors, display them
      if (!empty($errors)) {
        echo '<p><strong>Validation errors:</strong></p>';
        foreach ($errors as $error) {
          echo "<p>$error</p>";
        }
      } else {
        // display the results
        echo '<h1>Calculated Result</h1>';
        echo '<ul>';
        echo '<li>Username: ' . htmlspecialchars($username, ENT_QUOTES) . '</li>';
        echo '<li>Email: ' . htmlspecialchars($email, ENT_QUOTES) . '</li>';
        echo '<li>Timezone Difference: ' . $timezoneDiff . ' hour(s)</li>';
        echo '<li>Hours Difference: ' . $interval->h . ' hour(s)</li>';
        echo '<li>Days Difference: ' . $interval->days . ' day(s)</li>';
        echo '</ul>';
      }
    }
    ?>
    <a class="pure-button pure-button-primary" href="/">Calculate again</a>
  </div>
</body>

</html>
