<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users_admin extends CI_Controller {

    function __construct(){
        // Construct the parent class
        parent::__construct();
        $this->load->model('UsersAdminModel','user_admin');
    }

    public function index(){
        //isAdmin();
        $this->load->helper('url');
        $data = array(
            'view' => 'users_admin_view',
            'page' => 'users'
        );
        $this->load->view('master_view',$data);
    }

    public function ajax_list(){
        $list = $this->user_admin->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user_admin) {
            $no++;
            $row = array();
            $row[] = $user_admin->vendedor;
            $row[] = $user_admin->nombre;
            $row[] = $user_admin->clave;
            $row[] = $user_admin->jerarquia;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user_admin('."'".$user_admin->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                     <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user_admin('."'".$user_admin->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_admin->count_all(),
            "recordsFiltered" => $this->user_admin->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id){
        $data = $this->user_admin->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add(){
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'clave' => $this->input->post('clave'),
            'jerarquia' => $this->input->post('jerarquia')
        );
        $insert = $this->user_admin->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update(){
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'clave' => $this->input->post('clave'),
            'jerarquia' => $this->input->post('jerarquia')
        );
        $this->user_admin->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id){
        $this->user_admin->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function login(){
        if(isset($_SESSION['admin'])){
            redirect(base_url()."admin/index");
        }else{
            $this->form_validation->set_rules('nombre','Nombre de usuario','trim|required|min_length[5]|max_length[50]');
            $this->form_validation->set_rules('clave','Contraseña','required|min_length[5]');

            if($this->form_validation->run() == TRUE){
                $data = array();
                $data['nombre'] = $_POST['nombre'];
                $data['clave'] = md5($_POST['clave']);


                $user_data = $this->user_admin->login($data);

                if($user_data){
                    $_SESSION['admin'] = $user_data;

                    if($_SESSION['admin']){
                        redirect(base_url()."admin/index");
                    }
                }else{
                    $this->session->set_flashdata("error","Usuario o contraseña incorrectos.");
                    redirect(site_url("users_admin/login"),"refresh");
                }
            }

            $this->load->view('login_view');
        }
    }

    public function logout(){
        unset($_SESSION['admin']);
        redirect(base_url()."users_admin/login","refresh");
    }

    public function change_password(){
        isAdmin();
        $this->form_validation->set_rules('password','Contraseña','required|min_length[5]');
        $this->form_validation->set_rules('newpassword','Nueva contraseña','required|min_length[5]');
        $this->form_validation->set_rules('repassword','Repetir contraseña','required|min_length[5]');

        if($this->form_validation->run() == TRUE){
            if($_POST['newpassword'] != $_POST['repassword']){
                $this->session->set_flashdata("error","Confirmar contraseña incorrecto.");
                redirect(base_url()."users_admin/change_password","refresh");
            }

            if($_POST['password'] == $_POST['newpassword']){
                $this->session->set_flashdata("error","Las contraseña nueva debe ser distinta a la actual.");
                redirect(base_url()."users_admin/change_password","refresh");
            }

            $password = $this->user_admin->getPassword($_SESSION['admin']['id']);

            if($password == md5($_POST['password'])){
                $db_data = array(
                    'id' => $_SESSION['admin']['id'],
                    'newpassword' => md5($_POST['newpassword'])
                );

                $return = $this->user_admin->changePassword($db_data);

                if($return){
                    redirect(base_url()."admin/index");
                }else{
                    $this->session->set_flashdata("error","Hubo un error al cambiar la contraseña, intentelo nuevamente mas tarde.");
                    redirect(base_url()."users_admin/change_password","refresh");
                }
            }else{
                $this->session->set_flashdata("error","La contraseña actual es invalida.");
                redirect(base_url()."users_admin/change_password","refresh");
            }
        }
        $view_data = array(
            'page' => 'my-account',
            'view' => 'admin/users/change_password'
        );

        $this->load->view('admin_master_view', $view_data);
    }
}