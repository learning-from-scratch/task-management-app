<?= view('layouts/header') ?>

<div class="container mt-5">
   <div id="title" class="mb-5">
      <h1 class="text-center text-white">Task Manager</h1>
   </div>

   <?php if (session()->getFlashdata('message')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert" id="alertMessage">
         <?= session()->getFlashdata('message') ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

   <a href="/tasks/create" class="btn btn-primary mb-3">Add New Task</a>

   <div class="table-galactic-wrapper">
      <table class="table table-hover table-galactic">
         <thead>
            <tr>
               <th>Title</th>
               <th>Priority</th>
               <th>Status</th>
               <th>Due Date</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php if (!empty($tasks)): ?>
               <?php foreach ($tasks as $task): ?>
                  <tr>
                     <td><?= esc($task['title']) ?></td>
                     <td><span class="badge bg-<?= $task['priority'] === 'High' ? 'danger' : ($task['priority'] === 'Medium' ? 'warning' : 'secondary') ?>">
                           <?= esc($task['priority']) ?>
                        </span></td>
                     <td><?= esc($task['status']) ?></td>
                     <td><?= esc($task['due_date']) ?: '-' ?></td>
                     <td>
                        <a href="/tasks/create/<?= $task['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $task['id'] ?>">
                           Delete
                        </button>
                     </td>
                  </tr>

                  <!-- Delete Modal -->
                  <div class="modal fade" id="deleteModal<?= $task['id'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $task['id'] ?>" aria-hidden="true">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel<?= $task['id'] ?>">Confirm Delete</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              Are you sure you want to delete the task "<?= esc($task['title']) ?>"?
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <a href="/tasks/delete/<?= $task['id'] ?>" class="btn btn-danger">Delete</a>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach ?>
            <?php else: ?>
               <tr>
                  <td colspan="5" class="text-center">No tasks found.</td>
               </tr>
            <?php endif ?>
         </tbody>
      </table>
   </div>
</div>

<?= view('layouts/footer') ?>

<script>
   // Auto dismiss alerts after 5 seconds
   document.addEventListener('DOMContentLoaded', function() {
      const alert = document.getElementById('alertMessage');
      if (alert) {
         setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
         }, 5000);
      }
   });
</script>
