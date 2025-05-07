<?php 
$page_title = "Home Page";

include('partials/__header.php');
include('includes/navbar.php');
#a
?>
    <header>
      <div class="section__container header__container" id="home">
        <div class="header__content">
          <h1>Health Care</h1>
          <p>
            Welcome, where exceptional patient experiences are our priority.
            With compassionate care, state-of-the-art facilities, and a
            patient-centered approach, we're dedicated to your well-being. Trust
            us with your health and experience the difference.
          </p>
        </div>
      </div>
    </header>

    <section class="section__container service__container" id="service">
      <div class="service__header">
        <div class="service__header__content">
          <h2 class="section__header">Our Special service</h2>
          <p>
            Beyond simply providing medical care, our commitment lies in
            delivering unparalleled service tailored to your unique needs.
          </p>
        </div>
      </div>
      <div class="service__grid">
        <div class="service__card">
          <span><i class="ri-microscope-line"></i></span>
          <h4>Laboratory Test</h4>
          <p>
            Accurate Diagnostics, Swift Results: Experience top-notch Laboratory
            Testing at our facility.
          </p>
        </div>
        <div class="service__card">
          <span><i class="ri-mental-health-line"></i></span>
          <h4>Health Check</h4>
          <p>
            Our thorough assessments and expert evaluations help you stay
            proactive about your health.
          </p>
        </div>
        <div class="service__card">
          <span><i class="ri-hospital-line"></i></span>
          <h4>General Dentistry</h4>
          <p>
            Experience comprehensive oral care with Dentistry. Trust us to keep
            your smile healthy and bright.
          </p>
        </div>
      </div>
    </section>
    <section class="section__container about__container" id="about">
      <div class="about__content">
        <h2 class="section__header">About Us</h2>
        <p>
        At Salitran 2 Health Center, we provide high-quality, patient-centered healthcare services. 
        Our mission is to promote health, wellness, and disease prevention through compassionate and comprehensive care. 
        We value patient-centered care, compassion, excellence, and community engagement. 
        Our services include family medicine, specialty care, urgent care, diagnostic testing, and health education. 
        Our team of experienced healthcare professionals is dedicated to delivering exceptional care and service.
        </p>
      </div>
      <div class="about__image">
        <img src="salit.jpg" alt="about" />
      </div>
    </section>

    <section class="section__container why__container" id="blog">
      <div class="why__image">
        <img src="assets/choose-us.jpg" alt="why choose us" />
      </div>
      <div class="why__content">
        <h2 class="section__header">FAQ's</h2>
        <p>
        1. What services are offered?  Basic medical care, family planning, immunizations.<br>
        2. What are the hours? 8:00AM - 5:00PM  (Call to confirm)<br>
        3. Do I need an appointment?  Recommended, but not always required.<br>
        4. What should I bring?  Valid ID.<br>
        5. How much does it cost? Consultation is free.<br>
        6. What payments are accepted? Cash.<br>
        7. Where are you located? Brgy. Salitran II, beside of Brgy. Hall. <br>
        8. Emergency? Go to the nearest hospital.<br>
        9. How to contact? 0926-889-5281 , 0968-421-4179. <br>
        10. Health education? Yes, check about us for details.<br>
        </p>
        <div class="why__grid">
          <span><i class="ri-hand-heart-line"></i></span>
          <div>
            <h4>Intensive Care</h4>
            <p>
              Our Intensive Care Unit is equipped with advanced technology and
              staffed by team of professionals
            </p>
          </div>
          <span><i class="ri-truck-line"></i></span>
          <div>
            <h4>Free Ambulance Car</h4>
            <p>
              A compassionate initiative to prioritize your health and
              well-being without any financial burden.
            </p>
          </div>
          <span><i class="ri-hospital-line"></i></span>
          <div>
            <h4>Medical and Surgical</h4>
            <p>
              Our Medical and Surgical services offer advanced healthcare
              solutions to address medical needs.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container doctors__container" id="pages">
      <div class="doctors__header">
        <div class="doctors__header__content">
          <h2 class="section__header">Our Special Doctors</h2>
          <p>
            We take pride in our exceptional team of doctors, each a specialist
            in their respective fields.
          </p>
        </div>
        <div class="doctors__nav">
        </div>
      </div>
      <div class="doctors__grid">
        <div class="doctors__card">
          <div class="doctors__card__image">
            <img src="assets/doctor-1.jpg" alt="doctor" />
            <div class="doctors__socials">
              <span><i class="ri-instagram-line"></i></span>
              <span><i class="ri-facebook-fill"></i></span>
              <span><i class="ri-heart-fill"></i></span>
              <span><i class="ri-twitter-fill"></i></span>
            </div>
          </div>
          <h4>Dr. Lely Fauni Serria</h4>
          <p>Main Doctor/Midwife</p>
        </div>
        <div class="doctors__card">
          <div class="doctors__card__image">
            <img src="assets/doctor-2.jpg" alt="doctor" />
            <div class="doctors__socials">
              <span><i class="ri-instagram-line"></i></span>
              <span><i class="ri-facebook-fill"></i></span>
              <span><i class="ri-heart-fill"></i></span>
              <span><i class="ri-twitter-fill"></i></span>
            </div>
          </div>
          <h4>Dr. Noemi Beltran</h4>
          <p>Assistant</p>
        </div>
        <div class="doctors__card">
          <div class="doctors__card__image">
            <img src="assets/doctor-3.jpg" alt="doctor" />
            <div class="doctors__socials">
              <span><i class="ri-instagram-line"></i></span>
              <span><i class="ri-facebook-fill"></i></span>
              <span><i class="ri-heart-fill"></i></span>
              <span><i class="ri-twitter-fill"></i></span>
            </div>
          </div>
          <h4>Dr. Jennifer S. Padilla</h4>
          <p>Assistant</p>
        </div>
      </div>
    </section>

<?php include('footer.php'); ?>