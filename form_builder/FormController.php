<?php

class FormController {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form_builders";

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
    
        if (empty($formName) || empty($formData)) {
            echo json_encode(['success' => false, 'error' => 'Form name or data is empty.']);
            return;
        }
    
        $stmt = $this->conn->prepare("INSERT INTO forms_master (form_name, form_fields) VALUES (?, ?)");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $this->conn->error]);
            return;
        }
    
        $jsonFormData = json_encode($formData);
        $stmt->bind_param("ss", $formName, $jsonFormData);
    
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Execute failed: ' . $stmt->error]);
        }
    
        $stmt->close();
    }
    

    public function displayForm($formId) {
        $stmt = $this->conn->prepare("SELECT form_name, form_fields FROM forms_master WHERE id = ?");
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