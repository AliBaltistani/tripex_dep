<?php
$no_records = '';
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
$passengers = "";
$baby_seats = "";
$luggage = "";

$mcName = '';
$mcLabel = '';

$subcatName = '';
$scExtraInfo = '';
$imgArray =  array();
$opAdult = 0;
$opChild = 0;

$bkRefNo = '';
$bkId = '';
$bkTPrice = 0;
$bkAdult = 0;
$bkChild = 0;

if (!empty($bookings)) {
    $bkId = $bookings->bookingId;
    $bkRefNo = $bookings->bRefNo;
    $bkAdult = (int) $bookings->bAdult;
    $bkChild = (int) $bookings->bChild;

    $bkTPrice = (int) $bookings->totalPrice;
}

if (!empty($records->serviceId)) {

    $sid = $records->serviceId;
    $sTitle = $records->serviceTitle;
    $sDes = $records->serviceDescription;
    $sImages = $records->serviceImages;
    $sTumbnail = $records->serviceBanner;
    $sType = $records->serviceType;
    $sExtraInfo = $records->extraInfo;

    if (!empty($records->cRow)) {
        $mcName = $records->cRow->categoryName;
        $mcLabel = $records->cRow->categoryLabel;
    }
    if (!empty($records->scRow)) {
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

            // $pChild =  checkDiscount($pChild);
            // $pAdult =  checkDiscount($pAdult);
            $pChild =   priceCalculator($sid,'priceCountChild');
            $pAdult =   priceCalculator($sid,'priceCountAdult');

            $opChild = (int) $extra->prices->priceChild;
            $opAdult = (int) $extra->prices->priceAdult;
        }
        if (isset($extra->others)) {
            $cLabel = strtolower($extra->others->categoryLabel);
            $type = $extra->others->type;
            $tSlot = $extra->others->Totalslot;
            $inclusion = $extra->others->inclusion;
            $exclusion = $extra->others->exclusion;
            $terms = $extra->others->termsAndService;
            $vCode = $extra->others->vehicleCode;
            $trspTax = $extra->others->transportTax ?? '';
        }
    }
    if ($scExtraInfo != "") {
        $scExtra = json_decode($scExtraInfo);
        $passengers = $scExtra->passengers;
        $baby_seats = $scExtra->baby_seats;
        $luggage = $scExtra->luggage;
    }
} else {
    $no_records = "No Records Found...";
}
?>


<style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background-color: #ddd;
    }

    p {
        margin: 0%;
    }

    .container-pay {
        max-width: 90%;
        margin: 20px auto;
        overflow: hidden;
        background-color: #f8f9fa;
    }

    .box-1 {
        max-width: 60%;
        padding: 10px 40px;
        user-select: none;
    }

    .box-1 div .fs-12 {
        font-size: 8px;
        color: white;
    }

    .box-1 div .fs-14 {
        font-size: 15px;
        color: white;
    }

    .box-1 img.pic {
        width: 20px;
        height: 20px;
        object-fit: cover;
    }

    .box-1 img.mobile-pic {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .box-1 .name {
        font-size: 11px;
        font-weight: 600;
    }

    .dis {
        font-size: 12px;
        font-weight: 500;
    }

    label.box {
        width: 100%;
        font-size: 12px;
        background: #ddd;
        margin-top: 12px;
        padding: 10px 12px;
        border-radius: 5px;
        cursor: pointer;
        border: 1px solid transparent;
    }

    #one:checked~label.first,
    #two:checked~label.second,
    #three:checked~label.third {
        border-color: #dc3545;
    }

    #one:checked~label.first .circle,
    #two:checked~label.second .circle,
    #three:checked~label.third .circle {
        border-color: green;
        background-color: #fff;
    }

    label.box .course {
        width: 100%;
    }

    label.box .circle {
        height: 12px;
        width: 12px;
        background: #ccc;
        border-radius: 50%;
        margin-right: 15px;
        border: 4px solid transparent;
        display: inline-block;
    }

    input[type="radio"] {
        display: none;
    }

    .box-2 {
        max-width: 40%;
        padding: 10px 40px;
        background-color: blanchedalmond;
    }


    .box-2 .box-inner-2 input.form-control {
        font-size: 12px;
        font-weight: 600;
    }

    .box-2 .box-inner-2 .inputWithIcon {
        position: relative;
    }

    .box-2 .box-inner-2 .inputWithIcon span {
        position: absolute;
        left: 15px;
        top: 8px;
    }

    .box-2 .box-inner-2 .inputWithcheck {
        position: relative;
    }

    .box-2 .box-inner-2 .inputWithcheck span {
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: green;
        font-size: 12px;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        right: 15px;
        top: 6px;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        outline: none;
        border: 1px solid #dc3545;
    }

    .border:focus-within {
        border: 1px solid #dc3545 !important;
    }

    .box-2 .card-atm .form-control {
        border: none;
        box-shadow: none;
    }

    .form-select {
        border-radius: 0;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;

    }

    .address .form-control.zip {
        border-radius: 0;
        border-bottom-left-radius: 10px;

    }

    .address .form-control.state {
        border-radius: 0;
        border-bottom-right-radius: 10px;

    }

    .box-2 .box-inner-2 .btn.btn-outline-primary {
        width: 120px;
        padding: 10px;
        font-size: 11px;
        padding: 0% !important;
        display: flex;
        align-items: center;
        border: none;
        border-radius: 0;
        background-color: whitesmoke;
        color: black;
        font-weight: 600;
    }

    .box-2 .box-inner-2 .btn.btn-primary {
        background-color: #dc3545;
        color: whitesmoke;
        font-size: 14px;
        display: flex;
        align-items: center;
        font-weight: 600;
        justify-content: center;
        border: none;
        padding: 10px;
    }

    .box-2 .box-inner-2 .btn.btn-primary:hover {
        background-color: green;
    }

    .box-2 .box-inner-2 .btn.btn-primary .fas {
        font-size: 13px !important;
        color: whitesmoke;
    }

    .nice-select {
        background: green;
    }

    .nice-select .current {
        color: #fff;
    }

    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .carousel-inner {
        width: 100%;
        height: 250px;
    }

    .carousel-item img {
        object-fit: cover;
        height: 100%;
    }

    .carousel-control-prev {
        transform: translateX(-50%);
        opacity: 1;
    }

    .carousel-control-prev:hover .fas.fa-arrow-left {
        transform: translateX(-5px);
    }

    .carousel-control-next {
        transform: translateX(50%);
        opacity: 1;
    }

    .carousel-control-next:hover .fas.fa-arrow-right {
        transform: translateX(5px);
    }

    .fas.fa-arrow-left,
    .fas.fa-arrow-right {
        font-size: 0.8rem;
        transition: all .2s ease;
    }

    .icon {
        width: 30px;
        height: 30px;
        background-color: #f8f9fa;
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transform-origin: center;
        opacity: 1;
    }

    .fas,
    .fab {
        color: #6d6c6d;
    }

    ::placeholder {
        font-size: 12px;
    }

    @media (max-width:768px) {
        .container-pay {
            max-width: 700px;
            margin: 10px auto;
        }

        .box-1,
        .box-2 {
            max-width: 600px;
            padding: 20px 90px;
            margin: 20px auto;
        }

    }

    @media (max-width:426px) {

        .box-1,
        .box-2 {
            max-width: 400px;
            padding: 20px 10px;
        }

        ::placeholder {
            font-size: 9px;
        }
    }

    hr {
        margin: 0rem 0 1rem;
    }
</style>

<?php if($no_records == ''){ ?>
<div class="container-pay d-lg-flex">
    <div class="box-1 bg-light user">
        
        <div class="d-flex align-items-center ">
            <p class="ps-2 name">
            <h6>Reference No: <small><u><?= $bkRefNo ?></u></small> </h6>
            </p>
        </div>
        <hr>
        <div class="box-inner-1 pb-3 mb-3 ">
            <div class="d-flex justify-content-between mb-3 userdetails">
                <p class="fw-bold"><?= $sTitle ?></p>
                <!-- <p class="fw-lighter"><span class="fas fa-dollar-sign"></span>33.00+</p> -->
            </div>
            <hr>
            <div class="tour-price">
                <?= priceCalculator($sid,'pricehtml') ?>
            </div>
            <hr>
            <div id="my" class="carousel slide carousel-fade img-details" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#my" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#my" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#my" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <?php if (!empty($imgArray->data)) {
                        foreach ($imgArray->data as $cImg) { ?>
                            <div class="carousel-item active">
                                <img src="<?= base_url() . $cImg ?>" class="d-block w-100">
                            </div>
                        <?php }
                    } else { ?>
                        <div class="carousel-item active">
                            <img src="<?= base_url() . $sTumbnail ?>" class="d-block w-100">
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#my" data-bs-slide="prev">
                    <div class="icon">
                        <span class="fas fa-arrow-left"></span>
                    </div>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#my" data-bs-slide="next">
                    <div class="icon">
                        <span class="fas fa-arrow-right"></span>
                    </div>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <p class="dis info my-3"><?= $sDes ?></p>
            <div class="radiobtn">
                <input required type="radio" name="box" id="one">
                <input required type="radio" name="box" id="two">
                <input required type="radio" name="box" id="three">
                <label for="one" class="box py-2 first">
                    <div class="d-flex align-items-start">
                        <span class="circle"></span>
                        <div class="course">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold">
                                    Included
                                </span>
                            </div>
                            <span><?= $inclusion ?></span>
                        </div>
                    </div>
                </label>
                <label for="two" class="box py-2 second">
                    <div class="d-flex">
                        <span class="circle"></span>
                        <div class="course">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold">
                                    Excluded
                                </span>
                            </div>
                            <span><?= $exclusion ?></span>
                        </div>
                    </div>
                </label>
                <label for="three" class="box py-2 third">
                    <div class="d-flex">
                        <span class="circle"></span>
                        <div class="course">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold">
                                    Trems & Conditions
                                </span>
                            </div>
                            <span><?= $terms ?></span>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
    <div class="box-2">
        <div class="box-inner-2">
            <div>
                <p class="fw-bold">Payment Details</p>
                <p class="dis mb-3">Complete your purchase by providing your payment details</p>
            </div>
            <form action="" method="POST" class="required" role="form" aria-errormessage="trues">
                <div class="mb-3">
                    <p class="dis fw-bold mb-2">Email address</p>
                    <input required class="form-control" type="email" name="email" value="luke@skywalker.com">
                </div>
                <div>
                    <p class="dis fw-bold mb-2">Card details</p>
                    <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                        <div class="fab fa-cc-visa ps-3"></div>
                        <input required type="text" class="form-control" name="card_details" placeholder="Card Details">
                        <div class="d-flex w-50">
                            <input required type="text" class="form-control px-0" placeholder="MM/YY">
                            <input required type="password" maxlength="3" name="password" class="form-control px-0" placeholder="CVV">
                        </div>
                    </div>
                    <div class="my-3 cardname">
                        <p class="dis fw-bold mb-2">Cardholder name</p>
                        <input required class="form-control" name="cholder" type="text">
                    </div>
                    <div class="address">
                        <p class="dis fw-bold mb-3">Billing address</p>
                         <select required class="form-select" name="bAddress" aria-label="Select Your Country">
                <option value="Afghanistan">Afghanistan</option>
                <option value="Åland Islands">Åland Islands</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antarctica">Antarctica</option>
                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Bouvet Island">Bouvet Island</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                <option value="Brunei Darussalam">Brunei Darussalam</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote D'ivoire">Cote D'ivoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Territories">French Southern Territories</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guernsey">Guernsey</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea-bissau">Guinea-bissau</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jersey">Jersey</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kenya">Kenya</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                <option value="Korea, Republic of">Korea, Republic of</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macao">Macao</option>
                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malawi">Malawi</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                <option value="Moldova, Republic of">Moldova, Republic of</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Netherlands Antilles">Netherlands Antilles</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau">Palau</option>
                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Philippines">Philippines</option>
                <option value="Pitcairn">Pitcairn</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Rwanda">Rwanda</option>
                <option value="Saint Helena">Saint Helena</option>
                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                <option value="Saint Lucia">Saint Lucia</option>
                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                <option value="Samoa">Samoa</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                <option value="Thailand">Thailand</option>
                <option value="Timor-leste">Timor-leste</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates" selected>United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Viet Nam">Viet Nam</option>
                <option value="Virgin Islands, British">Virgin Islands, British</option>
                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                <option value="Wallis and Futuna">Wallis and Futuna</option>
                <option value="Western Sahara">Western Sahara</option>
                <option value="Yemen">Yemen</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
            </select>
                        <div class="">
                            <input required class="form-control zip" name="zip_code" type="text" placeholder="ZIP">
                            <br>
                            <input required class="form-control state" name="state" type="text" placeholder="State">
                        </div>
                        <div class=" my-3">
                            <p class="dis fw-bold mb-2">VAT Number</p>
                            <div class="inputWithcheck">
                                <input required class="form-control" name="vat_num" type="text" value="GB012345B9">
                                <span class="fas fa-check"></span>

                            </div>
                        </div>
                        <div class="d-flex flex-column dis">
                            <h6> PRICE</h6>

                            <div class="d-flex align-items-center justify-content-between mb-2" style="border: 1px solid;padding: 10px 20px;">
                                <span style="font-weight: 600;"> <?= ($bkChild != '0.00') ? 'Adult:' : 'Total:'; ?> </span>
                                <ul class="d-flex align-items-center justify-content-between">
                                    <li><strong><?= ($bkChild != '0') ? $opAdult : (priceCalculator($sid,'priceCountAdult')); ?> AED</strong> </li>
                                    <li class="mx-3"><i class="bi bi-x-lg"></i></li>
                                    <li><strong id="quantity_span_adult"><?= ($bkChild != '0.00') ? $bkAdult : ($bkChild + $bkAdult); ?></strong>&nbsp; QTY</li>
                                </ul>
                                <svg xmlns="http://www.w3.org/2000/svg" width="27" height="15" viewBox="0 0 27 15">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.999 5.44668L25.6991 7.4978L23.9991 9.54878H0V10.5743H23.1491L20.0135 14.3575L20.7834 14.9956L26.7334 7.81687L26.9979 7.4978L26.7334 7.17873L20.7834 0L20.0135 0.638141L23.149 4.42114H0V5.44668H23.999Z"></path>
                                </svg>
                                <div class="total" id="total_price_adult" style="color: #046e2d;"><b><?= priceCalculator($sid,'priceCountAdult'); ?> </b> AED</div>
                            </div>

                            <?php if ($bkChild != '0') { ?>
                                <div class="d-flex align-items-center justify-content-between mb-2" style="border: 1px solid;padding: 10px 20px;">
                                    <span style="font-weight: 600;">Child: </span>
                                    <ul class="d-flex align-items-center justify-content-between">
                                        <li><strong><?= $opChild ?> AED</strong> </li>
                                        <li class="mx-3"><i class="bi bi-x-lg"></i></li>
                                        <li><strong id="quantity_span_adult"><?= $bkChild ?></strong>&nbsp; QTY</li>
                                    </ul>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="15" viewBox="0 0 27 15">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M23.999 5.44668L25.6991 7.4978L23.9991 9.54878H0V10.5743H23.1491L20.0135 14.3575L20.7834 14.9956L26.7334 7.81687L26.9979 7.4978L26.7334 7.17873L20.7834 0L20.0135 0.638141L23.149 4.42114H0V5.44668H23.999Z"></path>
                                    </svg>
                                    <div class="total" id="total_price_adult" style="color: #046e2d;"><b><?= priceCalculator($sid,'priceCountChild'); ?></b> AED</div>
                                </div>
                            <?php } ?>

                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>Subtotal</p>
                                <div class="total" id="total_price_adult" style="color: #046e2d;"><b><?= $bkTPrice ?></b> AED</div>
                            </div>
                            <?php if(priceCalculator($sid,'percentage') > '0') { ?>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>OFF<span>(<?= priceCalculator($sid,'percentage'); ?> %)</span></p>

                                <!--<del>-->
                                <!--    <div class="total" id="total_price_adult" style="color: #dc3545;"><b></b> AED</div>-->
                                <!--</del>-->
                                <!-- <p><span class="fas fa-dollar-sign"></span>2.80</p> -->
                            </div>
                            <?php } ?>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="fw-bold">Total</p>
                                <p class="fw-bold"><?= $bkTPrice ?> AED </p>
                                <input required type="hidden" name="total_price" value="<?= $bkTPrice ?>" id="">
                                <input required type="hidden" name="booking_id" value="<?= $bkId ?>" id="">
                            </div>
                            <button type="submit" class="btn btn-primary my-2">
                                Make Payment ( <?= $bkTPrice ?> ) <small> AED </small>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php }else{
    echo  '<div class="row p-5">
            <div class="col-md-12 ">
                    <div class="alert alert-danger alert-dismissable text-center">
                    No Records Found
                    </div>
            </div>
        </div>';
} ?>