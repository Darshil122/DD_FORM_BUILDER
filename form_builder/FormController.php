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
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
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

        $stmt = $this->conn->prepare("INSERT INTO forms_master (user_id, form_name) VALUES (?, ?)");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $this->conn->error]);
            return;
        }

        $stmt->bind_param("is", $userId, $formName);

        if ($stmt->execute()) {
            $formId = $stmt->insert_id;
            $stmt->close();

            $stmtField = $this->conn->prepare("INSERT INTO formFields_master (form_id, field_name, field_type) VALUES (?, ?, ?)");
            if ($stmtField === false) {
                echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $this->conn->error]);
                return;
            }

            foreach ($formData as $field) {
                $fieldName = $field['label'];
                $fieldType = $field['type'];
                $stmtField->bind_param("iss", $formId, $fieldName, $fieldType);

                if (!$stmtField->execute()) {
                    echo json_encode(['success' => false, 'error' => 'Execute failed: ' . $stmtField->error]);
                    return;
                }
            }

            $stmtField->close();
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Execute failed: ' . $stmt->error]);
        }
    }

    public function displayForm($formId) {
        $stmt = $this->conn->prepare("SELECT form_name FROM forms_master WHERE id = ?");
        $stmt->bind_param("i", $formId);
        $stmt->execute();
        $stmt->bind_result($formName);

        if ($stmt->fetch()) {
            echo "<h1>$formName</h1>";
        } else {
            echo "Form not found.";
            $stmt->close();
            return;
        }

        $stmt->close();

        $stmtFields = $this->conn->prepare("SELECT field_name, field_type FROM formFields_master WHERE form_id = ?");
        $stmtFields->bind_param("i", $formId);
        $stmtFields->execute();
        $stmtFields->bind_result($fieldName, $fieldType);

        echo '<form>';
        while ($stmtFields->fetch()) {
            echo "<div class='form-field'>";
            echo "<label>$fieldName</label>";
            if ($fieldType == 'textarea') {
                echo "<textarea placeholder='$fieldName'></textarea>";
            } else {
                echo "<input type='$fieldType' placeholder='$fieldName'>";
            }
            echo "</div>";
        }
        echo '</form>';

        $stmtFields->close();
    }
}

// Example usage:
// Assuming you have a form that posts JSON data to saveForm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formController = new FormController();
    $formController->saveForm();
}
?>
