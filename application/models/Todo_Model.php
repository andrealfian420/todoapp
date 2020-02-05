<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Todo_Model extends CI_Model
{
    public function getAllTask()
    {
        return $this->db->get('todo-tasks')->result_array();
    }

    public function addNewTask()
    {
        $data = ['title' => htmlspecialchars($this->input->post('title'), true)];

        $this->db->insert('todo-tasks', $data);
    }

    public function deleteTaskById($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('todo-tasks');
    }

    public function deleteAllTask()
    {
        $this->db->empty_table('todo-tasks');
    }

    public function getUpdateById($id)
    {
        return $this->db->get_where('todo-tasks', ['id' => $id])->row_array();
    }

    public function updateTask()
    {
        $data = [
            'id' => $this->input->post('new_taskId'),
            'title' => $this->input->post('new_taskName'),
        ];

        $this->db->set('title', $data['title']);
        $this->db->where('id', $data['id']);
        $this->db->update('todo-tasks');
    }
}
