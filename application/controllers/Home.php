<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Todo_model', 'todo');
        $this->load->library('session');
    }

    public function index()
    {
        // load library
        $this->load->library('form_validation');

        // get all task stored
        $data['tasks'] = $this->todo->getAllTask();

        // validation rules
        $this->form_validation->set_rules('title', 'Task', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/index', $data);
        } else {
            $this->todo->addNewTask();
            return redirect('home');
        }
    }

    public function delete($id)
    {
        $this->todo->deleteTaskById($id);
        return redirect('home');
    }

    public function deleteAllTask()
    {
        $this->todo->deleteAllTask();

        return redirect('home');
    }

    public function getupdate()
    {
        echo json_encode($this->todo->getUpdateById($this->input->post('id')));
    }

    public function update()
    {
        // load library
        $this->load->library('form_validation');


        $this->form_validation->set_rules('new_taskName', 'Title', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('updateFailed', 'failed');
            return redirect('home');
        } else {
            $this->todo->updateTask();
            $this->session->set_flashdata('updateSuccess', 'success');
            return redirect('home');
        }
    }
}
