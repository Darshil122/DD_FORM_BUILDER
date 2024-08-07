<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    // CREATE - Save a new form
    public function saveForm() {
        if (!isset($_SESSION['id'])) {
            echo json_encode(['success' => false, 'error' => 'User not logged in.']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $formName = $data['formName'];
        $formData = $data['formData'];
        $userId = $_SESSION['id'];  

        if (empty($formName) || empty($formData)) {
            echo json_encode(['success' => false, 'error' => 'Form name or data is empty.']);
            return;
        }

        $this->conn->begin_transaction();
        try {
            $stmt = $this->conn->prepare("INSERT INTO forms_master (user_id, form_name, field_name, field_type, created_at) VALUES (?, ?, ?, ?, NOW())");
            foreach ($formData as $field) {
                $fieldName = $field['label'];
                $fieldType = $field['type'];    

                $stmt->bind_param("isss", $userId, $formName, $fieldName, $fieldType);
                if (!$stmt->execute()) {
                    throw new Exception('Form insert failed: ' . $stmt->error);
                }
            }
            $this->conn->commit();
            $stmt->close();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            $this->conn->rollback();
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    
    // READ - Display a form
    public function displayForm($formId) {
        $userId = $_SESSION['id']; 
        $sql = "SELECT * FROM forms_master WHERE user_id = '$userId'";
        // $sql="SELECT * FROM forms_master where user_id = '$userId'";
            $result = mysqli_query($this ->conn,$sql);
            $id = mysqli_fetch_array($result);
            if ($id>0) {
                $_SESSION['id'] = $id[0];
                $formId = $_SESSION['id'];
            }
            
        if (!isset($userId)) {
            echo "User not logged in.";
            return;
        }
    
        // $userId = $_SESSION['id'];
        
        // Debugging code
        echo "Form ID: " . htmlspecialchars($formId) . "<br>";
        echo "User ID: " . htmlspecialchars($userId) . "<br>";
    
        
        $query = "

             SELECT u.email, f.form_name, f.field_name, f.field_type
            FROM user_master u
            LEFT JOIN forms_master f ON u.id = f.user_id
            WHERE u.id = ? AND f.user_id = ?
            ";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $this->conn->error;
            return;
        }
    
        $stmt->bind_param("ii", $formId, $userId );
        if (!$stmt->execute()) {
            echo "Error executing statement: " . $stmt->error;
            return;
        }
    
        $stmt->bind_result($formName, $fieldName, $fieldType);
    
        $formFields = [];
        $formNameFetched = false;
    
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
        } else {
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
    
        $stmt->close();
    }
    
    
    // UPDATE - Update an existing form
    public function updateForm($formId) {
        $data = json_decode(file_get_contents('php://input'), true);
        $formName = $data['formName'];
        $formData = $data['formData'];

        if (empty($formName) || empty($formData)) {
            echo json_encode(['success' => false, 'error' => 'Form name or data is empty.']);
            return;
        }

        $this->conn->begin_transaction();
        try {
            // Delete existing fields
            $stmt = $this->conn->prepare("DELETE FROM forms_master WHERE id = ?");
            $stmt->bind_param("i", $formId);
            if (!$stmt->execute()) {
                throw new Exception('Form delete failed: ' . $stmt->error);
            }
            $stmt->close();

            // Insert updated fields
            $stmt = $this->conn->prepare("INSERT INTO forms_master (user_id, form_name, field_name, field_type, created_at) VALUES (?, ?, ?, ?, NOW())");
            $userId = $_SESSION['id'];
            foreach ($formData as $field) {
                $fieldName = $field['label'];
                $fieldType = $field['type'];

                $stmt->bind_param("isss", $userId, $formName, $fieldName, $fieldType);
                if (!$stmt->execute()) {
                    throw new Exception('Form update failed: ' . $stmt->error);
                }
            }
            $this->conn->commit();
            $stmt->close();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            $this->conn->rollback();
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // DELETE - Delete a form
    public function deleteForm($formId) {
        $stmt = $this->conn->prepare("DELETE FROM forms_master WHERE id = ?");
        $stmt->bind_param("i", $formId);
        if (!$stmt->execute()) {
            echo json_encode(['success' => false, 'error' => 'Form delete failed: ' . $stmt->error]);
            return;
        }
        $stmt->close();
        echo json_encode(['success' => true]);
    }
}

// Example usage:
// Handle POST request to save a form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formController = new FormController();
    $formController->saveForm();
}

// Handle PUT request to update a form
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $formId = $_GET['id'] ?? 0; 
    $formController = new FormController();
    $formController->updateForm($formId);
}

// Handle DELETE request to delete a form
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $formId = $_GET['id'] ?? 0; 
    $formController = new FormController();
    $formController->deleteForm($formId);
}

// Handle GET request to display a form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $formId = $_GET['id'] ?? 0; 
    $formController = new FormController();
    $formController->displayForm($formId);
}
?>
