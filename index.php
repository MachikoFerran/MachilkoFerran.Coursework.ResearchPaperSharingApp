<?php
//Main Page Structure

require_once("header.php");
?>



<div class="indexbg">
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel"
         style="width: 950px; height: 450px; margin: 25px auto; ">
        <div class="carousel-inner">
            <div class="carousel-item active" data-interval="10000">
                <img src="images/slider-paper1.jpg" class="d-block w-100" alt="slider-paper1" id="car-image"
                     style="width: 100%">
            </div>
            <div class="carousel-item" data-interval="2000">
                <img src="images/slider-paper2.jpg" class="d-block w-100" alt="slider-paper1" id="car-image"
                     style="width: 100%">
            </div>
            <div class="carousel-item">
                <img src="images/slider-paper3.jpg" class="d-block w-100" alt="slider-paper1" id="car-image"
                     style="width: 100%">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div style="display: flex; align-items: center; justify-content: center; margin: 0;">
    <p style="m10-auto; font-family: Verdana, sans-serif; font-weight: 800; margin: 3px 10px; text-align: center; ">Welcome to  the new Research Paper Sharing System. It is still in beta-testing phase but we hope that this system can be helpful for your works.</p>
    </div>
</div>


</body>

<?php

//Footer Connection
require_once("footer.php");
?>
