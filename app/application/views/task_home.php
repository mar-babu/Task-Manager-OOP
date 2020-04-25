
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo/Tasks</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        body {
            margin-top: 30px;
        }

        #main {
            padding: 0px 150px 0px 150px;;
        }

        #action {
            width: 150px;
        }
    </style>
</head>
<body>

<div class="container" id="main">
    <h1 >Tasks Manager</h1>
    <p >This is a sample project for managing our daily tasks. We're going to use HTML, CSS, PHP, JavaScript and MySQL
        for this project</p>


    <?php if (mysqli_num_rows($completeTasks) > 0){ ?>
        <h4>Complete Tasks</h4>

            <table>
                <thread>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thread>
                <tbody>
                <?php
                while ($values1 = $completeTasks->fetch_object()){
                    $timestamp = strtotime($values1->date);
                    $date1 = date("jS M, Y", $timestamp);
                    ?>
                    <tr>
                        <td><input class="label-inline" type="checkbox" value="<?php echo $values1->id?>"></td>
                        <td><?php echo $values1->id ?></td>
                        <td><?php echo $values1->task ?></td>
                        <td><?php echo $date1 ?></td>
                        <td><a class="delete" data-taskid="<?php echo $values1->id ?>" href="#">Delete</a> | <a class="incomplete" data-taskid="<?php echo $values1->id ?>" href="#">Incomplete</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
    <?php } ?>



    <p>...</p>


    <?php if (mysqli_num_rows($tasks) == 0){ ?>
        <p>Upcoming Tasks</p>
    <?php } else { ?>

    <h4>Upcoming Tasks</h4>

    <form action="<?php echo url('task','storeTask')?>" method="post">
        <table>
            <thread>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Task</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thread>
            <tbody>
            <?php
            while ($values = $tasks->fetch_object()){
                $timestamp = strtotime($values->date);
                $date = date("jS M, Y", $timestamp);
                ?>
            <tr>
                <td><input name="taskids[]" class="label-inline" type="checkbox" value="<?php echo $values->id; ?>"></td>
                <td><?php echo $values->id ?></td>
                <td><?php echo $values->task ?></td>
                <td><?php echo $date ?></td>
                <td><a class="delete" data-taskid="<?php echo $values->id ?>" href="#">Delete</a> | <a href="#">Edit</a> | <a class="complete" data-taskid="<?php echo $values->id ?>" href="#">Complete</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <select name="action" id="bulkaction">
            <option value="0">With Selected</option>
            <option value="bulkdelete">Delete</option>
            <option value="bulkcomplete">Mark as Complete</option>
        </select>
        <input class="button-primary" type="submit" value="submit" id="bulksubmit">

    </form>

    <?php } ?>

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
            <input type="hidden" name="action" value="add">
        </fieldset>
    </form>
</div>


<form action="<?php echo url('task','storeTask')?>" method="post" id="completeform">
    <input type="hidden" name="action" value="complete">
    <input type="hidden" id="taskid" name="taskid">
</form>

<form action="<?php echo url('task','storeTask')?>" method="post" id="incompleteform">
    <input type="hidden" name="action" value="incomplete">
    <input type="hidden" id="itaskid" name="taskid">
</form>

<form action="<?php echo url('task','storeTask')?>" method="post" id="deleteform">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" id="dtaskid" name="taskid">
</form>

</body>
<script src="app/application/views/plugins/jquery/jquery.min.js"></script>

<script>
    ;(function ($) {
        $(document).ready(function () {
//            alert("Done");
            $(".complete").on('click',function () {
                var id = $(this).data("taskid");
//                alert(id);
                $("#taskid").val(id);
                $("#completeform").submit();
            });

            $(".incomplete").on('click',function () {
                var id = $(this).data("taskid");
                $("#itaskid").val(id);
                $("#incompleteform").submit();
            });

            $(".delete").on('click',function () {
                if (confirm("Are you sure to delete this task?")) {
                    var id = $(this).data("taskid");
                    $("#dtaskid").val(id);
                    $("#deleteform").submit();
                }
            });
            $(".bulksubmit").on('click',function () {
                if ($("#bulkaction").val()=='bulkdelete'){
                    if (!confirm("Are you sure to delete this task?")) {
                        return false;
                    }
                }

            });

        });
    })(jQuery);
</script>
</html>


