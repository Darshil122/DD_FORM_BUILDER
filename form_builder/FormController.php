<?php
session_start();

class FormController {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form_builders";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    public function saveForm() {
        // Check if user is logged in
        if (!isset($_SESSION['id'])) {
            echo json_encode(['success' => false, 'error' => 'User not logged in.']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $formName = $data['formName'];
        $formData = $data['formData'];
        $userId = $_SESSION['id'];  // Get user ID from session

        if (empty($formName) || empty($formData)) {
            echo json_encode(['success' => false, 'error' => 'Form name or data is empty.']);
            return;
        }

        // Insert form into forms_master
        $stmt = $this->conn->prepare("INSERT INTO forms_master (user_id, form_name) VALUES (?, ?)");
        $stmt->bind_param("is", $userId, $formName);
        if (!$stmt->execute()) {
            echo json_encode(['success' => false, 'error' => 'Form insert failed: ' . $stmt->error]);
            return;
        }

        // Get the inserted form ID
        $formId = $stmt->insert_id;
        $stmt->close();

        // Insert form fields into formfields_master
        foreach ($formData as $field) {
            $fieldName = $field['label'];
            $fieldType = $field['type'];

            $stmtField = $this->conn->prepare("INSERT INTO formfields_master (form_id, field_name, field_type) VALUES (?, ?, ?)");
            $stmtField->bind_param("iss", $formId, $fieldName, $fieldType);
            if (!$stmtField->execute()) {
                echo json_encode(['success' => false, 'error' => 'Field insert failed: ' . $stmtField->error]);
                return;
            }
        }

        echo json_encode(['success' => true]);
    }

    public function displayForm($formId) {
        // Prepare the query
        $query = "
            SELECT f.form_name, ff.field_name, ff.field_type 
            FROM forms_master f
            LEFT JOIN formfields_master ff ON f.form_id = ff.form_id
            WHERE f.form_id = ?
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $formId);
        $stmt->execute();
        $stmt->bind_result($formName, $fieldName, $fieldType);

        $formFields = [];
        $formNameFetched = false;

        // Fetch form name and fields
        while ($stmt->fetch()) {
            if (!$formNameFetched) {
                echo "<h1>$formName</h1>";
                $formNameFetched = true;
            }
            if ($fieldName) {
                $formFields[] = ['fieldName' => $fieldName, 'fieldType' => $fieldType];
            }
        }

        if (empty($formFields)) {
            echo "Form not found.";
            $stmt->close();
            return;
        }

        $stmt->close();

        // Display the form fields
        echo '<form>';
        foreach ($formFields as $field) {
            echo "<div class='form-field'>";
            echo "<label>{$field['fieldName']}</label>";
            if ($field['fieldType'] == 'textarea') {
                echo "<textarea placeholder='{$field['fieldName']}'></textarea>";
            } else {
                echo "<input type='{$field['fieldType']}' placeholder='{$field['fieldName']}'>";
            }
            echo "</div>";
        }
        echo '</form>';
    }
}

// Example usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formController = new FormController();
    $formController->saveForm();
}
?>
