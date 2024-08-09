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
            echo $formId;
        }        
        echo '</ul>';
    
        if ($stmt->num_rows === 0) {
            echo "No forms found.";
        }
    
        $stmt->close();
    }
    // READ - Display a form
    public function displayForm($formId) {
        $userId = $_SESSION['id'];
        if (!$userId) {
            echo "User not logged in.";
            return; // Ensure no further code is executed if the user is not logged in
        }
        
        $ffqry = "SELECT field_name, field_type FROM formfield_master WHERE form_id = $formId";
        $exc = mysqli_query($this->conn, $ffqry);
        
        if (!$exc) {
            echo "Error executing query: " . mysqli_error($this->conn);
            return; // Ensure no further code is executed if the query fails
        }
        
        $formfield = [];
        while ($row = mysqli_fetch_assoc($exc)) {
            // Extract values from $row
            $fieldName = $row['field_name'];
            $fieldType = $row['field_type'];
            
            // Add the field information to the formfield array
            $formfield[] = ['field_name' => $fieldName, 'field_type' => $fieldType];
        }
        
        if (empty($formfield)) {
            echo "Form not found.";
        } else {
            echo '<form>';
            foreach ($formfield as $field) {
                echo "<div class='form-group row mx-4 mt-3'>";
                echo "<label>{$field['field_name']}:</label>";
                if ($field['field_type'] == 'textarea') {
                    echo "<textarea placeholder='{$field['field_name']}'></textarea>";
                } else {
                    echo "<input type='{$field['field_type']}' class='form-control' placeholder='{$field['field_name']}'>";
                }
                echo "</div>";
            }
            echo '</form>';
        }
    }
    
    

   
}

// Handle POST request to save a form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formController = new FormController();
    $formController->saveForm();
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
