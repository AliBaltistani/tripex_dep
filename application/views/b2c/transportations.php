<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url(<?= base_url() ?>assets/img/innerpage/inner-banner-bg.png);">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center">
        <div class="banner-content">
          <h1><?= (isset($recordsCategory->categoryName)) ? $recordsCategory->categoryName : "TOP TRANSPORTATIONS"; ?></h1>
          <ul class="breadcrumb-list">
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li>Transportation</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="package-search-filter-wrapper">
  <div class="container">
    <div class="filter-group">
      <form action="#0">
        <div class="filter-area">
          <div class="row g-xl-4 gy-4">
              <div class="col-xl-3 col-sm-6 d-flex justify-content-center">
                  </div>
                   <div class="col-xl-9 col-sm-6 d-flex ">
              <h2>Search Your <?= (isset($recordsCategory->categoryName)) ? $recordsCategory->categoryName : "Transportations"; ?></h2>
              </div>
            <div class="col-xl-3 col-sm-6 d-flex justify-content-center">
              <div class="single-search-box">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27">
                    <path d="M18.0075 17.8392C20.8807 13.3308 20.5195 13.8933 20.6023 13.7757C21.6483 12.3003 22.2012 10.5639 22.2012 8.75391C22.2012 3.95402 18.3062 0 13.5 0C8.7095 0 4.79883 3.94622 4.79883 8.75391C4.79883 10.5627 5.3633 12.3446 6.44361 13.8399L8.99237 17.8393C6.26732 18.2581 1.63477 19.506 1.63477 22.2539C1.63477 23.2556 2.28857 24.6831 5.40327 25.7955C7.57814 26.5722 10.4536 27 13.5 27C19.1966 27 25.3652 25.3931 25.3652 22.2539C25.3652 19.5055 20.7381 18.2589 18.0075 17.8392ZM7.76508 12.9698C7.75639 12.9562 7.7473 12.9428 7.73782 12.9298C6.83886 11.6931 6.38086 10.2274 6.38086 8.75391C6.38086 4.79788 9.56633 1.58203 13.5 1.58203C17.4255 1.58203 20.6191 4.7993 20.6191 8.75391C20.6191 10.2297 20.1698 11.6457 19.3195 12.8498C19.2432 12.9503 19.6408 12.3327 13.5 21.9686L7.76508 12.9698ZM13.5 25.418C7.27766 25.418 3.2168 23.589 3.2168 22.2539C3.2168 21.3566 5.30339 19.8811 9.92714 19.306L12.8329 23.8656C12.9044 23.9777 13.0029 24.0701 13.1195 24.134C13.2361 24.198 13.367 24.2315 13.4999 24.2315C13.6329 24.2315 13.7638 24.198 13.8804 24.134C13.9969 24.0701 14.0955 23.9777 14.167 23.8656L17.0727 19.306C21.6966 19.8811 23.7832 21.3566 23.7832 22.2539C23.7832 23.5776 19.7589 25.418 13.5 25.418Z" />
                    <path d="M13.5 4.79883C11.3192 4.79883 9.54492 6.57308 9.54492 8.75391C9.54492 10.9347 11.3192 12.709 13.5 12.709C15.6808 12.709 17.4551 10.9347 17.4551 8.75391C17.4551 6.57308 15.6808 4.79883 13.5 4.79883ZM13.5 11.127C12.1915 11.127 11.127 10.0624 11.127 8.75391C11.127 7.44541 12.1915 6.38086 13.5 6.38086C14.8085 6.38086 15.873 7.44541 15.873 8.75391C15.873 10.0624 14.8085 11.127 13.5 11.127Z" />
                  </svg>
                </div>
                <div class="searchbox-input">
                  <label>Destination</label>
                  <div class="custom-select-dropdown">
                    <div class="select-input">
                      <input type="text" readonly value="DUBAI">
                      <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="custom-select-wrap">
                      <div class="custom-select-search-area">
                        <i class="bx bx-search"></i>
                        <input type="text" placeholder="Type Your Destination">
                      </div>
                      <ul class="option-list">
                        <li>
                          <div class="destination">
                            <h6>DUBAI</h6>
                            <p>Top Transportations, Best Prices</p>
                          </div>
                          <div class="tour">
                            <span><?php if (isset($records)) {
                                    echo count($records);
                                  } ?> <br> Tour</span>
                          </div>
                        </li>

                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-sm-6 d-flex justify-content-center">
                
              <div class="single-search-box">
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                  </svg>

                </div>
                <div class="searchbox-input">
                  <div class="custom-select-dropdown">
                    <div class="custom-select-search-area">
                      
                      <input type="text" name="searchTxt" id="search_input" class="searchlist" value="<?= (isset($searchTxt)) ? $searchTxt : ""; ?>" placeholder="Search your transport here" style="font-size: 16px;
    font-weight: 600;">
                      <input type="hidden" name="srTypeId" value="<?= $mcId; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            

          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="package-top-search-section mt-4 mb-120">
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <div id="loadingSpinner" class="spinner-border text-primary d-none" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div id="noRecords" class="text-primary d-none">
          <h2>No records found</h2>
        </div>
      </div>
    </div>
    <div id="orignalData" class="row ">

      <?php
      foreach ($records as $record) {
        $scId = $record->subcatId;
        $scTitle = $record->subcatName;
        $scDes = $record->subcatDescription;
        $scImg = $record->subcatImage;
        $mcId = $record->maincatId;
        $scExtra = $record->extraInfo;
        $scStatus = $record->isPublished;
        if ($scExtra != "") {
          $extra = json_decode($scExtra);
          $passengers = $extra->passengers;
          $baby_seats = $extra->baby_seats;
          $luggage = $extra->luggage;
        } else {
          $passengers = "0";
          $baby_seats = "0";
          $luggage = "0";
        }
      ?>
        <div class="col-lg-4 col-md-6 my-3">
          <div class="package-card">
            <div class="package-card-img-wrap">
              <a href="<?= base_url('b2c/transportations/types?m=' . "$mcId" . "&sc=" . $scId); ?>" class="card-img"><img src="<?= base_url($scImg) ?>" alt="<?= $scTitle; ?>"></a>
              <div class="batch">
                <!-- <span class="date">3 Days / 4 Night</span> -->
                <div class="location">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M8.99939 0C5.40484 0 2.48047 2.92437 2.48047 6.51888C2.48047 10.9798 8.31426 17.5287 8.56264 17.8053C8.79594 18.0651 9.20326 18.0646 9.43613 17.8053C9.68451 17.5287 15.5183 10.9798 15.5183 6.51888C15.5182 2.92437 12.5939 0 8.99939 0ZM8.99939 9.79871C7.19088 9.79871 5.71959 8.32739 5.71959 6.51888C5.71959 4.71037 7.19091 3.23909 8.99939 3.23909C10.8079 3.23909 12.2791 4.71041 12.2791 6.51892C12.2791 8.32743 10.8079 9.79871 8.99939 9.79871Z" />
                  </svg>
                  <ul class="location-list">
                    <li><a href="<?= base_url('b2c/transportations/types/?m=' . "$mcId" . "&sc=" . $scId); ?>">Dubai</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="package-card-content text-center">
              <div class="card-content-top">
                <h5><a href="<?= base_url('b2c/transportations/types?m=' . "$mcId" . "&sc=" . $scId); ?>"><?= $scTitle; ?></a></h5>
                <div class="location-area" style="height: 45px;">
                  <ul class="location-list scrollTextAni">

                    <li><a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                          <path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z" />
                        </svg>
                        <br><strong><?= $passengers ?></strong> Passangers</a></li>
                    <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                          <path d="M176 56V96H336V56c0-4.4-3.6-8-8-8H184c-4.4 0-8 3.6-8 8zM128 96V56c0-30.9 25.1-56 56-56H328c30.9 0 56 25.1 56 56V96v32V480H128V128 96zM64 96H96V480H64c-35.3 0-64-28.7-64-64V160c0-35.3 28.7-64 64-64zM448 480H416V96h32c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64z" />
                        </svg>
                        <br><strong><?= $luggage ?></strong> Luggage</a></li>
                    <?php if ($baby_seats == "1") { ?>
                      <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M152 88a72 72 0 1 1 144 0A72 72 0 1 1 152 88zM39.7 144.5c13-17.9 38-21.8 55.9-8.8L131.8 162c26.8 19.5 59.1 30 92.2 30s65.4-10.5 92.2-30l36.2-26.4c17.9-13 42.9-9 55.9 8.8s9 42.9-8.8 55.9l-36.2 26.4c-13.6 9.9-28.1 18.2-43.3 25V288H128V251.7c-15.2-6.7-29.7-15.1-43.3-25L48.5 200.3c-17.9-13-21.8-38-8.8-55.9zm89.8 184.8l60.6 53-26 37.2 24.3 24.3c15.6 15.6 15.6 40.9 0 56.6s-40.9 15.6-56.6 0l-48-48C70 438.6 68.1 417 79.2 401.1l50.2-71.8zm128.5 53l60.6-53 50.2 71.8c11.1 15.9 9.2 37.5-4.5 51.2l-48 48c-15.6 15.6-40.9 15.6-56.6 0s-15.6-40.9 0-56.6L284 419.4l-26-37.2z" />
                          </svg>
                          <br> Baby Seats</a></li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <div class="card-content-bottom ">
                <!-- <div class="price-area">   
                  <h6>Starting Form:</h6>
                  <span>$2,898 <del>$3000</del></span>
                  <p>TAXES INCL/PERS</p>
                </div> -->
                <a href="<?= base_url('b2c/transportations/types/?m=' . "$mcId" . "&sc=" . $scId); ?>" class="primary-btn2">Book Now
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M8.15624 10.2261L7.70276 12.3534L5.60722 18L6.85097 17.7928L12.6612 10.1948C13.4812 10.1662 14.2764 10.1222 14.9674 10.054C18.1643 9.73783 17.9985 8.99997 17.9985 8.99997C17.9985 8.99997 18.1643 8.26211 14.9674 7.94594C14.2764 7.87745 13.4811 7.8335 12.6611 7.80518L6.851 0.206972L5.60722 -5.41705e-07L7.70276 5.64663L8.15624 7.77386C7.0917 7.78979 6.37132 7.81403 6.37132 7.81403C6.37132 7.81403 4.90278 7.84793 2.63059 8.35988L0.778036 5.79016L0.000253424 5.79016L0.554115 8.91458C0.454429 8.94514 0.454429 9.05483 0.554115 9.08539L0.000253144 12.2098L0.778036 12.2098L2.63059 9.64035C4.90278 10.1523 6.37132 10.1857 6.37132 10.1857C6.37132 10.1857 7.0917 10.2102 8.15624 10.2261Z" />
                    <path d="M12.0703 11.9318L12.0703 12.7706L8.97041 12.7706L8.97041 11.9318L12.0703 11.9318ZM12.0703 5.23292L12.0703 6.0714L8.97059 6.0714L8.97059 5.23292L12.0703 5.23292ZM9.97892 14.7465L9.97892 15.585L7.11389 15.585L7.11389 14.7465L9.97892 14.7465ZM9.97892 2.41846L9.97892 3.2572L7.11389 3.2572L7.11389 2.41846L9.97892 2.41846Z" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <!-- <div class="row">
      <div class="col-lg-12">
        <nav class="inner-pagination-area">
          <ul class="pagination-list">
            <li>
              <a href="#" class="shop-pagi-btn"><i class="bi bi-chevron-left"></i></a>
            </li>
            <li>
              <a href="#">1</a>
            </li>
            <li>
              <a href="#" class="active">2</a>
            </li>
            <li>
              <a href="#">3</a>
            </li>
            <li>
              <a href="#"><i class="bi bi-three-dots"></i></a>
            </li>
            <li>
              <a href="#">6</a>
            </li>
            <li>
              <a href="#" class="shop-pagi-btn"><i class="bi bi-chevron-right"></i></a>
            </li>
          </ul>
        </nav>
      </div>
    </div> -->
  </div>
</div>


<div class="banner3-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner3-content">
          <h2>Join The Newsletter</h2>
          <p>To receive our best monthly deals</p>
          <form>
            <div class="from-inner">
              <input type="email" placeholder="Enter Your Gmail...">
              <button type="submit" class="from-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17">
                  <path d="M7 1L16 8.5M16 8.5L7 16M16 8.5H0.5" stroke-width="1.5" />
                </svg>
              </button>
            </div>
          </form>
          <img src="<?= base_url() ?>assets/img/home1/banner3-vector1.png" alt class="vector1">
          <img src="<?= base_url() ?>assets/img/home1/banner3-vector2.png" alt class="vector2">
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <script src="<?php echo base_url(); ?>assets/admin/js/jQuery-2.1.4.min.js" type="text/javascript"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/jQuery-2.1.4.min.js"></script>

<script>
  $(document).ready(function() {

    var baseURL = "<?= base_url(); ?>";
    $('#search_input').keyup(function() {

      var query = $(this).val();
      var mcid = "<?= $mcId; ?>";
      if (query.length >= 1) {
        $.ajax({
          url: '<?= base_url() ?>B2C/fliter_services', // URL to the server-side script for handling search
          method: 'POST',
          data: {
            query: query,
            mcid: mcid
          },
          beforeSend: function() {
            $('#loadingSpinner').removeClass('d-none');
          },
          success: function(response) {
            var jsonObject = JSON.parse(response);
            var cardContainer = $('#orignalData');

            $('#loadingSpinner').addClass('d-none');;

            // Clear existing cards in the container
            cardContainer.empty();
            // Iterate over the data and create a card for each item
            $.each(jsonObject, function(index, item) {
              // $('#orignalData').hide();
              var mcid = item.maincatId;
              var scid = item.subcatId;
              var booking_url = baseURL + "b2c/transportations/types?m=" + mcid + "&sc=" + scid

              var exrtaInfo = JSON.parse(item.extraInfo);
              var luggage = exrtaInfo.luggage;
              var baby_seats = exrtaInfo.baby_seats;
              var passengers = exrtaInfo.passengers;

              var cardHtml = '<div class="col-lg-4 col-md-6">';
              cardHtml += '<div class="package-card">';
              cardHtml += '<div class="package-card-img-wrap">';
              cardHtml += '<a href="" class="card-img"><img src="' + baseURL + item.subcatImage + '" alt=""></a>';
              cardHtml += '<div class="batch">';
              cardHtml += '<div class="location">';
              cardHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">';
              cardHtml += '<path d="M8.99939 0C5.40484 0 2.48047 2.92437 2.48047 6.51888C2.48047 10.9798 8.31426 17.5287 8.56264 17.8053C8.79594 18.0651 9.20326 18.0646 9.43613 17.8053C9.68451 17.5287 15.5183 10.9798 15.5183 6.51888C15.5182 2.92437 12.5939 0 8.99939 0ZM8.99939 9.79871C7.19088 9.79871 5.71959 8.32739 5.71959 6.51888C5.71959 4.71037 7.19091 3.23909 8.99939 3.23909C10.8079 3.23909 12.2791 4.71041 12.2791 6.51892C12.2791 8.32743 10.8079 9.79871 8.99939 9.79871Z" /></svg>';
              cardHtml += '<ul class="location-list">';
              cardHtml += '<li><a href="">Dubai</a></li>';
              cardHtml += '</ul>';
              cardHtml += '</div>';
              cardHtml += '</div>';
              cardHtml += '</div>';
              cardHtml += '<div class="package-card-content text-center">';
              cardHtml += '<div class="card-content-top">';
              cardHtml += '<h5><a href="' + booking_url + '" >' + item.subcatName + '</a></h5>';
              cardHtml += '<div class="location-area" style="height: 45px;">';
              cardHtml += '<ul class="location-list scrollTextAni">';
              cardHtml += '<li><a href="#">';
              cardHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M72 88a56 56 0 1 1 112 0A56 56 0 1 1 72 88zM64 245.7C54 256.9 48 271.8 48 288s6 31.1 16 42.3V245.7zm144.4-49.3C178.7 222.7 160 261.2 160 304c0 34.3 12 65.8 32 90.5V416c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V389.2C26.2 371.2 0 332.7 0 288c0-61.9 50.1-112 112-112h32c24 0 46.2 7.5 64.4 20.3zM448 416V394.5c20-24.7 32-56.2 32-90.5c0-42.8-18.7-81.3-48.4-107.7C449.8 183.5 472 176 496 176h32c61.9 0 112 50.1 112 112c0 44.7-26.2 83.2-64 101.2V416c0 17.7-14.3 32-32 32H480c-17.7 0-32-14.3-32-32zm8-328a56 56 0 1 1 112 0A56 56 0 1 1 456 88zM576 245.7v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM320 32a64 64 0 1 1 0 128 64 64 0 1 1 0-128zM240 304c0 16.2 6 31 16 42.3V261.7c-10 11.3-16 26.1-16 42.3zm144-42.3v84.7c10-11.3 16-26.1 16-42.3s-6-31.1-16-42.3zM448 304c0 44.7-26.2 83.2-64 101.2V448c0 17.7-14.3 32-32 32H288c-17.7 0-32-14.3-32-32V405.2c-37.8-18-64-56.5-64-101.2c0-61.9 50.1-112 112-112h32c61.9 0 112 50.1 112 112z"/></svg><br><strong>' + passengers + '</strong> Passangers</a></li>';
              cardHtml += '<li><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M176 56V96H336V56c0-4.4-3.6-8-8-8H184c-4.4 0-8 3.6-8 8zM128 96V56c0-30.9 25.1-56 56-56H328c30.9 0 56 25.1 56 56V96v32V480H128V128 96zM64 96H96V480H64c-35.3 0-64-28.7-64-64V160c0-35.3 28.7-64 64-64zM448 480H416V96h32c35.3 0 64 28.7 64 64V416c0 35.3-28.7 64-64 64z"/></svg><br><strong>' + luggage + '</strong> Luggage</a></li>';
              if (baby_seats == "1") {
                cardHtml += '<li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M152 88a72 72 0 1 1 144 0A72 72 0 1 1 152 88zM39.7 144.5c13-17.9 38-21.8 55.9-8.8L131.8 162c26.8 19.5 59.1 30 92.2 30s65.4-10.5 92.2-30l36.2-26.4c17.9-13 42.9-9 55.9 8.8s9 42.9-8.8 55.9l-36.2 26.4c-13.6 9.9-28.1 18.2-43.3 25V288H128V251.7c-15.2-6.7-29.7-15.1-43.3-25L48.5 200.3c-17.9-13-21.8-38-8.8-55.9zm89.8 184.8l60.6 53-26 37.2 24.3 24.3c15.6 15.6 15.6 40.9 0 56.6s-40.9 15.6-56.6 0l-48-48C70 438.6 68.1 417 79.2 401.1l50.2-71.8zm128.5 53l60.6-53 50.2 71.8c11.1 15.9 9.2 37.5-4.5 51.2l-48 48c-15.6 15.6-40.9 15.6-56.6 0s-15.6-40.9 0-56.6L284 419.4l-26-37.2z"/></svg><br> Baby Seats</a></li>';
              }
              cardHtml += '</ul>';
              cardHtml += '</div>';
              cardHtml += '</div>';
              cardHtml += '<div class="card-content-bottom ">';
              cardHtml += '<a href="' + booking_url + '" class="primary-btn2">Book Now';
              cardHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">';
              cardHtml += '<path d="M8.15624 10.2261L7.70276 12.3534L5.60722 18L6.85097 17.7928L12.6612 10.1948C13.4812 10.1662 14.2764 10.1222 14.9674 10.054C18.1643 9.73783 17.9985 8.99997 17.9985 8.99997C17.9985 8.99997 18.1643 8.26211 14.9674 7.94594C14.2764 7.87745 13.4811 7.8335 12.6611 7.80518L6.851 0.206972L5.60722 -5.41705e-07L7.70276 5.64663L8.15624 7.77386C7.0917 7.78979 6.37132 7.81403 6.37132 7.81403C6.37132 7.81403 4.90278 7.84793 2.63059 8.35988L0.778036 5.79016L0.000253424 5.79016L0.554115 8.91458C0.454429 8.94514 0.454429 9.05483 0.554115 9.08539L0.000253144 12.2098L0.778036 12.2098L2.63059 9.64035C4.90278 10.1523 6.37132 10.1857 6.37132 10.1857C6.37132 10.1857 7.0917 10.2102 8.15624 10.2261Z" />';
              cardHtml += '<path d="M12.0703 11.9318L12.0703 12.7706L8.97041 12.7706L8.97041 11.9318L12.0703 11.9318ZM12.0703 5.23292L12.0703 6.0714L8.97059 6.0714L8.97059 5.23292L12.0703 5.23292ZM9.97892 14.7465L9.97892 15.585L7.11389 15.585L7.11389 14.7465L9.97892 14.7465ZM9.97892 2.41846L9.97892 3.2572L7.11389 3.2572L7.11389 2.41846L9.97892 2.41846Z" />';
              cardHtml += '</svg>';
              cardHtml += '</a>';
              cardHtml += '</div>';
              cardHtml += '</div>';
              cardHtml += '</div>';
              cardHtml += '</div>';

              // cardContainer.fadeIn(5000).append(cardHtml);
              $(cardHtml).hide().appendTo('#orignalData').fadeIn(1000);
            });
            // Hide loading spinner after data is loaded

          },
          error: function(xhr, status, error) {
            console.error(error); // Log any errors to console
            // Hide loading spinner after data is loaded
            $('#loadingSpinner').hide();
          }
        });
      }
    });
  });
</script>