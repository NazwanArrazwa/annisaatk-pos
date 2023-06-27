<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function index()
    {
        $data['page']    = 'login';
        $data['title'] = 'AnnisaATK | Login';
        $this->form_validation->set_rules('username', 'Username', 'trim|required', array('required' => 'Username tidak boleh kosong'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'Password tidak boleh kosong'));
        if ($this->form_validation->run() == FALSE)
            $this->tampil($data);
        else {
            if ($data['dt'] = $this->m_umum->cek_login()) {
                $data_user = array(
                    'username'  =>    $data['dt']['username'],
                    'id_level'  =>    $data['dt']['id_level']
                );
                $this->session->set_userdata($data_user);
                if ($data_user['id_level'] == 1)
                    redirect(base_url("admin"));
                else if ($data_user['id_level'] == 2)
                    redirect(base_url("berita"));
                else if ($data_user['id_level'] == 3)
                    redirect(base_url("kasir"));
                else
                    show_404();
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Username Atau Password Salah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>'
                );
                $data['pesan'] = 'username password salah';
                redirect(base_url("login"));
            }
        }
    }

    // private function sendEmail($token, $type)
    // {
    //     $config = [
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'annisaatkbjm@gmail.com',
    //         'smtp_pass' => 'gcdcatghpqedjboz',
    //         'smtp_port' => 465,
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'newline'   => "\r\n"
    //     ];

    //     $this->load->library('email', $config);

    //     $this->email->from('annisaatkbjm@gmail.com', 'AnnisaATK Banjarmasin');
    //     $this->email->to($this->input->post('email'));


    //     if ($type == 'lupaPass') {
    //         $this->email->subject('Reset Password');
    //         $this->email->message('Klik Link Ini Untuk Reset Password Anda : <a href="' . base_url() . 'login/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
    //     }

    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }

    public function sendEmail($email, $subject, $message)
    {

        /* use this on server */

        /* $config = Array(
		      'mailtype' => 'html',
		      'charset' => 'iso-8859-1',
		      'wordwrap' => TRUE
	    	);
    	 */
        $this->load->model('m_admin');
        $email_config = $this->m_admin->get_email_config();
        /*This email configuration for sending email by Google Email(Gmail Acccount) from localhost */
        if ($email_config) {
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => $email_config->email,
                'smtp_pass' => $email_config->pass,
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );



            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('annisaatkbjm@gmail.com', 'AnnisaATK Banjarmasin');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);
        } else {
            // Penanganan jika pengaturan email tidak ditemukan di database
        }
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    function lupaPassword()
    {
        date_default_timezone_set('Asia/Makassar'); // Set zona waktu ke WITA (Asia/Makassar)

        $data['title'] = 'AnnisaATK | Lupa Password';
        $data['page'] = 'lupa_password';
        $this->load->model('m_umum');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //beri Validasi
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required|valid_email',
                array(
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Mohon Masukkan Email Yang Sesuai'
                )
            );
            if ($this->form_validation->run() == TRUE) {
                $email  = $this->input->post('email');
                $validateEmail = $this->m_umum->validateEmail($email);
                if ($validateEmail != false) {

                    $row = $validateEmail; // Menyimpan hasil validasi email pada variabel $row

                    $user_id = $row->username; // Mengambil Username pengguna dari objek $row

                    $string = time() . $user_id . $email; // Membentuk string unik dengan menggabungkan waktu saat ini, ID pengguna, dan alamat email

                    $token = hash('sha256', $string); // Menghasilkan string yang unik untuk digunakan sebagai hash

                    $currentDate = date('Y-m-d H:i');

                    // Mengatur waktu kedaluwarsa hash dalam dua Menit
                    $token_expiry = date('Y-m-d H:i', strtotime($currentDate . ' + 2 minutes'));

                    $data = array(
                        'token' => $token,
                        'token_expiry' => $token_expiry,
                    );

                    // Membentuk tautan reset password dengan menggabungkan URL dasar (base_url) dan parameter hash
                    $resetLink = base_url() . 'login/resetpassword?hash=' . $token;

                    $message = '<p>Your reset password Link is here: <a href="' . $resetLink . '">Reset Password</a></p>';
                    $subject = "Password Reset link";
                    $sentStatus = $this->sendEmail($email, $subject, $message);
                    if ($sentStatus == true) {
                        // Fungsi updatePasswordhash() dari model m_umum dipanggil untuk mengupdate token dan waktu kedaluwarsa pada pengguna yang terkait
                        $this->m_umum->updatePasswordhash($data, $email);
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Mohon Cek Email Untuk Reset Password
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                        </div>'
                        );
                        redirect(base_url("login"));
                    } else {
                        $this->session->set_flashdata('message', 'Email sending error');
                        $this->tampil($data);
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Email Tidak Terdaftar
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                    </div>'
                    );
                    $this->tampil($data);
                }
            } else {
                // Jika Form Validasi Tidak Valid
                $this->tampil($data);
            }
        } else {
            // Jika Request Method nya bukan POST

            $this->tampil($data);
        }
    }

    public function resetPassword()
    {
        date_default_timezone_set('Asia/Makassar'); // Set zona waktu ke WITA (Asia/Makassar)

        $data['page'] = 'ubah_password';
        $data['title'] = 'AnnisaATK | Ubah Password';

        // jika nilai hash yang diperoleh dari input URL ada
        if ($this->input->get('hash')) {
            $token = $this->input->get('hash'); // Mendapatkan nilai parameter 'hash' dari input URL
            $data['hash'] = $token; // Menyimpan nilai hash ke dalam variabel data['hash']

            // Mengambil detail hash dari database menggunakan model m_umum
            $getHashDetails = $this->m_umum->getHahsDetails($token);

            //Jika $getHashDetails Bukan False 
            if ($getHashDetails != false) {
                $token_expiry = $getHashDetails->token_expiry; // Mendapatkan tanggal kedaluwarsa token dari detail Token
                $currentDate = date('Y-m-d H:i'); // Mendapatkan tanggal dan waktu saat ini

                // Memeriksa apakah token belum kedaluwarsa
                if ($currentDate < $token_expiry) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[5]|matches[cpassword]');
                        $this->form_validation->set_rules('cpassword', 'Confirm New Password', 'trim|required|min_length[5]|matches[password]');

                        // Validasi form
                        if ($this->form_validation->run() == TRUE) {
                            $newPassword = $this->input->post('password');
                            $newPassword = md5($newPassword);

                            // Data baru untuk diupdate
                            $data = array(
                                'password' => $newPassword,
                                'token' => null,
                                'token_expiry' => null
                            );

                            // Update password baru ke dalam database menggunakan model m_umum
                            $this->m_umum->updateNewPassword($data, $token);

                            // Set flash message untuk menampilkan pesan sukses
                            $this->session->set_flashdata(
                                'message',
                                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Ubah Password Berhasil
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>'
                            );

                            // Redirect ke halaman login
                            redirect(base_url('login'));
                        } else {
                            // Jika validasi gagal, tampilkan halaman dengan Validasi yang error
                            $this->tampil($data);
                        }
                    } else {
                        // Jika metode request bukan POST, tampilkan halaman dengan data yang sama
                        $this->tampil($data);
                    }
                } else {
                    // Jika token telah kedaluwarsa, set flash message dan redirect ke halaman login
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Link Expired
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>'
                    );
                    // Update token dan token_expiry menjadi null ke dalam database menggunakan model m_umum
                    $data = array(
                        'token' => null,
                        'token_expiry' => null
                    );
                    $this->m_umum->updateNewPassword($data, $token);
                    redirect(base_url('login'));
                }
            } else {
                // Jika hash tidak valid, set flash message
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Invalid Link
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
                );

                redirect(base_url('login'));
            }
        } else {
            // Jika tidak ada hash, set flash message dan redirect ke halaman login
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Invalid Token
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>'
            );
            redirect(base_url('login'));
        }
    }

    // public function lupaPassword()
    // {
    //     $data['title'] = 'AnnisaATK | Lupa Password';
    //     $data['page'] = 'lupa_password';
    //     $this->form_validation->set_rules(
    //         'email',
    //         'Email',
    //         'trim|required|valid_email',
    //         array(
    //             'required' => 'Email tidak boleh kosong',
    //             'valid_email' => 'Mohon Masukkan Email Yang Sesuai'
    //         )
    //     );
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->tampil($data);
    //     } else {
    //         $email = $this->input->post('email');
    //         $user  = $this->db->get_where('tb_user', ['email' => $email])->row_array();

    //         if ($user) {
    //             $token = base64_encode(random_bytes(32));
    //             $user_token = [
    //                 'email' => $email,
    //                 'token' => $token,
    //                 'date_created' => time()
    //             ];

    //             $this->db->insert('tb_user_token', $user_token);
    //             $this->_kirimEmail($token, 'lupaPass');
    //             $this->session->set_flashdata(
    //                 'message',
    //                 '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //             Mohon Cek Email Untuk Reset Password
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //             <span aria-hidden="true">&times;</span>
    //           </button>
    //             </div>'
    //             );
    //             redirect(base_url("login/lupaPassword"));
    //         } else {
    //             $this->session->set_flashdata(
    //                 'message',
    //                 '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //             Email Tidak Terdaftar
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //             <span aria-hidden="true">&times;</span>
    //           </button>
    //             </div>'
    //             );
    //             redirect(base_url("login/lupaPassword"));
    //         }
    //     }
    // }

    // public function resetPassword()
    // {
    //     $email = $this->input->get('email');
    //     $token = $this->input->get('token');

    //     $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

    //     if ($user) {
    //         $user_token = $this->db->get_where('tb_user_token', ['token' => $token])
    //             ->row_array();
    //         if ($user_token) {
    //             if (time() - $user_token['date_created'] < (120)) {
    //                 $this->session->set_userdata('reset_email', $email);
    //                 $this->changePassword();
    //             } else {

    //                 $this->db->delete('tb_user_token', ['email' => $email]);
    //                 $this->session->set_flashdata(
    //                     'message',
    //                     '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //                Token Expired.
    //                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                 <span aria-hidden="true">&times;</span>
    //               </button>
    //                 </div>'
    //                 );
    //                 redirect(base_url("login"));
    //             }
    //         } else {
    //             $this->session->set_flashdata(
    //                 'message',
    //                 '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //            Reset Password Gagal! Token Salah 
    //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //             <span aria-hidden="true">&times;</span>
    //           </button>
    //             </div>'
    //             );
    //             redirect(base_url("login"));
    //         }
    //     } else {
    //         $this->session->set_flashdata(
    //             'message',
    //             '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //        Reset Password Gagal! Email Salah 
    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //         <span aria-hidden="true">&times;</span>
    //       </button>
    //         </div>'
    //         );
    //         redirect(base_url("login"));
    //     }
    // }

    // public function changePassword()
    // {
    //     if (!$this->session->userdata('reset_email')) {
    //         redirect(base_url("login"));
    //     }
    //     $data['page']    = 'ubah_password';
    //     $data['title'] = 'AnnisaATK | UbahPassword';
    //     $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]');
    //     $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|matches[password1]');
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->tampil($data);
    //     } else {
    //         $password = md5($this->input->post('password1'));
    //         $email = $this->session->userdata('reset_email');
    //         $this->db->set('password', $password);
    //         $this->db->where('email', $email);
    //         $this->db->update('tb_user');
    //         $this->db->delete('tb_user_token', ['email' => $email]);
    //         $this->session->unset_userdata('reset_email');
    //         $this->session->set_flashdata(
    //             'message',
    //             '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //        Ganti Password Berhasil!
    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //         <span aria-hidden="true">&times;</span>
    //       </button>
    //         </div>'
    //         );
    //         redirect(base_url("login"));
    //     }
    // }

    function logout()
    {
        unset(
            $_SESSION['username'],
            $_SESSION['id_level']
        );
        $this
            ->session
            ->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                Anda Berhasil LogOut
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        $data['pesan'] = 'Logout Sukses';
        redirect(base_url("login"));
    }

    function tampil($data)
    {
        $this->load->view('auth/header', $data);
        $this->load->view('auth/isi');
        $this->load->view('auth/footer');
    }
}
