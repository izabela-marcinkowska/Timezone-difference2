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
  <title>Timezone Diff</title>
</head>

<body>
  <?php
  // get all timezones
  // https://www.php.net/manual/en/datetimezone.listidentifiers.php
  $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
  ?>
  <div class="container">
    <h1>Timezone Diff</h1>
    <form action="timezone_diff.php" method="post" class="pure-form pure-form-aligned">
      <fieldset>
        <div class="pure-control-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="pure-control-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="pure-control-group">
          <label for="datetime1">Datetime 1:</label>
          <input type="datetime-local" id="datetime1" name="datetime1">
        </div>
        <div class="pure-control-group">
          <label for="timezone1">Timezone 1:</label>
          <select id="timezone1" name="timezone1">
            <?php
            // loop through all timezones
            foreach ($tzlist as $tz) { ?>
              <option value="<?php echo $tz; ?>"><?php echo $tz; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="pure-control-group">
          <label for="datetime2">Datetime 2:</label>
          <input type="datetime-local" id="datetime2" name="datetime2">
        </div>
        <div class="pure-control-group">
          <label for="timezone2">Timezone 2:</label>
          <select id="timezone2" name="timezone2">
            <?php
            // loop through all timezones
            foreach ($tzlist as $tz) { ?>
              <option value="<?php echo $tz; ?>"><?php echo $tz; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="pure-controls">
          <input type="submit" value="Calculate" class="pure-button pure-button-primary">
        </div>
      </fieldset>
    </form>
  </div>
</body>

</html>
