<?php

class Controller
{
    private $con;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form_builders";

        // Create connection
        $this->con = new mysqli($servername, $username, $password, $dbname);

        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }

    // Function to get all users
    public function getAllUsers()
    {
        $query = "SELECT * FROM user_master";
        $result = mysqli_query($this->con, $query);

        $users = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
        }
        return $users;
    }

    // Function to get all forms
    public function getAllForms()
    {
        $query = "SELECT * FROM forms_master";
        $result = mysqli_query($this->con, $query);

        $forms = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $forms[] = $row;
            }
        }
        return $forms;
    }

    // Function to get all feedbacks
    public function getAllFeedbacks()
    {
        $query = "SELECT * FROM feedback_master";
        $result = mysqli_query($this->con, $query);

        $feedbacks = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $feedbacks[] = $row;
            }
        }
        return $feedbacks;
    }
}

$Controller = new Controller();

// Get all users
$users = $Controller->getAllUsers();
$userCount = count($users);

// Get all forms
$forms = $Controller->getAllForms();
$formCount = count($forms);

// Get all feedback
$feedbacks = $Controller->getAllFeedbacks();
$feedbackCount = count($feedbacks);

?>
