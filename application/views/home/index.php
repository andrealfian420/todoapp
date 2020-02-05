<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('/vendor/bootstrap/css/bootstrap.min.css') ?>">

    <!-- fontawesome -->
    <link rel="stylesheet" href="<?= base_url('/vendor/fontawesome-free/css/all.min.css') ?>">

    <!-- My Css -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/main.css') ?>">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:700|Source+Sans+Pro&display=swap" rel="stylesheet">

    <title>Todo App</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card o-hidden border-0 my-1">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h5 class="card-header bg-dark text-white">Daily Todo Lists</h5>
                                    </div>

                                    <form action="<?= base_url('home') ?>" method="post">
                                        <div class="d-flex align-items-center mt-2 mb-2">
                                            <div class="w-100">
                                                <input type="text" class="form-control" name="title" placeholder="Add your tasks here" autocomplete="off">
                                            </div>
                                            <div class="px-0 bd-highlight ml-1">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                    <small class="form-text text-danger"><?= form_error('title'); ?></small>

                                    <!-- if failed when updating data -->
                                    <?php if ($this->session->userdata('updateFailed')) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Update Failed!</strong> You should fill the title field when updating!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <!-- if successfuly updating data -->
                                    <?php if ($this->session->userdata('updateSuccess')) : ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Your task has been updated!</strong> Let's do something amazing today!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($tasks as $task) : ?>

                                            <li class="list-group-item item">

                                                <!-- check for done -->
                                                <input type='checkbox' class="check-list" value='"<?= $task['id'] ?>"'>

                                                <?= $task['title']; ?>

                                                <!-- delete button -->
                                                <a href="<?= base_url('home/delete/') . $task['id']; ?>" class="ml-3 float-right btn-delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>

                                                <!-- update button -->
                                                <a href="#" class="btn-update ml-3 float-right" data-toggle="modal" data-target="#updateTask" data-id="<?= $task['id'] ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </li>

                                        <?php endforeach; ?>
                                    </ul>

                                    <!-- This button will appear when there's at least 1 data -->
                                    <?php if ($tasks) : ?>
                                        <div class="col-md-8 mt-3 ml-0">
                                            <a href="<?= base_url('home/deleteAllTask') ?>" class="btn btn-danger btn-delete mr-2 float-left">Delete All Task</a>
                                        </div>
                                    <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateTask" tabindex="-1" role="dialog" aria-labelledby="updateTaskLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTaskLabel">Changed your mind?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/update') ?>" method="post">
                        <input type="hidden" name="new_taskId" id="new_taskId">
                        <div class="form-group">
                            <label for="new_taskName">Task Title</label>
                            <input type="text" class="form-control" id="new_taskName" name="new_taskName" autocomplete="off">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Script -->
    <script src="<?= base_url('/vendor/jquery/jquery-3.4.1.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="<?= base_url('vendor/bootstrap/js/bootstrap.min.js') ?>"></script>

    <script src="<?= base_url('vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>

    <!-- My Custom Script -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <script>
        $('.btn-update').on('click', function() {

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('home/getupdate') ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#new_taskName').val(data.title);
                    $('#new_taskId').val(data.id);
                }
            });
        });
    </script>

</body>

</html>