
<style>
  .price-area-span{
    color: #046e2d;
    font-family: var(--font-rubik);
    font-size: 24px;
    font-weight: 600;
    line-height: 1;
    display: inline-block;
    text-transform: capitalize;
  }
  .price-area-del{
    font-size: small;
    color: rgb(197 32 32);
     font-size: 16px;
    font-weight: 600;
  }
</style>

<div class="package-top-search-section pt-120 mb-120">
    <div class="container">
      <div class="row gy-5 mb-70">
        <div class="col-lg-12">

        <?php 
          // $srExtra = json_decode($records[0]->extraInfo);
          // pre($srExtra);
          // die;
           $pChild = "0.00";$pAdult = "0.00";$cLabel = "";$type = "";$tSlot = "0";$inclusion = "";$exclusion = "";$terms = "";
           $opChild = 0.00;
           $opAdult = 0.00;
           $pChildL = '';
           $pAdultL = '';
           
           foreach($records as $record){ 
            $srId = $record->serviceId;
            $srTitle = $record->serviceTitle;
            $srDes = $record->serviceDescription;
            $srBanner = $record->serviceBanner;
            $srImg = $record->serviceImages;
            $srType = $record->serviceType;
            $srExtra = $record->extraInfo;  

            if($srExtra != ""){
              $extra = json_decode($srExtra);
              if(isset($extra->prices)){
                $pChild = $extra->prices->priceChild;
                $pAdult = $extra->prices->priceAdult;
                $pChildL =  $extra->prices->priceChildL ??  '';
                $pAdultL = $extra->prices->priceAdultL ?? '';
                // $pChild =   checkDiscount($pChild);
                // $pAdult =  checkDiscount($pAdult);
                
                 $pChild =   priceCalculator($srId,'priceCountChild');
                 $pAdult =   priceCalculator($srId,'priceCountAdult');
                 
                

                $opChild = (int) $extra->prices->priceChild;
                $opAdult = (int) $extra->prices->priceAdult;
              }
              if(isset($extra->others)){
                $cLabel = $extra->others->categoryLabel;
                $type = $extra->others->type;
                $tSlot = $extra->others->Totalslot;
                $inclusion = $extra->others->inclusion;
                $exclusion = $extra->others->exclusion;
                $terms = $extra->others->termsAndService;
              }
            }
            ?>
          <div class="row package-card mt-4" style="border: 1px solid;">
            <div class=" col-md-3  package-card-img-wrap" style="display: flex;align-items: center;">
              <a href="#0" class="card-img">
                <img src="<?= base_url().$srBanner;?>" alt="<?=$srTitle;?>">
              </a>
            </div>
            <div class=" col-md-6  package-card-content text-center " style="border-left: 1px solid;border-right: 1px solid;"> 
              <div class="card-content-top">
                <h5><?=$srTitle;?></h5>
                <div >
                  <p style="text-align: justify;padding: 0 15px;"><?=substr($srDes,0,250)?>...</p>
                </div>
              </div>
            </div>
            <div class=" col-md-3 text-center" style="display: flex;flex-direction: column;justify-content: center;">
                <?php echo priceCalculator($srId,'pricehtml') ?>
                <small class="p-3 text-center" style="line-height: normal;"><i><strong>Note: </strong> Price may very as per the Selection of Travel Date</i></small>
                <a href="<?= base_url()?>b2c/<?=strtolower($cLabel);?>-package/process-booking/<?=$srId;?>" class="primary-btn2">Book Now
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path d="M8.15624 10.2261L7.70276 12.3534L5.60722 18L6.85097 17.7928L12.6612 10.1948C13.4812 10.1662 14.2764 10.1222 14.9674 10.054C18.1643 9.73783 17.9985 8.99997 17.9985 8.99997C17.9985 8.99997 18.1643 8.26211 14.9674 7.94594C14.2764 7.87745 13.4811 7.8335 12.6611 7.80518L6.851 0.206972L5.60722 -5.41705e-07L7.70276 5.64663L8.15624 7.77386C7.0917 7.78979 6.37132 7.81403 6.37132 7.81403C6.37132 7.81403 4.90278 7.84793 2.63059 8.35988L0.778036 5.79016L0.000253424 5.79016L0.554115 8.91458C0.454429 8.94514 0.454429 9.05483 0.554115 9.08539L0.000253144 12.2098L0.778036 12.2098L2.63059 9.64035C4.90278 10.1523 6.37132 10.1857 6.37132 10.1857C6.37132 10.1857 7.0917 10.2102 8.15624 10.2261Z" />
                    <path d="M12.0703 11.9318L12.0703 12.7706L8.97041 12.7706L8.97041 11.9318L12.0703 11.9318ZM12.0703 5.23292L12.0703 6.0714L8.97059 6.0714L8.97059 5.23292L12.0703 5.23292ZM9.97892 14.7465L9.97892 15.585L7.11389 15.585L7.11389 14.7465L9.97892 14.7465ZM9.97892 2.41846L9.97892 3.2572L7.11389 3.2572L7.11389 2.41846L9.97892 2.41846Z" />
                  </svg>
                </a>
            </div>
          </div>
          <?php } ?>
        </div>

      </div>
    </div>
</div>