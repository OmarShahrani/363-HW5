<!DOCTYPE html>
<html>

<head>
  <!--<meta charset="utf-8">-->
  <title>Weather API</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css?version=1">
</head>

<body background="images/blue.png" style="background-size: cover;">
  <div class="form">
    <fieldset>
      <h1>Weather Cast</h1><br><br>
      <h3>Type a city to display the forcast </h1>
        <form action="" method="post">
          <input name="city" class="city" type="text" placeholder="Enter a city's name" required><br>
          <h3>Choose the type of degree </h1>
            <input type="radio" class="radio" name="temp" value="C" checked="checked" style="display: inline-block;"> <label>C</label><label style="padding: 0 30px;"> </label>
            <input type="radio" class="radio" name="temp" value="F" style="display: inline-block;  padding: 0 0 0 50px;"> <label>F</label> <br><br><br>
            <input type="submit" class="sub" value="Search">
            <input type="reset" class="res" value="Clear">

            <div class="panel-body" id="show_weather">

            </div>

        </form>

        <script>
          $(document).ready(function() {
            load_data();

            function load_cart_data() {
              $.ajax({
                url: "index.php",
                method: "POST",
                success: function(data) {
                  $('#show_weather').html(data);
                }
              });
            }
          });
        </script>


        <?php
        if (isset($_POST['city'])) {
          $apiKey = '0dc895d64e1d4b27833215c906a1a035';

          $city = $_POST['city'];
          $temp = $_POST['temp'];

          if ($temp == 'C') {
            $request = "http://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=$apiKey";
            $response  = file_get_contents($request);
            $json  = json_decode($response);
            $country = $json->sys->country;
            $descrption = $json->weather[0]->description;
            $temp = $json->main->temp;
            $min = $json->main->temp_min;
            $max = $json->main->temp_max;
            $windSpeed = $json->wind->speed;
            $clouds = $json->clouds->all;
            $press = $json->main->pressure;

            echo '
              <div class="table-responsive" id="order_table">
               <table class="table table-bordered table-striped">
                <tr>
                          <th>City</th>
                          <th>Country</th>
                          <th>description</th>
                          <th>temp in C</th>
                          <th>Min</th>
                          <th>Max</th>
                          <th>Clouds</th>
                          <th>Wind Speed</th>
                          <th>Pressure</th>
                      </tr>

                  <tr>
                         <td>' . $city . '</td>
                         <td>' . $country . '</td>
                         <td>' . $descrption . '</td>
                         <td>' . $temp . '</td>
                         <td>' . $min . '</td>
                         <td>' . $max . '</td>
                         <td>' . $clouds . '</td>
                         <td>' . $windSpeed . '</td>
                         <td>' . $press . '</td>
                  </tr>
                  </table></div>';
          } else if ($temp == 'F') {
            $request = "http://api.openweathermap.org/data/2.5/weather?q=$city&units=imperial&appid=$apiKey";
            $response  = file_get_contents($request);
            $json  = json_decode($response);
            $country = $json->sys->country;
            $descrption = $json->weather[0]->description;
            $temp = $json->main->temp;
            $min = $json->main->temp_min;
            $max = $json->main->temp_max;
            $windSpeed = $json->wind->speed;
            $clouds = $json->clouds->all;
            $press = $json->main->pressure;
            echo '
               <div class="table-responsive" id="order_table">
                <table class="table table-bordered table-striped">
                 <tr>
                           <th>City</th>
                           <th>Country</th>
                           <th>description</th>
                           <th>temp in F</th>
                           <th>Min</th>
                           <th>Max</th>
                           <th>Clouds</th>
                           <th>Wind Speed</th>
                           <th>Pressure</th>
                </tr>
                <tr>
                          <td>' . $city . '</td>
                          <td>' . $country . '</td>
                          <td>' . $descrption . '</td>
                          <td>' . $temp . '</td>
                          <td>' . $min . '</td>
                          <td>' . $max . '</td>
                          <td>' . $clouds . '</td>
                          <td>' . $windSpeed . '</td>
                          <td>' . $press . '</td>
                </tr></table></div>';
          }
        }

        ?>
    </fieldset>
  </div>
</body>

</html>