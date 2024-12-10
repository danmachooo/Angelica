<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Appointment extends Controller {
    protected $user_id;
    
    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');;
        $this->call->model('Appointment_model', 'appointment');
        $this->call->model('Services_model', 'service');
    }

    public function book_appointment() {
        header('Content-Type: application/json');

        $data = array(
            'user_id' => $this->user_id,
            'service_id' => $this->io->post('service'),
            'appointment_date' => $this->io->post('appointment_date')
        );

        // Validate input
        if (empty($data['service_id']) || empty($data['appointment_date'])) {
            echo json_encode(['success' => false, 'message' => 'Service and appointment date are required.']);
            return;
        }

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'johnpauldanmachi@gmail.com';
            $mail->Password   = 'zycq ayyd qpld exzy';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
        
            //Recipients
            $mail->setFrom('johnpauldanmachi@gmail.com', 'System');
            $mail->addAddress(get_email($this->user_id));
        
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Booked an Appointment';
            $mail->Body    = 'You have an appointment on '. $data['appointment_date'] .'.';
            $mail->AltBody = 'You have an appointment on '. $data['appointment_date'] .'.';
            
            
            if($id = $this->appointment->book_appointment($data)) {
                $mail->send();
                echo json_encode(['success' => true, 'message' => 'Appointment has been booked!', 'appointment_id' => $id]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to book an appointment']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Failed to send email. ' . $mail->ErrorInfo]);
        }
    }

    public function get_all_appointments() {
       $data['appointments'] = $this->appointment->get_all_appointments();
       $this->call->view('admin/appointments', $data);
    }

    public function get_all_appointments_by_user() {
        $data['appointments'] = $this->appointment->get_all_appointments_by_user($this->user_id);
        $data['services'] = $this->service->get_all_services();
        $this->call->view('patient/appointments', $data);
    }
}
?>
