<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function getAllCategory()
{
    $category_model = new Category_model();
    $result = $category_model->getAllForModule();

    return $result;
}

function check_permission($moduleName, $permission)
{
    // pre($_SESSION);
    // die;
    if ($_SESSION['isAdmin'] == SYSTEM_ADMIN && $_SESSION['role'] == "1") {
        return true;
    } else {

        $res =  user_can($_SESSION['role'], $moduleName) ?? false;
        if (!empty($res)) {
            if ((array_key_exists($permission, $res) || array_key_exists('total_access', $res))) {
                if (($res[$permission] == 1 || $res['total_access'] == 1)) {
                    return true;
                }
            }
        }
        return false;
    }
}

function get_unread_notifications()
{
    $notificats  =  new Notification_model();
		$notify  = array();
       if($_SESSION['isAdmin'] == SYSTEM_ADMIN){
        $notify = $notificats->getWhere(['user_id'=> SYSTEM_ADMIN, 'read_status' => 0]);
       }else{
        $notify = $notificats->getWhere(['user_id'=> $_SESSION['userId'], 'read_status' => 0]);
       }
    
    return $notify;
}

function isUnreadBooking($id)
{
    $notificats  =  new Notification_model();
		$notify  = array();

        if($_SESSION['isAdmin'] == SYSTEM_ADMIN){
            $notify = $notificats->getWhere(['user_id'=> SYSTEM_ADMIN, 'booking_id' => $id, 'read_status' => 0]);
        }else{
               $notify = $notificats->getWhere(['user_id'=> $_SESSION['userId'], 'booking_id' => $id, 'read_status' => 0]);
           }

    if(!empty($notify)) {
        return true;
    }else {
        return false;
    }
}

function getUnreadId($id)
{
    $notificats  =  new Notification_model();
		$notify  = array();

        if($_SESSION['isAdmin'] == SYSTEM_ADMIN){
            $notify = $notificats->getWhere(['user_id'=> SYSTEM_ADMIN, 'booking_id' => $id, 'read_status' => 0])[0] ?? false;
        }else{
               $notify = $notificats->getWhere(['user_id'=> $_SESSION['userId'], 'booking_id' => $id, 'read_status' => 0])[0] ?? false;
           }
        // $notify = $notificats->getWhere(['booking_id' => $id,'read_status'=>0])[0] ?? false;
    if(!empty($notify)) {
        return $notify->id;
    }else {
        return false;
    }
}

function getAllRoleAccess($roleId)
{
    $loginM = new  Login_model();
    $finalMatrixArray = [];
    $matrix = $loginM->getRoleAccessMatrix($roleId);
    if (!empty($matrix)) {
        $accessMatrix = json_decode($matrix->access);
        foreach ($accessMatrix as $key => $moduleMatrix) {
            $finalMatrixArray[$moduleMatrix->module] = (array) $moduleMatrix;
        }
    }
    return $finalMatrixArray;
}

function user_can($roleId, $module_name = '')
{
    $loginM = new  Login_model();
    $finalMatrixArray = [];
    $matrix = $loginM->getRoleAccessMatrix($roleId);
    if (!empty($matrix)) {
        $accessMatrix = json_decode($matrix->access);
        foreach ($accessMatrix as $key => $moduleMatrix) {
            if (pergMatch($module_name, $moduleMatrix->module) == true) {
                $finalMatrixArray = (array) $moduleMatrix;
            }
        }
    }
    return $finalMatrixArray;
}

function pergMatch($pattren, $matchWith)
{

    $specialChar = array('`', '~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_', '+', '=', '{', '}', '[', ']', ';', ':', '"', "'", ',', '.', '<', '>', '/', '?', '|', '\\', " ");

    $pattrenTxt = trim($pattren);
    $pattrenTxt = strtolower($pattrenTxt);
    $pattrenTxt = str_replace($specialChar, "", $pattrenTxt);
    $pattrenTxtLen = strlen($pattrenTxt);
    if ($pattrenTxtLen > 10) {
        $pattrenTxtLen = 10;
    }

    $ptn =  substr($pattrenTxt, 0, $pattrenTxtLen);

    $ptn = '/' . $ptn . '/';

    $matchTxt = trim($matchWith);
    $matchTxt = strtolower($matchTxt);
    $matchTxt = str_replace($specialChar, "", $matchTxt);
    $matchTxtLen = strlen($matchTxt);
    if ($matchTxtLen > 10) {
        $matchTxtLen = 10;
    }

    $matchTxt = substr($matchTxt, 0, $matchTxtLen);

    $match = preg_match($ptn, $matchTxt);
    if ($match) {
        return true;
    } else {
        return false;
    }
}
/**
 * This function used to get the CI instance
 */
if (!function_exists('get_instance')) {
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if (!function_exists('getHashedPassword')) {
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

if (!function_exists('ajax_logout')) {
function ajax_logout()
	{
		$this->session->sess_destroy();
        echo json_encode(array('success'=> true));
	}
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if (!function_exists('verifyHashedPassword')) {
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}


if (!function_exists('getDiscount')) {
	function getDiscount($role_id, $price_oginal = 0, $inPercent = FALSE)
	{

		$price_model = new Prices_model();
		$priceData = $price_model->getWhere(['role_id' => $role_id, 'status' => ACTIVE])[0] ?? array();
		if (!empty($priceData)) {
            $inPercent = ($priceData->discount_type == 'percentage') ? true: false; 
			
            if($inPercent == TRUE){
                $discount =  (int) $priceData->discount_amount;
                $d_amount = (int) (($discount * ((int) $price_oginal)) / 100);
                return $price_oginal - $d_amount;
				
			}else{
                $discount =  (int) $priceData->discount_amount;
                return $price_oginal + $discount;
			}

		}

		return $price_oginal;
	}
}

if (!function_exists('checkDiscount')) {
	function checkDiscount($price_oginal = 0, $inPercent = false)
	{
		$user_role_id  =  (!empty($_SESSION['role'])) ? $_SESSION['role'] : 25;
		if ($user_role_id) {
			$price_model = new Prices_model();
			$priceData = $price_model->getWhere(['role_id' => $user_role_id, 'status' => ACTIVE])[0] ?? array();
            if (!empty($priceData)) {
                $inPercent = ($priceData->discount_type == 'percentage') ? true: false; 
				if($inPercent == true){
                    $discount =  (int) $priceData->discount_amount;
                    $d_amount = (int) (($discount * ((int) $price_oginal)) / 100);
                    return $price_oginal + $d_amount;
				}else{
                    $discount =  (int) $priceData->discount_amount;
                    return (( (int) $price_oginal) + ( (int) $discount));
			    }
            }
		}

		return $price_oginal;
	}
}

if (!function_exists('getPercentage')) {
	function getPercentage()
	{
		$discount = 0.00;
		$user_role_id  =  (!empty($_SESSION['role'])) ? $_SESSION['role'] : 25;
		if ($user_role_id) {
			$price_model = new Prices_model();
			$priceData = $price_model->getWhere(['role_id' => $user_role_id, 'status' => ACTIVE])[0] ?? array();
			if (!empty($priceData)) {
				$discount =  (int) $priceData->discount_amount;
			}
		}

		return ($discount);
	}
}

if (!function_exists('priceCalculator')) {
	function priceCalculator($service_id, $arg = '')
	{
		$arr = array();
					$arr['childOriginal'] = 0.00 ;
					$arr['childDiscount'] = 0.00 ;

					$arr['adultOriginal'] = 0.00 ;
					$arr['adultDiscount'] = 0.00 ;
					
					$arr['totalOriginal'] = 0.00 ;
					$arr['totalDiscount'] = 0.00 ;
					$arr['percentage']    = 0.00 ;
					$arr['pricehtml']     = '' ;
					
					$arr['priceCountChild']     = 0.00 ;
					$arr['priceCountAdult']     = 0.00 ;
					$arr['priceCountTotal']     = 0.00 ;



		if ($service_id) {
			$service_model = new Service_model();
			$serviceInfo =  (array) $service_model->getServiceInfo($service_id);

			if (!empty($serviceInfo) && array_key_exists('extraInfo', $serviceInfo) == 1) {
				$serviceInfo = (array) json_decode($serviceInfo['extraInfo']);
				if (array_key_exists('prices', $serviceInfo)) {

					// css
					$css = 'style="color: #046e2d;font-family: var(--font-rubik);font-size: 1.5em;font-weight: 600;line-height: 1;display: inline-block;text-transform: capitalize;"';
					$css_del = 'style=" font-size: small;color: rgb(197 32 32);font-size: 0.5em;font-weight: 600;"';


					$serviceInfo = (array) $serviceInfo['prices'];

					if (array_key_exists('priceChild', $serviceInfo)) {

						$arr['childOriginal'] =  ( int ) $serviceInfo['priceChild'];
						$arr['childOriginal'] =  ( int ) $serviceInfo['priceChild'];
						if($serviceInfo['priceChild'] == '' || $serviceInfo['priceChild'] == '0' ||$serviceInfo['priceChild'] == '00' || $serviceInfo['priceChild'] == '0.00'){
						    $arr['childDiscount'] = $serviceInfo['priceChild'];
						}else{   
					     $arr['childDiscount'] = checkDiscount( ( int ) $serviceInfo['priceChild']);
						}
					}

					if (array_key_exists('priceAdult', $serviceInfo)) {

						$arr['adultOriginal'] =  (int) $serviceInfo['priceAdult'];
						
						if($serviceInfo['priceAdult'] == '' || $serviceInfo['priceAdult'] == '0' ||$serviceInfo['priceAdult'] == '00' || $serviceInfo['priceAdult'] == '0.00'){
						    $arr['adultDiscount'] = $serviceInfo['priceAdult'];
						}else{
						    
						$arr['adultDiscount'] = checkDiscount( ( int ) $serviceInfo['priceAdult']);
						}
					}

					$arr['totalOriginal'] = (int) $serviceInfo['priceChild'] + (int) $serviceInfo['priceAdult'];
					$arr['totalDiscount'] = checkDiscount( (int) $serviceInfo['priceChild'] ) + checkDiscount( (int) $serviceInfo['priceAdult'] );
					$arr['percentage'] = getPercentage();

					
					$disAdGrOrg = ($arr['adultDiscount'] >= $arr['adultOriginal']) ? '<span ' .	$css . ' > ' . number_format($arr['adultDiscount'], 2) . '</span>' : '<span ' .	$css . ' >' . number_format($arr['adultDiscount'], 2) . ' <del ' . $css_del . ' >' . number_format($arr['adultOriginal'], 2) . '</span>';
					$countDisAdGrOrg = ($arr['adultDiscount'] >= $arr['adultOriginal']) ? $arr['adultDiscount']  :  $arr['adultDiscount'] ;
					

					$disChGrOrg = ($arr['childDiscount'] >= $arr['childOriginal']) ? '<span ' .	$css .  ' >' . number_format($arr['childDiscount'], 2) . '</span>' : '<span ' .	$css . ' >' . number_format($arr['childDiscount'], 2) . ' <del ' . $css_del . ' >' . number_format($arr['childOriginal'], 2) . '</span>';
					$countDisChGrOrg = ($arr['childDiscount'] >= $arr['childOriginal']) ?  $arr['childDiscount']  : $arr['childOriginal'];

					$htmlAdult = ($arr['childOriginal'] != '0.00') ?
						(String) '<div class="col-6"><strong style="font-size: 1em;" >ADULT <i><small>(AED)</small></i>:</strong> <br>' . $disAdGrOrg . '</div>'
						:
						 (String) '<div class="col-6"><strong style="font-size: 1em;" >PRICE: <i><small>(AED)</small></i>:</strong> <br>' . $disAdGrOrg . '</div>';
				

					$htmlChild = (!empty($arr['childOriginal']) && $arr['childOriginal'] != '0.00') ?
					 (String) '<div class="col-6"><strong style="font-size: 1em;" >CHILD <i><small>(AED)</small></i>: </strong> <br>' . $disChGrOrg . ' </div>'
						: '';

					$arr['pricehtml'] = (String) '<div class="row" >' . $htmlAdult . $htmlChild  . '</div>';
					$arr['priceCountAdult'] =  (int) $arr['adultDiscount'];
					$arr['priceCountChild'] =  (int) $arr['childDiscount'];
					$arr['priceCountTotal'] =    (int) $countDisAdGrOrg  +  (int) $countDisChGrOrg ;

				}
			}
		}


		if($arg != ''){
			if(array_key_exists($arg,$arr) == 1){
				$arr = $arr[$arg];
			}
		}

		return $arr;
	}
}
/**
 * This method used to get current browser agent
 */
if (!function_exists('getBrowserAgent')) {
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } else if ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } else if ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if (!function_exists('setProtocol')) {
    function setProtocol()
    {
        $CI = &get_instance();

        $CI->load->library('email');

        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $CI->email->initialize($config);

        return $CI;
    }
}

if (!function_exists('emailConfig')) {
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if (!function_exists('resetPasswordEmail')) {
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;


        $CI = setProtocol();

        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();


        return $status;
    }
}

if (!function_exists('setFlashData')) {
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

if (!function_exists('totalCount')) {
    function totalCount($table, $column, $where)
    {
        $task_model = new Task_model() ;
        $result =   $task_model->getCount($table,$column,$where);

        return $result;
    }
}


if (!function_exists('web_info')) {
    function web_info($column_name)
    {
        $webSetting_model = new WebSetting_model() ;
        $result  =   (array) $webSetting_model->getAll()[0] ?? false;
        if(!empty($result)){
            if(array_key_exists($column_name,$result)){
                $result = $result[$column_name];
            }else{
                $result = 'key not found';
            }
        }
        return $result;
    }
}




