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
      $datetime1 = $_POST['datetime1'];
      $timezone1 = $_POST['timezone1'];
      $datetime2 = $_POST['datetime2'];
      $timezone2 = $_POST['timezone2'];

      // create DateTime objects
      $date1 = new DateTime($datetime1, new DateTimeZone($timezone1));
      $date2 = new DateTime($datetime2, new DateTimeZone($timezone2));

      // calculate the difference
      $interval = $date1->diff($date2);

      // get timezone difference from UTC with offsett function
      $timeOffset1 = $date1->getOffset();
      $timeOffset2 = $date2->getOffset();
      // calculate the difference into hours
      $timezoneDiff = ($timeOffset1 - $timeOffset2) / 3600;

      // display the results
      echo '<h1>Calculated Result</h1>';
      echo '<ul>';
      echo '<li>Timezone Difference: ' . $timezoneDiff . ' hours</li>';
      echo '<li>Hours Difference: ' . $interval->h . ' hour(s)</li>';
      echo '<li>Days Difference: ' . $interval->days . ' day(s)</li>';
      echo '</ul>';
    }
    ?>
    <a class="pure-button pure-button-primary" href="/">Calculate again</a>
  </div>
</body>

</html>
