<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

    public function __construct()
    {
        parent::__construct();
        if(segment(2) != 'logout') {
            if(logged_in()) {
                redirect('home');
            }
        }
        $this->call->library('email');
    }
	
    public function index() {
        $this->call->view('auth/login');
    }  

    public function login() {


        if($this->form_validation->submitted()) {
            $email = $this->io->post('email');
			$password = $this->io->post('password');
            $data = $this->lauth->login($email, $password);
            if($this->form_validation->run()) {
                if($this->lauth->login($email, $password)) {
                    $this->lauth->set_logged_in($data);
                    if($email === 'admin@admin.com') {
                        echo json_encode(['success' => true, 'message' => $data, 'role' => 'admin']);
                    } else {
                        echo json_encode(['success' => true, 'message' => $data]);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => $data]);
                }
            }  else {
                echo json_encode(['success' => true, 'message' => $this->form_validation->errors()]);
            }
        } else {
            $this->call->view('auth/login');
        }
    }

    public function register() {

        if($this->form_validation->submitted()) {
            $firstname = $this->io->post('firstname');
            $lastname = $this->io->post('lastname');
            $address = $this->io->post('address');
            $birthday = $this->io->post('birthday');
            $contact_number = $this->io->post('contact_number');
            $email = $this->io->post('email');
			$email_token = bin2hex(random_bytes(50));
            $this->form_validation
                ->name('firstname')
                    ->required()
                    ->max_length(20, 'Firstname name must not be more than 20 characters.')
                    ->alpha_numeric_dash('Special characters are not allowed in firstname.')
                ->name('lastname')
                    ->required()
                    ->max_length(20, 'Lastname name must not be more than 20 characters.')
                    ->alpha_numeric_dash('Special characters are not allowed in lastname.')
                ->name('address')
                    ->required()
                    ->max_length(50, 'Address must not be more than 50 characters.')
                ->name('birthday')
                    ->required()
                ->name('contact_number')
                    ->required()
                ->name('password')
                    ->required()
                    //->min_length(8, 'Password must not be less than 8 characters.')
                ->name('password_confirmation')
                    ->required()
                    //->min_length(8, 'Password confirmation name must not be less than 8 characters.')
                    ->matches('password', 'Passwords did not match.')
                ->name('email')
                    ->required()
                    ->is_unique('users', 'email', $email, 'Email was already taken.');
                if($this->form_validation->run()) {
                    if($this->lauth->register($firstname, $lastname, $email, $address, $birthday, $contact_number, $this->io->post('password'), $email_token)) {
                        $data = $this->lauth->login($email, $this->io->post('password'));
                        $this->lauth->set_logged_in($data);
                        echo json_encode(['success' => true, 'message' => 'You are register']);
                    } else {
                        set_flash_alert('danger', config_item('SQLError'));
                    }
                }  else {
                    set_flash_alert('danger', $this->form_validation->errors()); 
                    redirect('auth/register');
                }
        } else {
            $this->call->view('auth/register');
        }
        
    }

    private function send_password_token_to_email($email, $token) {
		$template = file_get_contents(ROOT_DIR.PUBLIC_DIR.'/templates/reset_password_email.html');
		$search = array('{token}', '{base_url}');
		$replace = array($token, base_url());
		$template = str_replace($search, $replace, $template);
		$this->email->recipient($email);
		$this->email->subject('LavaLust Reset Password'); //change based on subject
		$this->email->sender('sample@email.com'); //change based on sender email
		$this->email->reply_to('sample@email.com'); // change based on sender email
		$this->email->email_content($template, 'html');
		$this->email->send();
	}

	public function password_reset() {
		if($this->form_validation->submitted()) {
			$email = $this->io->post('email');
			$this->form_validation
				->name('email')->required()->valid_email();
			if($this->form_validation->run()) {
				if($token = $this->lauth->reset_password($email)) {
					$this->send_password_token_to_email($email, $token);
                    $this->session->set_flashdata(['alert' => 'is-valid']);
				} else {
					$this->session->set_flashdata(['alert' => 'is-invalid']);
				}
			} else {
				set_flash_alert('danger', $this->form_validation->errors());
			}
		}
		$this->call->view('auth/password_reset');
	}

    public function set_new_password() {
        if($this->form_validation->submitted()) {
            $token = $this->io->post('token');
			if(isset($token) && !empty($token)) {
				$password = $this->io->post('password');
				$this->form_validation
					->name('password')
						->required()
						->min_length(8, 'New password must be atleast 8 characters.')
					->name('re_password')
						->required()
						->min_length(8, 'Retype password must be atleast 8 characters.')
						->matches('password', 'Passwords did not matched.');
						if($this->form_validation->run()) {
							if($this->lauth->reset_password_now($token, $password)) {
								set_flash_alert('success', 'Password was successfully updated.');
							} else {
								set_flash_alert('danger', config_item('SQLError'));
							}
						} else {
							set_flash_alert('danger', $this->form_validation->errors());
						}
			} else {
				set_flash_alert('danger', 'Reset token is missing.');
			}
    	redirect('auth/set-new-password/?token='.$token);
        } else {
             $token = $_GET['token'] ?? '';
            if(! $this->lauth->get_reset_password_token($token) && (! empty($token) || ! isset($token))) {
                set_flash_alert('danger', 'Invalid password reset token.');
            }
            $this->call->view('auth/new_password');
        }
		
	}

    public function logout() {
        if($this->lauth->set_logged_out()) {
            redirect('auth/login');
        }
    }

}
?>
