<?php

//Session
session_start();

require_once('php/CreateDb.php');
require_once('./php/component.php');

//Instance of table
$database = new CreateDb(dbname: "Productdb", tablename: "Producttb");

if (isset($_POST['add'])) {
  //print_r($_POST['product_id']);
  if (isset($_SESSION['cart'])) {

    $item_array_id = array_column($_SESSION['cart'], "product_id");
    //print_r($item_array_id);

    if (in_array($_POST['product_id'], $item_array_id)) {
      echo "<script>alert('Product is already present in cart.')</script>";
      echo "<script>window.location = 'index.php'</script>";
    } else {

      $count = count($_SESSION['cart']);
      $item_array = array(
        'product_id' => $_POST['product_id']
      );

      $_SESSION['cart'][$count] = $item_array;
      //print_r($_SESSION['cart']); (Array working)
    }
  } else {
    $item_array = array(
      'product_id' => $_POST['product_id']
    );

    //New Session Var
    $_SESSION['cart'][0] = $item_array;
    print_r($_SESSION['cart']);
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marketplace</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
</head>

<body>



  <?php require_once("php/header.php"); ?>

  <h1 class="text-center pt-3 pb-1 mt-5">Featuring MacBook Air</h1>

  <div class="container p-3">
    <div class="laptopBg" data-aos="zoom-in" data-aos-duration="800">
      <img src="https://lowercolumbia.edu/_resources/plugins/royal-slider/templates/img/laptop.png" class="imgBg" width="707" height="400">


      <div id="slider-in-laptop" class="royalSlider rsDefaultInv">
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <!-- Video -->
            <video class="videoProm" controls height="570" poster="./uploads/m1.jpg">
              <source src="./uploads/MBA.mp4" type="video/mp4" />
            </video>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="">

    <ul class="ul-cards">
      <li style="--accent-color: #68AFFF">
        <div class="icon"><i class="fa-solid fa-microchip"></i></div>
        <div class="title">Apple M1 Chip</div>
        <div class="content">8-core CPU with 4 perform­ance cores and 4 efficiency cores. 7-core GPU
          16-core Neural Engine and 8-core GPU 16-core Neural Engine.</div>
      </li>
      <li style="--accent-color: #FFA44B">
        <div class="icon"><i class="fa-solid fa-bolt"></i></div>
        <div class="title">Battery and Power</div>
        <div class="content">Up to 15 hours wireless web.
          Up to 18 hours Apple TV app movie playback.
          Built-in 49.9-watt-hour lithium‑polymer battery.
          30W USB-C Power Adapter.</div>
      </li>
      <li style="--accent-color: #EF6968">
        <div class="icon"><i class="fa-solid fa-keyboard"></i></div>
        <div class="title">Keyboard and Trackpad</div>
        <div class="content">78 (US) or 79 (ISO) keys including 12 function keys and 4 arrow keys in an inverted-T arrangement.
          Ambient light sensor.
          Force Touch trackpad for precise cursor control and pressure-sensing capabilities; enables Force clicks, accelerators, pressure-sensitive drawing and Multi-Touch gestures.</div>
      </li>
      <li style="--accent-color: #0ED2D1">
        <div class="icon"><i class="fa-solid fa-display"></i></div>
        <div class="title">Retina Display</div>
        <div class="content">33.74 cm / 13.3-inch (diagonal) LED-backlit display with IPS technology; 2560x1600 native resolution at 227 pixels per inch with support for millions of colours.

          400 nits brightness.

          Wide colour (P3),

          True Tone technology.</div>
      </li>
      <li style="--accent-color: #c66fa7">
        <div class="icon"><i class="fa-solid fa-hard-drive"></i></div>
        <div class="title">Storage</div>
        <div class="content">512GB SSD, Configurable to 1TB or 2TB.</div>
      </li>
      <li style="--accent-color: #ccb033">
        <div class="icon"><i class="fa-solid fa-wifi"></i></div>
        <div class="title">Wireless</div>
        <div class="content">802.11ax Wi-Fi 6 wireless networking
          IEEE 802.11a/b/g/n/ac compatible, Bluetooth 5.0 wireless technology.</div>
      </li>

    </ul>
  </div>

  <div class="container">
    <div class="row text-center py-5">
      <?php
      $result = $database->getData();
      while ($row = mysqli_fetch_assoc($result)) {
        component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
      }
      ?>
    </div>
  </div>


  <!-- <div class="video px-5">
    <video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    width="920"
    height="720"
    poster="./uploads/HS.jpg"
    data-setup="{}"
  >
    <source src="./uploads/MSL4.mp4" type="video/mp4" />
    </video>
  
</div> -->



  <!-- Table -->


  <!-- <div class="container">
    <table class="products-4">
      <thead>
        <tr>
          <th class="label">&nbsp;</th>
          <th>
            <h3>Lenovo Legion 5</h3>
          </th>
          <th>
            <h3>Apple MacBook Pro</h3>
          </th>
          <th>
            <h3>Razer Blade 15</h3>
          </th>
          <th>
            <h3>Dell XPS 15</h3>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="heading" colspan="5">
            <span>Display Details</span>
          </td>
        </tr>
        <tr>
          <td class="label">Display Size</td>
          <td>
            <div class="spec" spec-title="Label">15.6 Inches</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">13.3 Inches</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">15.6 Inches (39.62 cm)</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">15.6 Inch</div>
          </td>
        </tr>
        <tr>
          <td class="label">Display Resolution</td>
          <td>
            <div class="spec" spec-title="Label">	1920 x 1080 Pixels</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">2560 x 1600 Pixels</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">1920 x 1080 Pixels</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">1920 x 1200 Pixels</div>
          </td>
        </tr>
        <tr>
          <td class="label">Display Features</td>
          <td>
            <div class="spec" spec-title="Label">Full HD LED Backlit Anti-Glare IPS Display</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Full HD LED Backlit Anti-Glare IPS Display</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Full HD Edge to Edge Display</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Full HD LED Backlit Anti-Glare IPS Display</div>
          </td>
        </tr>
        <tr>
          <td class="heading" colspan="5">
            <span>Heading</span>
          </td>
        </tr>
        <tr>
          <td class="label">Label</td>
          <td>
            <div class="spec" spec-title="Label">Spec 1</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 2</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 3</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 4</div>
          </td>
        </tr>
        <tr>
          <td class="label">Label</td>
          <td>
            <div class="spec" spec-title="Label">Spec 1</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 2</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 3</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 4</div>
          </td>
        </tr>
        <tr>
          <td class="label">Label</td>
          <td>
            <div class="spec" spec-title="Label">Spec 1</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 2</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 3</div>
          </td>
          <td>
            <div class="spec" spec-title="Label">Spec 4</div>
          </td>
        </tr>
      </tbody>
    </table>
  </div> -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
</body>

</html>