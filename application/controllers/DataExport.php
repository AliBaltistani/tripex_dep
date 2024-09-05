<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

require FCPATH .'/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class DataExport extends BaseController{
    
	protected $pdf;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Booking_model', 'bm');
		$this->load->library('My_pdf');
		$this->load->library('Whatsapp_api');
        $this->isLoggedIn();
        $this->module = 'DataExport';
		$this->pdf = new My_pdf();
    }

    
     public function index()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		
		foreach(range('A','V') as $coulumID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutosize(true);

		}

        $sheet->setCellValue('A1','Sr.#');
		$sheet->setCellValue('B1','RefNo');
		$sheet->setCellValue('C1','Staff');
		$sheet->setCellValue('D1','Agent');
		$sheet->setCellValue('E1','Date');
		$sheet->setCellValue('F1','GuestName');
		$sheet->setCellValue('G1','GuestContact');
		$sheet->setCellValue('H1','Tour');
		$sheet->setCellValue('I1','Type');
		$sheet->setCellValue('J1','bThemeParksTicket');
		$sheet->setCellValue('K1','AddService');
		$sheet->setCellValue('L1','Adult');
		$sheet->setCellValue('M1','Child');
		$sheet->setCellValue('N1','PickupDate');
		$sheet->setCellValue('O1','PickupTime');
		$sheet->setCellValue('P1','PickLoc');
		$sheet->setCellValue('Q1','DropLoc');
		$sheet->setCellValue('R1','Supplier');
		$sheet->setCellValue('S1','Vehicle');
		$sheet->setCellValue('T1','totalPrice');
		$sheet->setCellValue('U1','Cost');
		$sheet->setCellValue('V1','Sale');

		$users = $this->db->query("SELECT * FROM tbl_booking WHERE isDeleted = 0 ")->result_array();
		$x=2; //start from row  2
        $count = 1;
		foreach($users as $row)
		{
			$sheet->setCellValue('A'.$x, $count++);
			$sheet->setCellValue('B'.$x, $row['bRefNo']);
			$sheet->setCellValue('C'.$x, $row['bStaff']);
			$sheet->setCellValue('D'.$x, $row['bAgent']);
			$sheet->setCellValue('E'.$x, $row['bDate']);
			$sheet->setCellValue('F'.$x, $row['bGuestName']);
			$sheet->setCellValue('G'.$x, $row['bGuestContact']);
			$sheet->setCellValue('H'.$x, $row['bTour']);
			$sheet->setCellValue('I'.$x, $row['bType']);
			$sheet->setCellValue('J'.$x, $row['bThemeParksTicket']);
			$sheet->setCellValue('K'.$x, $row['bAddService']);
			$sheet->setCellValue('L'.$x, $row['bAdult']);
			$sheet->setCellValue('M'.$x, $row['bChild']);
			$sheet->setCellValue('N'.$x, $row['bPickupDate']);
			$sheet->setCellValue('O'.$x, $row['bPickupTime']);
			$sheet->setCellValue('P'.$x, $row['bPickLoc']);
			$sheet->setCellValue('Q'.$x, $row['bDropLoc']);
			$sheet->setCellValue('R'.$x, $row['bSupplier']);
			$sheet->setCellValue('S'.$x, $row['bVehicle']);
			$sheet->setCellValue('T'.$x, $row['totalPrice']);
			$sheet->setCellValue('U'.$x, $row['bSale']);
			$sheet->setCellValue('V'.$x, $row['bSale']);
			$x++;
		}

		$writer = new Xlsx($spreadsheet);
		$fileName='users_details_export2022.xlsx';
		//$writer->save($fileName);  //this is for save in folder


		/* for force download */
		header('Content-Type: appliction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="'.$fileName.'"');
		$writer->save('php://output');
		/* force download end */
	}

	public function saveAsPdf(){

		$userId = (isset($_REQUEST['id']))? $_REQUEST['id'] : ''; 
        $data['records'] = $this->bm->getBookingsBySupplierId($userId); 
		$data['users'] = $this->db
		                 ->query("SELECT * FROM tbl_users WHERE userId= '$userId' AND isDeleted = 0 ")
		                 ->row();

		// print_r($data['users']->mobile); die;
		if(!empty($data['users'])){
			$userName =	str_replace(' ', '', ucwords($data['users']->name));
			
			$filename =  'bk_' . $userName .date('dFY_h.iA') . "_.pdf";
			$resHtml = $this->load->view('booking/booking_pdf', $data, true);
			$res = $this->generate_pdf($resHtml, $filename);
			if ($res) {
				
				$whatsappApi = new Whatsapp_api();
				$umob = $data['users']->mobile ?? '';
          //    $result =  $whatsappApi->send_message('+923485045998','Hello testing message');
				$result =  $whatsappApi->send_document($umob,'Your Bookings',$res);
				
				if($result){
					if(array_key_exists('error',$result)){
						foreach($result['error'] as $key => $err){
							$this->session->set_flashdata('danger' ,$err['document']);
						}
					}
					else if(array_key_exists('message',$result)){
						if($result['sent'] == 'true'){
							$this->session->set_flashdata('success' ,"Booking details has successfuly sent to ".$userName);
						}else{
							$this->session->set_flashdata('danger' ,'Booking details sent falied');
						}	
					}
                //    $this->session->set_flashdata('');
				}

			}
		}
		$url_r = base_url().'supplier-bookings?id='.$userId;
		echo '<script> window.location="'.$url_r.'" </script>';
	}
	
	public function downloadAllBookingPDF() {
	    
        $data['searchText'] = '';
        $data['dateFrom'] = '';
        $data['dateTo'] = '';
        $data['records'] = $this->bm->bookingListing($data, 0, 0);
	
		$pdf = new Dompdf();
		$pdf->loadHtml($this->load->view('booking/booking_all_pdf', $data, true));
		$pdf->setPaper('A4', 'Landscape');
		$pdf->render();
		// Output PDF as a download
		$filename = "all_bookings_".date('d-m-Y')."_.pdf";
		
       $pdf->stream($filename, array('Attachment' => 1));
	}
	
	public function sendBookingPDFToWhatsApp() {

	
        $userId = (isset($_REQUEST['id']))? $_REQUEST['id'] : redirect('booking'); 
        $data['records'] = $this->bm->getBookingsBySupplierId($userId); 
		$data['users'] = $this->db
		                 ->query("SELECT * FROM tbl_users WHERE userId= '$userId' AND isDeleted = 0 ")
		                 ->row();
	   
		if(!empty($data['users'])){
			
			// Generate PDF
			$pdf = new Dompdf();
			$pdf->loadHtml($this->load->view('booking/booking_pdf', $data, true));
			$pdf->setPaper('A4', 'Landscape');
			$pdf->render();
			
		    $userName =	str_replace(' ', '_', $data['users']->name);
			
			$filename = $userName."_bookings_".date('d-m-Y')."_.pdf";
            $pdf->stream($filename, array('Attachment' => 1));
           
           
			// Define the path where you want to save the PDF
			$file_path = './uploads/booking_pdfs/'.$filename;

			// Ensure the uploads directory exists and is writable
			if (!is_dir('./uploads/booking_pdfs/')) {
				mkdir('./uploads/booking_pdfs', 0755, true);
			}
	
			// Output the PDF to a file
			$pdf->output($file_path);
	
			// echo 'PDF saved successfully to ' . $file_path;
           

			// echo '<pre>'; print_r($data); die;
           // ====== WORK IN PROGRESS ===========
         
            // $this->send_booking_to_supplier($file_pdf);
 			//$output = $pdf->output();
 			//file_put_contents('./booking.pdf', $output);
  			//$base64PdfData = "data:application/pdf;base64," . base64_encode($output);
            //$file_path = base_url('booking.pdf');
 			//redirect('https://wa.me/'.$users->mobile.'/?text='."".$file_path);			
		
		    
		}
		
	}
	
	public function send_booking_to_supplier($file_pdf) {
        $this->load->helper('Twilio');

		
        // User's WhatsApp number
        $to = 'whatsapp:+923488092160';

        // Message to send
        $message = "Dear User, your booking details are: ..."; // Replace ... with actual booking details

        // Send WhatsApp message
        if (send_whatsapp_message($to, $message)) {
            echo "Booking details sent successfully!";
        } else {
            echo "Failed to send booking details.";
        }
    }


	public function generate_pdf($html, $file_name = 'bk_1')
    {
		if(!$html){
			return false;
		}

		$dompdf = new Dompdf();
        // Load the HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        $file_path = './uploads/booking_pdfs/'.$file_name;

			// Ensure the uploads directory exists and is writable
			if (!is_dir('./uploads/booking_pdfs/')) {
				mkdir('./uploads/booking_pdfs', 0755, true);
			}
			
			
			$dompdf->stream($file_name, ['Attachment' => 1]);
			// $dompdf->output($file_path);
        // Output the PDF to a file
        // if($this->pdf->output($file_path)){
		// 	return base_url().'uploads/booking_pdfs/'.$file_name;
		// }else{
		// 	return false;
		// }
    }
	
    
}