<?php

require ('config.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHONIX</title>

    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
</header>

    
<nav>
  <ul>
    <li></svg><a href="#">Home</a>
    <li><a href="#">Over Ons</a></li>
    <li><a href="#">Klantenservice</a></li>
    <li><a href="#">Onze Service</a></li>
    <li><a href="#">Service &amp; Contact</a></li>
  </ul>
</nav>

 <header>
    <div class="header">
        <h2>Welkom bij PHONIX</h2>
      <div class="line"></div>
      <h1>Ondekt onze telefoons</h1>
  <a href="#" class="ctn">Zie meer</a>
      
    </div>
 </header>

 <section class="service">
  <div class="title">
    <h1>OverOns</h1>
    <div class="line"></div>
  </div>
  <div class="row">
    <div class="col">
      <img src="images/logo.png" alt="">
      <h4>Welkom</h4>
      <p>welkom bij PHONIX waar we je kunnen helpen met problemen van je devices. Of wil je een nieuwe telefoon kopen met abonnemnent 
        is allemaal beschikbaar bij ons<br></p>
      <a href="#" class="ctn">Lees meer</a>
      </div>
  </div>
 </section>

 <section class="klanten">
  <div class="explore">
  <h1>klantenservice</h1>
  <div class="line"></div>
  <p>Heeft u ergens hulp meenodig wij helpen u graag <br>
  kunt u het niet vinden bel ons dan op +31 6303479</p>
  <a href="#" class="ctn">Neem contact</a>
  </div>
 </section>

 <section class="tours">
 <div class="row">
  <div class="col content-col">
    <h1>Onze Service</h1>
    <div class="line"></div>
    <p>heb jij problemen of vragen over je toestel, bijvoorbeeld schermreparaties een 
      abonnemnent openen met ziggo, kpn, odido noem maar op. Dan kan je bij ons terecht
      in de winkel of online een afspraak maken.
    </p>
    <a href="#" class="ctn">lees meer</a>
  </div>
 <div class="col image-col">
  <div class="image-gallery">
    <img src="images/img4.jpg" alt="">
    <img src="images/img3.jpg" alt="">
    <img src="images/img5.jpg" alt="">
    <img src="images/img7.jpg" alt="">
  </div>
 </div>
</div>
 </section>

 <section class="footer">
    <p>Osdorp Aker Amsterdam 1075GF | Phone: +31 6960840 | Email: PhonixInfo@gmail.com </p>
    <p>Copyright @ 2023 Outdoor Adventure</p>
 </section>



    <script>
      const menu = document.querySelector('.menu')
      const nav = document.querySelector('.nav')

      menu.addEventListener('click',()=>{
        nav.classlist.toggle('.menu')
      })
    </script>
</body>
</html>