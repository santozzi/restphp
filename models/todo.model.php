<?php
include __DIR__."/conexion/connect.php";

//crud
$TABLE = 'task';
function create($todo)
{
    global $conn;
    global $TABLE;
    $titulo = $todo['title'];
    $descripcion = $todo['description'];
    $prioridad = $todo['prioridad'];
    $sql = "INSERT INTO $TABLE (title, description, prioridad) VALUES ('$titulo', '$descripcion', '$prioridad')";
    $result = mysqli_query($conn, $sql); 
    return $result;
}

function find_all()
{
    global $conn;
    global $TABLE;
    
    $sql = "SELECT * FROM $TABLE";
    $result = mysqli_query($conn, $sql);
    $todos = [];
    while($row = mysqli_fetch_assoc($result)){
        array_push($todos,$row);
    }
    return $todos;
}

function find_by_id($id)
{
    global $conn;
    global $TABLE;
    $sql = "SELECT * FROM $TABLE WHERE id = {$id}";
    $result = mysqli_query($conn, $sql);
    $todo = mysqli_fetch_assoc($result);
    return $todo;
}
function find_by_completed($completed)
{
    global $conn;
    global $TABLE;
    $sql = "SELECT * FROM $TABLE WHERE completed = '$completed'";
    $result = mysqli_query($conn, $sql);
    $todos = [];
    while($row = mysqli_fetch_array($result)){
        array_push($todos,$row);
    }
    return $todos;
}
function find_by_priority($priority)
{
    global $conn;
    global $TABLE;
    $sql = "SELECT * FROM $TABLE WHERE prioridad = '$priority' AND completed = 0";
    $result = mysqli_query($conn, $sql);
    $todos = [];
    while($row = mysqli_fetch_array($result)){
        array_push($todos,$row);
    }
    return $todos;
}

function update($id,$todo)
{
    global $conn;
    global $TABLE;

    $titulo = $todo['title'];
    $descripcion = $todo['description'];

    $prioridad = $todo['prioridad'];
    $completado = $todo['completed'];

    $sql = "UPDATE $TABLE SET  title = '$titulo', description = '$descripcion', prioridad = '$prioridad', completed = '$completado' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}
function updateCompleted($id)
{
    global $conn;
    global $TABLE;
    $task = find_by_id($id);
    echo $task['completed'];
    $completed = $task['completed'];
    $completed = !$completed;
    $sql = "UPDATE $TABLE SET completed = '$completed' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function delete($id)
{
    global $conn;
    global $TABLE;
    $sql = "DELETE FROM $TABLE WHERE id = {$id}";
    $result = mysqli_query($conn, $sql);
    return $result;
}
