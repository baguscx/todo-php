<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Todo App</title>
</head>
<body>
    <?php
        $todos = [];
        if(file_exists('todos.txt')){
            $file = file_get_contents('todos.txt');
            $todos = unserialize($file);
        }

        if(isset($_POST['task'])) {
            $task = $_POST['task'];
            $todos[] = [
                'task' => $task,
                'status' => false
            ];
            $aksi = serialize($todos);
            simpanData($aksi);
        }
    ?>

    <?php
        if(isset($_GET['status'])) {
            $key = $_GET['key'];
            $todos[$key]['status'] = $_GET['status'];
            $aksi = serialize($todos);
            simpanData($aksi);
        }
    ?>

    <?php
        if(isset($_GET['hapus'])) {
            $key = $_GET['key'];
            unset($todos[$key]);
            $aksi = serialize($todos);
            simpanData($aksi);
        }
    ?>

    <?php
    function simpanData($aksi){
        file_put_contents('todos.txt', $aksi);
        header('Location: index.php');
    }
    ?>

    <h1>Todo App</h1>

    <form method="post">
        <input type="text" name="task" id="task" placeholder="Enter your task">
        <button type="submit">Save</button>
    </form>
    <ul>
        <?php foreach($todos as $key => $todo): ?>
        <li>
            <input type="checkbox" name="todo" id="todo" onclick="window.location.href='index.php?status=<?php echo ($todo['status'] == true) ? false : true ?>&key=<?php echo $key; ?>'" <?php echo ($todo['status'] == true) ? 'checked' : '' ?>>
            <label>
                <?php
                    if($todo['status'] == true) {
                        echo "<del>" . $todo['task'] . "</del>";
                    } else {
                        echo $todo['task'];
                    } 
                ?></label>
            <a href="index.php?hapus=1&key=<?php echo $key; ?>" onclick="return confirm('Apakah Anda Yakin akan menghapus data ini?')" >Delete</a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>