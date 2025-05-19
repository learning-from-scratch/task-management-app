<?= view('layouts/header') ?>

<div class="container mt-5">
   <div id="title" class="mb-5">
      <h1 class="text-center text-white"><?= isset($task) ? 'Edit Task' : 'New Task' ?></h1>
   </div>

   <?php if (isset($validation)): ?>
      <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
   <?php endif; ?>

   <div class="form-galactic-wrapper">
      <form method="post" action="<?= isset($task) ? '/tasks/update/' . $task['id'] : '/tasks/store' ?>" class="form-galactic">
         <div class="mb-3">
            <label for="title" class="form-label">Task Title</label>
            <input type="text" class="form-control" id="title" name="title"
               value="<?= esc($task['title'] ?? old('title')) ?>" required>
         </div>

         <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= esc($task['description'] ?? old('description')) ?></textarea>
         </div>

         <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select class="form-select" id="priority" name="priority">
               <?php foreach (['Low', 'Medium', 'High'] as $level): ?>
                  <option value="<?= $level ?>" <?= ($task['priority'] ?? old('priority')) === $level ? 'selected' : '' ?>>
                     <?= $level ?>
                  </option>
               <?php endforeach ?>
            </select>
         </div>

         <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
               <?php foreach (['Pending', 'In Progress', 'Completed'] as $stat): ?>
                  <option value="<?= $stat ?>" <?= ($task['status'] ?? old('status')) === $stat ? 'selected' : '' ?>>
                     <?= $stat ?>
                  </option>
               <?php endforeach ?>
            </select>
         </div>

         <div class="mb-3">
            <label for="due_date" class="form-label">Due Date (optional)</label>
            <input type="date" class="form-control" id="due_date" name="due_date"
               value="<?= esc($task['due_date'] ?? old('due_date')) ?>">
         </div>

         <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><?= isset($task) ? 'Update Task' : 'Create Task' ?></button>
            <a href="/tasks" class="btn btn-secondary">Cancel</a>
         </div>
      </form>
   </div>
</div>

<?= view('layouts/footer') ?>
