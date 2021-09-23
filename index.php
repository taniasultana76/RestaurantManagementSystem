<?php
  include("dbconnection.php");
  ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="cssi/css/styles.css">
        <title>FOS-homepage</title>
    </head>
    <body 
            style="background-image:linear-gradient(rgba(0,0,0,0.9),rgba(1,1,1,0.5)),url(cssi/img/d1.jpg);
            height:auto;
            background-size:cover;
            background-position:center;">

        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bx-chevron-up scrolltop__icon'></i>
        </a>

      
        <header class="l-header" id="header" style="background-color:#B7FFBF">

            <nav class="nav bd-container">
                <a href="#" class="nav__logo" style="font-family:'Brush Script MT', cursive;font-size: 30px;color: DarkRed"><b>Tania'S Dine <i class="fas fa-utensils"></i></b></a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="#home" class="nav__link active-link" style="color: green">Home</a>
                        </li>

                        <li class="nav__item"><a href="menu/login_food.php" class="nav__link">Order</a></li>
                        <li class="nav__item"><a href="book.php" class="nav__link">Booking</a>
                        </li>
                          
                        <li class="nav__item"><a href="staff/login.php" class="nav__link">Staff</a></li>
                        <li class="nav__item"><a href="admin/login.php" class="nav__link">Admin</a></li>
                        
                        
                    </ul>
                </div>

                
            </nav>
        </header>

        <main class="l-main">
           
            <section class="home" id="home">
                <div class="home__container bd-container bd-grid">
                    <div class="home__data">
                        <h1 class="home__title">Welcome To you</h1>
                        <h3 class="home__subtitle" style="color:white">A Crazy place for crazy foody <br> Heart of Perfect Food Hangout!</h3>
                        
                         <a href="reg.php" class="button">Sing-up</a>
                         <a href="#menu" class="button">Menu</a>
                    </div>
    
                    <img src="cssi/img/home.png" alt="" class="home__img">
                </div>
            </section>
            
            <section class="about section bd-container" id="about">
                <div class="about__container  bd-grid">
                    <div class="about__data">
                        <span class="section-subtitle about__initial" style="font-size: 25px;color:white;">About us</span>
                        <h2 class="section-title about__initial" style="color:white">We cook the best <br> tasty food</h2>
                        <p class="about__description" style="color:white">We cook the best food in the entire city, with excellent customer service, the best meals and at the best price, visit us.</p>
                        <a href="#" class="button">Explore history</a>
                    </div>

                    <img src="cssi/img/d.jpg" alt="" class="about__img">
                </div>
            </section>

            <section class="services section bd-container" id="services">
                <span class="section-subtitle"></span>
                <h2 class="section-title" style="color:white">Our amazing services</h2>

                <div class="services__container  bd-grid">
                    <div class="services__content">
                        
                        <h3 class="services__title" style="color:white">Excellent food</h3>
                   <i class="fas fa-wine-glass"  style="font-size: 50px"></i>
                        <p class="services__description" style="color:white">Our chefs understand that the secret of good taste and the freshness of the ingredients and creating a harmionious combination of tastes.</p>
                    </div>

                    <div class="services__content">
                        
                        <h3 class="services__title" style="color:white">Table reservation</h3>
                        <i class="fas fa-edit" style="font-size: 50px"></i>
                        <p class="services__description" style="color:white">We offer our clients excellent quality services for many years, with the best and delicious food in the city.</p>
                    </div>

                    <div class="services__content">
                       
                        <h3 class="services__title" style="color:white">Fast Delivery</h3>
                        <i class="fas fa-truck"  style="font-size: 50px"></i>
                        <p class="services__description" style="color:white">You can order from here delicious and healthy food for your family and friends and We will provide you in a short time with your expectations.</p>
                    </div>
                </div>
            </section>

           
            <section class="menu section bd-container" id="menu">
                <span class="section-subtitle"></span>
                <h2 class="section-title" style="color:white">Special Menu of the week </h2>


                



                <div class="menu__container bd-grid">

                     <?php
        $server= 'localhost';
        $user= 'root';
        $password= '';
        $db= 'fosdb';
  
       $con = mysqli_connect($server,$user,$password,$db);
       $query = "SELECT * FROM tbl_menuitem LIMIT 3";
       $query_run = mysqli_query($con, $query);
       $check = mysqli_num_rows($query_run) > 0;

       if( $check)
       {
        while($row= mysqli_fetch_array($query_run))
        {
            $id = $row['itemID'];
            $name = $row['menuItemName'];
            $price = $row['price'];
            $img = $row['img'];

        ?>

                    <div class="menu__content" style="">

                        <img src="cssi/img/<?php echo $img; ?>" alt="" class="menu__img">
                        <h3 class="menu__name"><?php echo $name; ?></h3>
                        <span class="menu__detail">Delicious Item</span>
                        <span class="menu__preci"><?php echo $price; ?></span>
                        <a href="menu/login_food.php" class="button menu__button">order</a>
                     
                    </div>
                    
 <?php
       }
       }
       else
       {
        echo "No data";
       }
       ?>
                  
                </div>
               
                
            </section>
            

           
            <section class="app section bd-container" id="book">
                <div class="app__container bd-grid">
                    <div class="app__data">
                        <span class="section-subtitle app__initial"></span>
                        <h2 class="section-title app__initial" style="color:white">Reservation</h2>
                        <p class="app__description" style="color:white">If you want to reserve a table in our restaurant, contact us and we will attend you quickly, with our amezing service.</p>
                        <div class="app__stores">
                            <a href="book.php" class="app__store">Booking</a>
                            <a href="menu/login_food.php" class="app__store">Order</a>
                        </div>
                    </div>

                    <img src="cssi/img/s.jpg" alt="" class="app__img">
                </div>
            </section>

            <section class="contact section bd-container" id="contact">
                <div class="contact__container bd-grid">
                    <div class="contact__data">
                        <span class="section-subtitle contact__initial"></span>
                        <h2 class="section-title contact__initial" style="color:white">Contact us</h2>
                        <p class="contact__description" style="color:white">If you want to know any information or any kind of problem you can contact us.We will response within 2 hours/ call us  01721-768843  <i class="fas fa-phone"></i></p>
                    </div>

                    <div class="contact__button">
                        <input type="text" name="" style="height: 35px;width: 120%"
                        placeholder=" enter your name......">&nbsp;
                        <input type="text" name="" style="height: 35px;width: 120%"
                        placeholder=" enter your phone-no......">&nbsp;
                        <input type="text" name="" style="height: 40px;width: 120%"
                        placeholder=" enter your email......">&nbsp;
                        <textarea  name="" style="height: 35px;width: 120%"
                        placeholder=" message to us......"></textarea><br><br>
                        <a href="#" class="button">Contact us now</a>
                    </div>
                </div>
            </section>
        </main>

       
        <footer class="footer section bd-container">
            <div class="footer__container bd-grid">
                <div class="footer__content">
                    <a href="#" class="footer__logo" style="font-family:'Brush Script MT', cursive;font-size: 30px;color:DarkRed">Tania'S Dine <i class="fas fa-utensils"></i></a>
                    <span class="footer__description" style="color:white">For crazy foody hangout!</span>
                    <div>
                        <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                        <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
                    </div>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title" style="color:white">Services</h3>
                    <ul>
                        <li><a href="#" class="footer__link" style="color:white">Delivery</a></li>
                        <li><a href="#" class="footer__link" style="color:white">Pricing</a></li>
                        <li><a href="#" class="footer__link" style="color:white">Fast food</a></li>
                        <li><a href="#" class="footer__link" style="color:white">Reserve your spot</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title" style="color:white">Information</h3>
                    <ul>
                        <li><a href="#" class="footer__link" style="color:white">Event</a></li>
                        <li><a href="#" class="footer__link" style="color:white">Contact us</a></li>
                        <li><a href="#" class="footer__link" style="color:white">Privacy policy</a></li>
                        <li><a href="#" class="footer__link" style="color:white">Terms of services</a></li>
                    </ul>
                </div>

                <div class="footer__content">
                    <h3 class="footer__title" style="color:white">Adress</h3>
                    <ul>
                        <li style="color:white">Malibag,Dhaka-1217</li>
                        <li style="color:white">Dhaka,Bangladesh</li>
                        <li style="color:white">01721-768843</li>
                        <li style="color:white">taniasdine@gmail.com</li>
                    </ul>
                </div>
            </div>

            <p class="footer__copy">&#169;Copyright©FoodOrderingSystembyTaniaSultana</p>
        </footer>

        
    </body>
</html>