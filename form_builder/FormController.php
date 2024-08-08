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
            // Insert form
            $stmt = $this->conn->prepare("INSERT INTO forms_master (user_id, form_name, created_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("is", $userId, $formName);
            if (!$stmt->execute()) {
                throw new Exception('Form insert failed: ' . $stmt->error);
            }
            $formId = $stmt->insert_id;
            $stmt->close();
    
            // Insert form fields
            $stmt = $this->conn->prepare("INSERT INTO formfield_master (form_id, field_name, field_type, created_at) VALUES (?, ?, ?, NOW())");
            foreach ($formData as $field) {
                $fieldName = $field['label'];
                $fieldType = $field['type'];
    
                $stmt->bind_param("iss", $formId, $fieldName, $fieldType);
                if (!$stmt->execute()) {
                    throw new Exception('Form field insert failed: ' . $stmt->error);
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
        if (!isset($_SESSION['id'])) {
            echo "User not logged in.";
            return;
        }
        $qry = "SELECT * FROM formfield_master";
        $res = mysqli_query($this->conn, $qry);
        if(!$res){
            echo "Error: " . $this->conn->error;
            return;
        }else{
            $row = mysqli_fetch_array($res);
            $formId = $row['form_id'];
                // echo $formId;
                // echo $userId;
        }
        // Retrieve form details and fields for the logged-in user
        $query = "

           SELECT ff.id, ff.field_name, ff.field_type
            FROM formfield_master ff
            WHERE ff.form_id = ?
        ";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $this->conn->error;
            return;
        }
    
        $stmt->bind_param("i", $formId);
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
            echo "No forms found for this user.";
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

    public function displayAllForms() {
        if (!isset($_SESSION['id'])) {
            echo "User not logged in.";
            return;
        }
    
        $userId = $_SESSION['id'];
    
        // Get all forms for the logged-in user
        $query = "
            SELECT f.id, f.form_name
            FROM forms_master f
            WHERE f.user_id = ?

            
        ";
    
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            echo "Error preparing statement: " . $this->conn->error;
            return;
        }
    
        $stmt->bind_param("i", $userId);
        if (!$stmt->execute()) {
            echo "Error executing statement: " . $stmt->error;
            return;
        }
    
        $stmt->bind_result($formId, $formName);
    
        echo '<h1>Your Forms</h1>';
        echo '<ul>';
        while ($stmt->fetch()) {
            echo "<li><a href='?id=$formId'>$formName</a></li>";
        }        
        echo '</ul>';
    
        if ($stmt->num_rows === 0) {
            echo "No forms found.";
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
            // Update form name
            $stmt = $this->conn->prepare("UPDATE forms_master SET form_name = ? WHERE id = ?");
            $stmt->bind_param("si", $formName, $formId);
            if (!$stmt->execute()) {
                throw new Exception('Form update failed: ' . $stmt->error);
            }
            $stmt->close();
    
            // Delete old fields
            $stmt = $this->conn->prepare("DELETE FROM formfield_master WHERE form_id = ?");
            $stmt->bind_param("i", $formId);
            if (!$stmt->execute()) {
                throw new Exception('Form field delete failed: ' . $stmt->error);
            }
            $stmt->close();
    
            // Insert updated fields
            $stmt = $this->conn->prepare("INSERT INTO formfield_master (form_id, field_name, field_type, created_at) VALUES (?, ?, ?, NOW())");
            foreach ($formData as $field) {
                $fieldName = $field['label'];
                $fieldType = $field['type'];
    
                $stmt->bind_param("iss", $formId, $fieldName, $fieldType);
                if (!$stmt->execute()) {
                    throw new Exception('Form field update failed: ' . $stmt->error);
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
    $formController = new FormController();

    if (!isset($_GET['id'])) {
        // display all forms for the logged-in user
        $formController->displayAllForms();
    } else {
        // If a specific form ID is provided, display that form
        $formId = intval($_GET['id']);
        $formController->displayForm($formId);
    }
}

?>
