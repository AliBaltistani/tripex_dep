

<?php
 
	$sid = '';
	$sTitle = '';
	$sDes = '';
	$sImages = '';
	$sTumbnail = '';
	$sType = '';
	$sExtraInfo = '';

	$pChild = "0.00";
	$pAdult = "0.00";
	$cLabel = "";
	$type = "";
	$tSlot = "0";
	$inclusion = "";
	$exclusion = "";
	$terms = "";
	$vCode = "";
	$passengers = 0;
	$baby_seats = "";
	$luggage = "";

    $mcName = '';
	$mcLabel = '';

	$subcatName = '';
	$scExtraInfo = '';
	$imgArray =  array();
	$opAdult = 0;
	$opChild= 0;
	$pChildL = '';
    $pAdultL = '';

   if (!empty($records)) {

		$sid = $records->serviceId;
		$sTitle = $records->serviceTitle;
		$sDes = $records->serviceDescription;
		$sImages = $records->serviceImages;
		$sTumbnail = $records->serviceBanner;
		$sType = $records->serviceType;
		$sExtraInfo = $records->extraInfo;

		if(!empty($records->cRow)) {
			$mcName = $records->cRow->categoryName;
			$mcLabel = $records->cRow->categoryLabel;
		}
		if(!empty($records->scRow)) {
			$subcatName = $records->scRow->subcatName;
			$scExtraInfo = $records->scRow->scExtraInfo;
			
		}		

		
		if (!empty($sImages)) {
			$imgArray = json_decode($sImages);
	    }



	if ($sExtraInfo != "") {
		$extra = json_decode($sExtraInfo);
		if (isset($extra->prices)) {
			$pChild = (int) $extra->prices->priceChild;
			$pAdult = (int) $extra->prices->priceAdult;
			$pChildL =  $extra->prices->priceChildL ??  '';
            $pAdultL = $extra->prices->priceAdultL ?? '';

// 			$pChild =  checkDiscount($pChild);
// 			$pAdult =  checkDiscount($pAdult);

         $pChild =   priceCalculator($sid,'priceCountChild');
         $pAdult =   priceCalculator($sid,'priceCountAdult');

			$opChild = (int) $extra->prices->priceChild;
			$opAdult = (int) $extra->prices->priceAdult;

			$temp_SeatOp = (object) [
				'bsLabel' => [ 0 => ''],
				'bsAges' =>  [ 0 => ''],
				'bsPrice' => [ 0 => ''],
			 ];
			   $babySeatOp  = json_decode($extra->prices->babySeats ?? json_encode($temp_SeatOp));
		}
		if (isset($extra->others)) {
			$cLabel = strtolower($extra->others->categoryLabel);
			$type = $extra->others->type;
			$tSlot = $extra->others->Totalslot;
			$inclusion = $extra->others->inclusion;
			$exclusion = $extra->others->exclusion;
			$terms = $extra->others->termsAndService;
			$vCode = $extra->others->vehicleCode;
		}
	} 
	if($scExtraInfo != ""){
		$scExtra = json_decode($scExtraInfo);
			$passengers = $scExtra->passengers;
			$baby_seats = $scExtra->baby_seats;
			$luggage = $scExtra->luggage;	
	}
	}else{
		redirect('/');
	}
?>

<style>
	.package-details-area h4 {
    color: var(--title-color);
    font-family: var(--font-rubik);
    font-size: 22px;
    font-weight: 600;
    letter-spacing: .75px;
    margin-bottom: 18px;
    padding-top: 0px;
}

  .price-area-span{
	display: flex;
    /* justify-content: center; */
    align-items: flex-end;
    color: #046e2d;
    font-family: var(--font-rubik);
    font-size: 24px;
    font-weight: 600;
    line-height: 1;
    text-transform: capitalize;
	margin: 10px 0px;
  }
  .price-area-del{
    font-size: small;
    color: rgb(197 32 32);
     font-size: 16px;
    font-weight: 600;
  }
  .form-inner input {
    width: 100%;
    border-radius: 0;
    background: #fff;
    color: var(--title-color);
    font-family: var(--font-jost);
    font-size: 12px;
    font-weight: 400;
    padding: 5px 8px;
    height: 38px;
    border: 1px solid;
}
.package-details-area .booking-form-wrap p {
    color: #dc3545;
    text-align: justify;
    font-family: var(--font-jost);
    font-size: 12px;
    font-weight: 300;
    line-height: 32px;
    margin-bottom: 0;
    border-bottom: 2px solid ;
    padding-bottom: 0px;
    margin-bottom: 0px;
}
.booking-form-wrap .sidebar-booking-form .tour-date-wrap .form-group input {
    width: 100%;
    border-radius: 5px;
    background: #fff;
    color: var(--title-color);
    font-family: var(--font-jost);
    font-size: 12px;
    font-weight: 400;
    padding: 0px 8px;
    height: 38px;
    border: 1px solid ;
}
.package-details-area h6 {
    color: #046e2d;
    font-family: var(--font-rubik);
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.48px;
    margin-bottom: 12px;
}
.mb-25 {
    margin-bottom: 12px;
}
.booking-form-wrap .sidebar-booking-form .tour-date-wrap .form-check .form-check-label::before {
    content: "";
    height: 18px;
    width: 18px;
    border: 1px solid #dc3545;
    position: absolute;
    left: -30px;
    top: 50%;
    transform: translateY(-50%);
    background-color: #dc3545;
}
.booking-form-wrap .sidebar-booking-form .tour-date-wrap .form-check .form-check-label::after {
    content: "";
    height: 12px;
    width: 12px;
    background-color:  #046e2d;
    position: absolute;
    left: -26.5px;
    top: 50%;
    transform: translateY(-50%);
}
.form-inner label {
    color: #046e2d;
    font-family: var(--font-rubik);
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
    line-height: 1;
    margin-bottom: 7px;
}

.booking-form-wrap .sidebar-booking-form .number-input-item .number-input-lable {
   
    font-weight: 600;
	font-size: 14px;

    /* gap: 100px; */
}
.booking-form-wrap .sidebar-booking-form .number-input-item .number-input-lable span {
    font-weight: 600;
}

.booking-form-wrap .sidebar-booking-form .number-input-item {
   
    margin-bottom: 12px;
}

.package-details-area h2 {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 18px;
}
</style>

<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url(<?= base_url(); ?>assets/img/innerpage/inner-banner-bg.png);">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 d-flex justify-content-center">
				<div class="banner-content">
					<h1><?= $sTitle; ?></h1>
					<ul class="breadcrumb-list">
						<li><a href="<?= base_url(); ?>">Home</a></li>
						<li>Booking Process</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($this->session->flashdata('error')) { ?>
	<div class="alert alert-danger alert-dismissable" style="position: fixed;top: 50px;right: 0px;z-index: 9999;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?php echo $this->session->flashdata('error'); ?>                    
	</div>
	<?php } ?>
	<?php if($this->session->flashdata('success')) { ?>
	<div class="alert alert-success alert-dismissable" style="position: fixed;top: 0px;right: 0px;z-index: 9999;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?php echo $this->session->flashdata('success'); ?>                    
	</div>
	<?php } ?>
<div class="package-details-area mt-120 mb-120 position-relative">
	<div class="container">
		<div class="row">
			<div class="co-lg-12">
				<div class="package-img-group mb-50">
					<div class="row align-items-center g-3">
						<div class="col-lg-6">
							<div class="gallery-img-wrap">
								<img src="<?= base_url($sTumbnail); ?>" alt>
								<a data-fancybox="gallery-01" href="<?= base_url($sTumbnail); ?>"><i class="bi bi-eye"></i></a>
							</div>
						</div>
						<?php 
						// echo '<pre>'; print_r($imgArray);die;
						 if (!empty($imgArray)) { ?>
							<div class="col-lg-6 h-100">
								<div class="row g-3 h-100">
									<?php if (!empty($imgArray)) {
										if (isset($imgArray->data) && isset($imgArray->data[0])) { ?>
											<div class="col-6">
												<div class="gallery-img-wrap">
													<img src="<?= base_url($imgArray->data[0]); ?>" alt>
													<a data-fancybox="gallery-01" href="<?= base_url($imgArray->data[0]); ?>"><i class="bi bi-eye"></i></a>
												</div>
											</div>
									<?php }
									} ?>

									<?php if (!empty($imgArray)) {
										if (isset($imgArray->data) && isset($imgArray->data[1])) { ?>
											<div class="col-6">
												<div class="gallery-img-wrap">
													<img src="<?= base_url($imgArray->data[1]); ?>" alt>
													<a data-fancybox="gallery-01" href="<?= base_url($imgArray->data[1]); ?>"><i class="bi bi-eye"></i></a>
												</div>
											</div>
									<?php }
									} ?>

									<?php if (!empty($imgArray)) {
										if (isset($imgArray->data) && isset($imgArray->data[2])) { ?>
											<div class="col-6">
												<div class="gallery-img-wrap active">
													<img src="<?= base_url($imgArray->data[2]); ?>" alt>
													<button class="StartSlideShowFirstImage"><i class="bi bi-plus-lg"></i> View More Images</button>
												</div>
											</div>
									<?php }
									} ?>
									<!-- <div class="col-6">
                    <div class="gallery-img-wrap active">
                      <img src="<?= base_url(); ?>assets/img/innerpage/package-05.jpg" alt>
                      <a data-fancybox="gallery-01" href="https://www.youtube.com/watch?v=u31qwQUeGuM"><i class="bi bi-play-circle"></i> Watch Video</a>
                    </div>
                  </div> -->
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="others-image-wrap d-none">
			<?php
			if (!empty($imgArray)) {
				if (isset($imgArray->data)) {
					foreach ($imgArray->data as $imgs) {
			?>
						<a href="<?= base_url($imgs); ?>" data-fancybox="images"><img src="<?= base_url($imgs); ?>" alt></a>
			<?php }
				}
			} ?>
		</div>
		<div class="row g-xl-4 gy-5">
			<div class="col-xl-8">
				<h2><?= ucwords($sTitle); ?></h2>
				<hr>
				<div class="">
				  <?= priceCalculator($sid,'pricehtml'); ?>
				</div>
				<hr>
			
				<h4>Overview</h4>
				<p><?= $sDes; ?></p>

				<h4>Included</h4>
				<div class="includ-and-exclud-area mb-20">
					<p><?= $inclusion; ?></p>
				</div>
				<h4>Excluded</h4>
				<div class="includ-and-exclud-area mb-20">
					<p><?= $exclusion; ?></p>
				</div>
				<div class="highlight-tour mb-20">
					<h4>Terms & Services</h4>
					<p><?= $terms; ?></p>
				</div>

			</div>
			<div class="col-xl-4"  id="booking-form">
				<?php 
				if($cLabel == ATTRACTION)
				{ include('attraction_booking.php'); }
				else if($cLabel == TRANSPORT) 
				{include('transport_booking.php'); }
				else{
					echo "<h2>Invalid Booking Info.. Please try agian</h2>";
				}
				
				?>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo base_url(); ?>assets/admin/js/jQuery-2.1.4.min.js" type="text/javascript"></script>



