<?php

session_start();
require_once __DIR__ . "\../Models/User.php";

class UsersRequest extends User
{
    // Some common errors
    private $required = "*Please, submit required data";
    private $invalid = "*Please, provide the data of indicated type";
    private $exists = "*This value already exists";

    // Array of errors
    private $errors = [];

    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    public function validateName()
    {
        if (empty($this->getName())) {
            return $this->errors['name-required'] = $this->required;
        } elseif (is_numeric($this->getName())) {
            return $this->errors['name-invalid'] = $this->invalid;
        }
    }
    public function validateEmail()
    {
        $pattern = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
        if (empty($this->getEmail())) {
            return $this->errors['email-required'] = $this->required;
        } elseif (!preg_match($pattern, $this->getEmail())) {
            return $this->errors['email-invalid'] = $this->invalid;
        } elseif ($this->emailExists() && !$this->emailExistsForSpecificId()) {
            return $this->errors['email-exists'] = $this->exists;
        }
    }
    public function validateGender()
    {
        if ($this->getGender() === null || empty($this->getGender())) {
            return $this->errors['gender-required'] = $this->required;
        }
    }
}


if ($_POST) {
    // Delete request
    if (isset($_POST['delete-form'])) {
        $userToBeDeleted = new UsersRequest;
        $userToBeDeleted->setId($_POST['id']);
        $userToBeDeleted->delete();
        $_SESSION['delete-success'] = "User deleted successfully";
        header("location:../../index.php");
    }
    // show user by id
    elseif (isset($_POST['show-by-id-form'])) {
        $_SESSION['show-user-id'] = $_POST['id'];
        header("location:../../show-user.php");
    }
    // get the update form
    elseif (isset($_POST['update-form'])) {
        $_SESSION['edit-user-id'] = $_POST['id'];
        header("location:../../edit-user.php");
    }
    // submit the update form
    elseif (isset($_POST['update-submit-btn'])) {
        $user = new UsersRequest;
        $user->setId($_POST['id']);
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        isset($_POST['gender']) ? $user->setGender($_POST['gender']) : $user->setGender(null);
        isset($_POST['check-agree']) ? $user->setEmail_status($_POST['check-agree']) : $user->setEmail_status('false');

        $_SESSION['old-values'] = $_POST;

        $user->validateName();
        $user->validateEmail();
        $user->validateGender();

        if ($user->getErrors()) {
            foreach ($user->getErrors() as $key => $value) {
                $fieldName = substr($key, 0, strpos($key, '-'));
                $_SESSION['validation']["$fieldName-validation"]["$key"] = $value;
            }
            header("location:../../edit-user.php");
        } else {
            $_SESSION['update-success'] = "Element Updated successfully!";
            $user->update();
            header("location:../../index.php");
        }
    }
    // create form
    elseif (isset($_POST['add-form'])) {
        $user = new UsersRequest;
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        isset($_POST['gender']) ? $user->setGender($_POST['gender']) : $user->setGender(null);
        isset($_POST['check-agree']) ? $user->setEmail_status($_POST['check-agree']) : $user->setEmail_status('false');

        $_SESSION['old-values'] = $_POST;

        $user->validateName();
        $user->validateEmail();
        $user->validateGender();

        if ($user->getErrors()) {
            foreach ($user->getErrors() as $key => $value) {
                $fieldName = substr($key, 0, strpos($key, '-'));
                $_SESSION['validation']["$fieldName-validation"]["$key"] = $value;
            }
            header("location:../../add-user.php");
        } else {
            $_SESSION['add-success'] = "New element added successfully!";
            $user->create();
            header("location:../../index.php");
        }
    }
}
