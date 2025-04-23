<?php
    include 'session_check.php';
    include 'db.php';
    

    // Api Activator
    $apiKey = '7897dc6d802c67e5c54e041b850ab12b';

    $weather = true;

    // Api Test Start
    if (true == $weather) {
        $city = 'Badda';
        $city2 = 'Barisal';
        function getWeatherData($city, $apiKey) {
            $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if ($response === false) {
                echo 'cURL error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }
            $data = json_decode($response, true);
            if ($data === null || $data['cod'] != 200) {
                echo 'API error: ' . $response;
                curl_close($ch);
                return false;
            }
            curl_close($ch);
            return $data;
        }
        function getWeatherData2($city2, $apiKey) {
            $url = "http://api.openweathermap.org/data/2.5/weather?q={$city2}&appid={$apiKey}&units=metric";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if ($response === false) {
                echo 'cURL error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }
            $data = json_decode($response, true);
            if ($data === null || $data['cod'] != 200) {
                echo 'API error: ' . $response;
                curl_close($ch);
                return false;
            }
            curl_close($ch);
            return $data;
        }
    }
    // Api Test End
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'inc/head.php'; ?>
    <body class="main-page">
        <?php if ($loggedIn): ?>

            <div class="st-header">
                <?php include 'layout/header.php'; ?>
            </div>

            <div class="main-content">
                <div class="intro-content">
                    <div class="container">
                        <h1>Enterd Successfully</h1>
                        <div style="margin-top: 50px;">
                            <h2>Want to test this site?</h2>
                            As (Administrator)<br>
                            User: administrator123<br>
                            Pass: administrator123
                            <br>
                            <br>
                            As (admin)<br>
                            User: test-admin123<br>
                            Pass: test-admin123
                            <br>
                            <br>
                            As (visitor or user)<br>
                            User: user123<br>
                            Pass: user123
                        </div>

                        <div class="api-call-area" style="padding: 100px 0;">
                            <h2 class="mb-40 text-center">API Area</h2>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-30">
                                    <h4 class="mb-20">Weather</h4>
                                    <?php 
                                        if (true == $weather) {
                                            $weatherData = getWeatherData($city, $apiKey);
                                            if (!empty($weatherData)) {
                                                $temperature = $weatherData['main']['temp'];
                                                $humidity = $weatherData['main']['humidity'];
                                                $description = $weatherData['weather'][0]['description'];

                                                // Background Color
                                                function temperature_to_color($temperature) {
                                                    $min_temp = 25;
                                                    $max_temp = 40;

                                                    $green = array(51, 204, 51);
                                                    $yellow = array(255, 128, 0);
                                                    $red = array(255, 64, 0);
                                                    $normalized_temp = ($temperature - $min_temp) / ($max_temp - $min_temp);
                                                    if ($normalized_temp <= 0.5) {
                                                        $ratio = $normalized_temp / 0.5;
                                                        $colorValue = array(
                                                            intval($green[0] + ($yellow[0] - $green[0]) * $ratio),
                                                            intval($green[1] + ($yellow[1] - $green[1]) * $ratio),
                                                            intval($green[2] + ($yellow[2] - $green[2]) * $ratio)
                                                        );
                                                    }
                                                    else {
                                                        $ratio = ($normalized_temp - 0.5) / 0.5;
                                                        $colorValue = array(
                                                            intval($yellow[0] + ($red[0] - $yellow[0]) * $ratio),
                                                            intval($yellow[1] + ($red[1] - $yellow[1]) * $ratio),
                                                            intval($yellow[2] + ($red[2] - $yellow[2]) * $ratio)
                                                        );
                                                    }
                                                    return $colorValue;
                                                }
                                                $colorValue = temperature_to_color($temperature);
                                                ?>
                                                
                                                <div class="api-call-weather common" style="background: rgba(<?php echo implode(',', $colorValue)?>);">
                                                    <span class="temp"><?php echo $temperature ?><sup>°C</sup></span>
                                                    <ul>
                                                        <li class="city">Weather in: <b><?php echo $city ?></b></li>
                                                        <li class="humi">Humidity: <?php echo $humidity ?>%</li>
                                                        <li class="desc">Description: <i><?php echo $description ?></i></li>
                                                    </ul>
                                                </div>
                                            <?php } else {
                                                echo "Failed to fetch weather data for {$city}.";
                                            }
                                        } else {
                                            echo "Service is off.";
                                        }
                                    ?>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <h4 class="mb-20">Weather</h4>
                                    <?php 
                                        if (true == $weather) {
                                            $weatherData = getWeatherData2($city2, $apiKey);
                                            if (!empty($weatherData)) {
                                                $temperature = $weatherData['main']['temp'];
                                                $humidity = $weatherData['main']['humidity'];
                                                $description = $weatherData['weather'][0]['description'];

                                                // Background Color
                                                function temperature_to_color2($temperature) {
                                                    $min_temp = 25;
                                                    $max_temp = 40;

                                                    $green = array(51, 204, 51);
                                                    $yellow = array(255, 128, 0);
                                                    $red = array(255, 64, 0);
                                                    $normalized_temp = ($temperature - $min_temp) / ($max_temp - $min_temp);
                                                    if ($normalized_temp <= 0.5) {
                                                        $ratio = $normalized_temp / 0.5;
                                                        $colorValue = array(
                                                            intval($green[0] + ($yellow[0] - $green[0]) * $ratio),
                                                            intval($green[1] + ($yellow[1] - $green[1]) * $ratio),
                                                            intval($green[2] + ($yellow[2] - $green[2]) * $ratio)
                                                        );
                                                    }
                                                    else {
                                                        $ratio = ($normalized_temp - 0.5) / 0.5;
                                                        $colorValue = array(
                                                            intval($yellow[0] + ($red[0] - $yellow[0]) * $ratio),
                                                            intval($yellow[1] + ($red[1] - $yellow[1]) * $ratio),
                                                            intval($yellow[2] + ($red[2] - $yellow[2]) * $ratio)
                                                        );
                                                    }
                                                    return $colorValue;
                                                }
                                                $colorValue = temperature_to_color2($temperature);
                                                ?>
                                                
                                                <div class="api-call-weather common" style="background: rgba(<?php echo implode(',', $colorValue)?>);">
                                                    <span class="temp"><?php echo $temperature ?><sup>°C</sup></span>
                                                    <ul>
                                                        <li class="city">Weather in: <b><?php echo $city2 ?></b></li>
                                                        <li class="humi">Humidity: <?php echo $humidity ?>%</li>
                                                        <li class="desc">Description: <i><?php echo $description ?></i></li>
                                                    </ul>
                                                </div>
                                            <?php } else {
                                                echo "Failed to fetch weather data for {$city2}.";
                                            }
                                        } else {
                                            echo "Service is off.";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <h2>My PeerJS ID: <span id="my-id">Loading...</span></h2>
                
                <h2>
                    Other End: Id:<span>384a3006-d94b-43ea-bf0a-713f68d6ab1f</span><br>
                    Target Url: https://check-wp.rf.gd/khdfkhsduhfsdf
                </h2>

                <input type="text" id="remote-id" placeholder="Enter peer ID to call">
                <button onclick="startCall()">Call</button>

                <h3>Chat:</h3>
                <div id="chat-box"></div>
                <input type="text" id="chat-input" placeholder="Type a message...">
                <button onclick="sendMessage()">Send</button>

                <audio id="remote-audio" autoplay></audio>
            </div>


        <?php else: ?>
            <div class="container">
                <h1>Nothing Found</h1>
                <a href="index.php">Login</a>
            </div>
        <?php endif; ?>
        <?php
            if ($loggedIn) {
                include 'inc/user_chat.php';
            }
            include 'inc/footer.php'; 
        ?>
    </body>
</html>