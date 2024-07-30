<?php

class FormController {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "formbuilder";

        // Create connection
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn) {
            echo "success";
        }else{
        die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function saveForm() {
        $data = json_decode(file_get_contents('php://input'), true);
        $formName = $data['formName'];
        $formData = $data['formData'];

        $stmt = $this->conn->prepare("INSERT INTO forms (name, fields) VALUES (?, ?)");
        $stmt->bind_param("ss", $formName, json_encode($formData));

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }

        $stmt->close();
    }

    public function displayForm($formId) {
        $stmt = $this->conn->prepare("SELECT name, fields FROM forms WHERE id = ?");
        $stmt->bind_param("i", $formId);
        $stmt->execute();
        $stmt->bind_result($formName, $formFields);

        if ($stmt->fetch()) {
            $formFields = json_decode($formFields, true);
            echo "<h1>$formName</h1>";
            echo '<form>';
            foreach ($formFields as $field) {
                $label = $field['label'];
                $type = $field['type'];
                $placeholder = $field['placeholder'];
                echo "<div class='form-field'>";
                echo "<label>$label</label>";
                if ($type == 'textarea') {
                    echo "<textarea placeholder='$placeholder'></textarea>";
                } else {
                    echo "<input type='$type' placeholder='$placeholder'>";
                }
                echo "</div>";
            }
            echo '</form>';
        } else {
            echo "Form not found.";
        }

        $stmt->close();
    }
}
?>