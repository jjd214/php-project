<?php 
$page_title = "Developer Page";
include('partials/__header.php');
include('includes/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dev.css">
</head>
<body>
    <header>
        <nav class="section__container nav__container">
          <div class="nav__logo">Deve<span>loper</span></div>
        </nav>
        
      </header>
  
    <section class="section__container doctors__container" id="pages">
        <div class="doctors__header">
          <div class="doctors__header__content">
            <h2 class="section__header">Our Developer</h2>
          </div>
          <div class="doctors__nav">
          </div>
        </div>
        <div class="doctors__grid">
          <div class="doctors__card">
            <div class="doctors__card__image">
              <img src="ako.png" alt="doctor" />
              <div class="doctors__socials">
                <span><i class="ri-instagram-line"></i></span>
                <span><i class="ri-facebook-fill"></i></span>
                <span><i class="ri-heart-fill"></i></span>
                <span><i class="ri-twitter-fill"></i></span>
              </div>
            </div>
            <h4>Castillo, Bryan V.</h4>
            <p>Leader</p>
          </div>
          <div class="doctors__card">
            <div class="doctors__card__image">
              <img src="kirb.png" alt="doctor" />
              <div class="doctors__socials">
                <span><i class="ri-instagram-line"></i></span>
                <span><i class="ri-facebook-fill"></i></span>
                <span><i class="ri-heart-fill"></i></span>
                <span><i class="ri-twitter-fill"></i></span>
              </div>
            </div>
            <h4>Capungcol, Keanu Kirby R.</h4>
            <p>Documentation</p>
          </div>
          <div class="doctors__card">
            <div class="doctors__card__image">
              <img src="jl.png" alt="doctor" />
              <div class="doctors__socials">
                <span><i class="ri-instagram-line"></i></span>
                <span><i class="ri-facebook-fill"></i></span>
                <span><i class="ri-heart-fill"></i></span>
                <span><i class="ri-twitter-fill"></i></span>
              </div>
            </div>
            <h4>Monchez, John Lloyd P.</h4>
            <p>Frontend</p>
          </div>
        </div>
        <div class="doctors__header">
            <div class="doctors__nav">
            </div>
          </div>
          <div class="doctors__grid">
            <div class="doctors__card">
              <div class="doctors__card__image">
                <img src="crist.png" alt="doctor" />
                <div class="doctors__socials">
                  <span><i class="ri-instagram-line"></i></span>
                  <span><i class="ri-facebook-fill"></i></span>
                  <span><i class="ri-heart-fill"></i></span>
                  <span><i class="ri-twitter-fill"></i></span>
                </div>
              </div>
              <h4>Arribe, Cristian J.</h4>
              <p> Documentation</p>
            </div>
            <div class="doctors__card">
              <div class="doctors__card__image">
                <img src="phil.png" alt="doctor" />
                <div class="doctors__socials">
                  <span><i class="ri-instagram-line"></i></span>
                  <span><i class="ri-facebook-fill"></i></span>
                  <span><i class="ri-heart-fill"></i></span>
                  <span><i class="ri-twitter-fill"></i></span>
                </div>
              </div>
              <h4>Balater, Philjan</h4>
              <p>Backend</p>
            </div>
      </section>
  
    
</body>
</html>
<?php include('footer.php'); ?>