<?php

require_once (MODEL . 'Manager.php');

class CrudManager extends Manager {

    public function create($firstName, $lastName, $email, $age, $location) {
        global $tableUsers;
        $new_user = array(
            "firstname" => $firstName,
            "lastname" => $lastName,
            "email" => $email,
            "age" => $age,
            "location" => $location
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)", $tableUsers, implode(", ", array_keys($new_user)), ":" . implode(", :", array_keys($new_user))
        );

        $ok = false;
        try {
            $db = $this->dbConnect();
            $statement = $db->prepare($sql);
            $ok = $statement->execute($new_user);
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return $ok;
    }

    public function read($location) {
        $sql = "SELECT * FROM users WHERE location = :location";

        $result = false;
        try {
            $db = $this->dbConnect();

            $statement = $db->prepare($sql);
            $statement->bindParam(':location', $location, PDO::PARAM_STR);
            $statement->execute();

            $result = $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return $result;
    }

    public function update() {
        $sql = "SELECT * FROM users";

        $result = false;
        try {
            $db = $this->dbConnect();
            $statement = $db->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return $result;
    }

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $user = false;
        try {
            $db = $this->dbConnect();
            $statement = $db->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return($user);
    }

    public function updateSingle($id, $firstName, $lastName, $email, $age, $location, $date) {

        if (isset($_POST['submit'])) {
            $user = [
                "id" => $id,
                "firstname" => $firstName,
                "lastname" => $lastName,
                "email" => $email,
                "age" => $age,
                "location" => $location,
                "date" => null
            ];
            $sql = "UPDATE users 
            SET 
              firstname = :firstname, 
              lastname = :lastname, 
              email = :email, 
              age = :age, 
              location = :location, 
              date = :date 
            WHERE id = :id";

            try {
                $db = $this->dbConnect();
                $statement = $db->prepare($sql);
                $statement->execute($user);
            } catch (PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }
    }

    public function delete($id) {
        $success = false;
        if ($id) {
            try {
                $sql = "DELETE FROM users WHERE id = :id";
                $db = $this->dbConnect();
                $statement = $db->prepare($sql);
                $statement->bindValue(':id', $id);
                $statement->execute();
                $success = "User successfully deleted";
            } catch (PDOException $error) {
                echo $sql . "<br>" . $error->getMessage();
            }
        }

        try {
            $sql = "SELECT * FROM users";
            $db = $this->dbConnect();
            $statement = $db->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
        return [$success, $result];
    }

}
