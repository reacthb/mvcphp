<?php

require_once (MODEL . 'CrudManager.php');
require SRC . 'common.php';

class CrudController {

    function create() {
        $ok = false;
        if (isset($_POST['submit'])) {
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $location = $_POST['location'];
            $ok = (new CrudManager)->create($firstName, $lastName, $email, $age, $location);
        }
        require(VIEW . 'createView.php');
    }

    function read() {

        $result = false;
        $submitted = false;
        if (isset($_POST['submit'])) {
            $submitted = true;
            $location = $_POST['location'];
            $result = (new CrudManager)->read($location);
        }
        require(VIEW . 'readView.php');
    }

    function update() {
        $result = (new CrudManager)->update();
        require(VIEW . 'updateView.php');
    }

    function updateSingle($id) {
        $crudManager = new CrudManager;
        $submitted = false;
        $user = $crudManager->getUser($id);

        if (isset($_POST['submit'])) {
            $submitted = true;
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $location = $_POST['location'];
            $date = $_POST['date'];
            $ok = $crudManager->updateSingle($id, $firstName, $lastName, $email, $age, $location, $date);
        }
        require(VIEW . 'updateSingleView.php');
    }

    function delete() {
        $crudManager = new CrudManager;

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = 0;
        }
        $resTab = $crudManager->delete($id);
        $success = $resTab[0];
        $result = $resTab[1];

        require(VIEW . 'deleteView.php');
    }

}
