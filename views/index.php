<?php 
$title = "HomePage";
include("./inc/header.php"); 
?>
<div class="index-container">
    <div class="carousel-container">
        <div id="indexCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="carousel-item-1 d-block w-100">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-item-2 d-block w-100"></div>
                </div>
                <div class="carousel-item">
                    <div class="carousel-item-3 d-block w-100"></div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#indexCarousel" data-bs-slide="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#b2b2b2" class="bi bi-caret-left-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#indexCarousel" data-bs-slide="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#b2b2b2" class="bi bi-caret-right-fill"
                    viewBox="0 0 16 16">
                    <path
                        d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                </svg>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container index-links-container">
        <div class="row">
            <div class="col col-lg-3 col-md-5 col-sm-9 index-link-container index-link-1">
                <a href="./shop">
                    <div class="index-link-box">
                        <h5>Women</h5>
                        <p class="index-link-text">Summer 2022</p>
                        <div class="index-link-trans">
                            <h5 class="index-link-trans-text">SHOP NOW</h5>
                            <div class="index-link-trans-line"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-lg-3 col-md-5 col-sm-9 index-link-container index-link-2">
                <a href="./shop">
                    <div class="index-link-box">
                        <h5>Men</h5>
                        <p>Summer 2022</p>
                        <div class="index-link-trans">
                            <h5 class="index-link-trans-text">SHOP NOW</h5>
                            <div class="index-link-trans-line"></div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col col-lg-3 col-md-5 col-sm-9 index-link-container index-link-3">
                <a href="./shop">
                    <div class="index-link-box">
                        <h5>Accessories</h5>
                        <p>New Trend</p>
                        <div class="index-link-trans">
                            <h5 class="index-link-trans-text">SHOP NOW</h5>
                            <div class="index-link-trans-line"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
<?php include("./inc/footer.php");
?>

<script>
scriptByPage("sitas");
</script>