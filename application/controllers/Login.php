<?php


class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('login');
    }


    public function auth() {
        $this->form_validation->set_rules('username', 'Username', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'trim');

        $username = $this->input->post('username');
        $password = $this->input->post('password');
   
        if ($this->form_validation->run()) {
            $user = $this->db->get_where("user", ["username" => $username])->row();
            if($user) {
                //verify password
                $authenticatedUser = password_verify($password, $user->password);
                if($authenticatedUser) {
                    $userdata = $this->db->select("u.*, b.name as branch")
                                 ->from("user u")
                                 ->join("branch b", "u.branchid = b.id")
                                 ->where("u.id", $user->id)
                               ->get()->row();
                    $data = [
                        "userId" => $user->id,
                        "username"=> $userdata->username,
                        "firstName" => $userdata->firstName,
                        "lastName"=> $userdata->lastName,
                        "branchId" => $userdata->branchId,
                        "branchName" => $userdata->branch
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata("login_failure", "Incorrect username or password");
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata("login_failure", "Incorrect username or password");
                redirect('login');
            }
        }
    }
}