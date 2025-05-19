<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends BaseController
{
   protected $taskModel;

   public function __construct()
   {
      $this->taskModel = new TaskModel();
      helper(['form']);
   }

   // Show list of all tasks
   public function index()
   {
      $data['tasks'] = $this->taskModel->orderBy('due_date', 'ASC')->findAll();
      return view('tasks/index', $data);
   }

   // Show create/edit task form
   public function create($id = null)
   {
      $data = [];

      if ($id !== null) {
         $data['task'] = $this->taskModel->find($id);

         if (!$data['task']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Task not found');
         }
      }

      return view('tasks/create', $data);
   }

   // Save new task
   public function store()
   {
      $input = $this->request->getPost();

      if (!$this->validate([
         'title'    => 'required|min_length[3]|max_length[150]',
         'priority' => 'in_list[Low,Medium,High]',
         'status'   => 'in_list[Pending,In Progress,Completed]'
      ])) {
         return view('tasks/create', ['validation' => $this->validator]);
      }

      $this->taskModel->save([
         'title'       => $input['title'],
         'description' => $input['description'] ?? null,
         'priority'    => $input['priority'],
         'status'      => $input['status'],
         'due_date'    => $input['due_date'] ?? null
      ]);

      return redirect()->to('/tasks')->with('message', 'Task created successfully!');
   }

   // Update task
   public function update($id)
   {
      $input = $this->request->getPost();

      if (!$this->validate([
         'title'    => 'required|min_length[3]|max_length[150]',
         'priority' => 'in_list[Low,Medium,High]',
         'status'   => 'in_list[Pending,In Progress,Completed]'
      ])) {
         return view('tasks/create', [
            'validation' => $this->validator,
            'task' => $this->taskModel->find($id)
         ]);
      }

      $this->taskModel->update($id, [
         'title'       => $input['title'],
         'description' => $input['description'] ?? null,
         'priority'    => $input['priority'],
         'status'      => $input['status'],
         'due_date'    => $input['due_date'] ?? null
      ]);

      return redirect()->to('/tasks')->with('message', 'Task updated successfully!');
   }

   // Delete task
   public function delete($id)
   {
      $this->taskModel->delete($id);
      return redirect()->to('/tasks')->with('message', 'Task deleted successfully!');
   }
}
