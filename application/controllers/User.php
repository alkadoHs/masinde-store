<?php

use Ramsey\Uuid\Uuid;

class User extends CI_Controller
{

    public function register_index()
    {
        $users = $this->db->select("u.name, u.role, u.username, b.name as branchName")
                    ->from("user u")
                    ->join("branch b", "u.branchId = b.id")
                    ->get()
                ->result();

        $branches = $this->db->get('branch')->result();
        
        $data = [
            'users' => $users,
            'branches'=> $branches,
        ];
        $this->load->view("users/index", $data);
    }

    public function register()
    {
        $this->form_validation->set_rules("name", "Name", "trim|required");
        $this->form_validation->set_rules("username", "username","trim|required|is_unique[user.username]");
        $this->form_validation->set_rules("branchId", "Branch", "trim|required");
        $this->form_validation->set_rules("role", "Role", "trim|required");
        $this->form_validation->set_rules("password", "Password", "trim|required");
        $this->form_validation->set_rules("confirmPassword", "Confirm Password", "trim|required|matches[password]");

        if( $this->form_validation->run()) {
            $uuid = Uuid::uuid4()->toString();
             $password = $this->input->post("password");
            $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
            $data = [
                "id" => $uuid,
                "name"=> $this->input->post("name"),
                "username"=> $this->input->post("username"),
                "role"=> $this->input->post("role"),
                "branchId"=> $this->input->post("branchId"),
                "password"=> $hash,
            ];
            $this->db->insert("user", $data);
            $this->session->set_flashdata("register_success","Staff is registered successfully!");
            redirect("user/register_index");
        } else {
            $this->session->set_flashdata("register_failed","Staff registration failed!");
            return $this->register_index();
        }

    }
}