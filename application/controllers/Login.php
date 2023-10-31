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
                    $this->session->set_userdata(["user" => $user]);
                    echo "success";
                } else {
                    echo "failed";
                }
            } else {
                echo "failed user";
            }
        }
    }
}