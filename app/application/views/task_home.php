<?php //include_once "header.php"?>

<div class="container" id="maint">
    <h1 class="thh">Tasks Manager</h1>
    <p class="thp">This is a sample project for managing our daily tasks. We're going to use HTML, CSS, PHP, JavaScript and MySQL
        for this project</p>


    <p>...</p>
    <h4>Add Tasks</h4>
    <div class="row">
        <div class="col-md-6 offset-3">
            <?php if (isset($_SESSION['success'])){?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong class="text-white"><?php echo $_SESSION['success']; unset($_SESSION['success'])?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-3">
            <?php if (isset($_SESSION['error'])){?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong class="text-white"><?php echo $_SESSION['error']; unset($_SESSION['error'])?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

        </div>
    </div>
    <form action="<?php echo url('task','storeTask')?>" method="post" >
        <fieldset>

            <label for="task">Task</label>
            <input type="text" placeholder="Task Details" id="task" name="task">
            <label for="date">Date</label>
            <input type="text" placeholder="Task Date" id="date" name="date">

            <input class="button-primary" type="submit" name="submit">
<!--                        <input type="hidden" name="action" value="add">-->
        </fieldset>
    </form>
</div>


<?php //include_once "app/application/views/footer.php"?>
