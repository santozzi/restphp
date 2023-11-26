<?php
  include "../../models/todo.model.php";
      // Allow from any origin
/*       if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
      
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    } */

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

  switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
      if (isset($_GET['id'])) {
        echo json_encode( find_by_id($_GET['id']));
      } else if (isset($_GET['completed'])) {
        echo json_encode( find_by_completed($_GET['completed']));
      } else if (isset($_GET['prioridad'])) {
        echo json_encode( find_by_priority($_GET['prioridad']));
      } else {
        echo json_encode( find_all());
      }
    

      //echo json_encode( find_by_priority('alta'));
      break;
    case 'POST':
      $_POST = json_decode(file_get_contents('php://input'), true);
      create($_POST);
   
      break;
    case 'PUT':
      // $_PUT no es parte de php es un variable que se crea 
      if (isset($_GET['id'])) {
        $id = ($_GET['id']);
        $_PUT = json_decode(file_get_contents('php://input'), true);
        update($id,$_PUT);

      }
      

      echo "PUT";
      break;
    case 'DELETE':
      if (isset($_GET['id'])) {
        $id = ($_GET['id']);
        delete($id);


      }
      echo "DELETE";
      break;
  }
?>