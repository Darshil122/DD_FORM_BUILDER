<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Controller {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form_builders";

        // Create connection
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        $this->conn->close();
    }

    // CREATE new form
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
            // Insert into forms_master
            $stmt = $this->conn->prepare("INSERT INTO forms_master (user_id, form_name, created_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("is", $userId, $formName);
            if (!$stmt->execute()) {
                throw new Exception('Form insert failed: ' . $stmt->error);
            }
            $formId = $stmt->insert_id;
            $stmt->close();
    
            // Insert into formfield_master
            $stmt = $this->conn->prepare("INSERT INTO formfield_master (form_id, field_name, field_type, field_options, created_at) VALUES (?, ?, ?, ?, NOW())");
            foreach ($formData as $field) {
                $fieldName = $field['label'];
                $fieldType = $field['type'];
                $fieldOptions = null;
    
                // Handle radio, checkbox, and dropdown options
                if (in_array($fieldType, ['radio', 'checkbox', 'select']) && isset($field['options'])) {
                    $fieldOptions = json_encode($field['options']); // Store options as JSON string
                }
    
                $stmt->bind_param("isss", $formId, $fieldName, $fieldType, $fieldOptions);
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
    
    
    
    // display form name
    public function displayAllForms() {
        if (!isset($_SESSION['id'])) {
            echo "User not logged in.";
            return;
        }
    
        $userId = $_SESSION['id'];
    
        // Get all forms for the logged-in user
        $query = "SELECT f.id, f.form_name FROM forms_master f WHERE f.user_id = ?";
    
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
    
        echo "<div class='container'>
                <h1 style='margin-top:70px;'>Form List</h1>";
        echo "<ul class='mb row d-flex justify-content-center'>";
        while ($stmt->fetch()) {
            echo "<li class='navbar-nav col-lg-7'><button class='mt-5 btn btn-light py-4'>
            <div class='col'>
                <li>
            <p class='float-left px-2 h5'>$formName</p>
        </li>
         <li class='float-right px-2'>
                <a href='?id=$formId' class='btn' data-id='$formId'><i class='fas fa-eye'></i></a>&nbsp;&nbsp;<i class='fas fa-edit'></i>
                <a class='btn delete-form' data-id='$formId' data-toggle='modal' data-target='#confirmDeleteModal'><i class='fas fa-trash'></i></a>
            </li>
        </div>
            </button></li>";
        }        


        if ($stmt->num_rows === 0) {
            echo "<h2>Form Banay Pela.</h2>";
            echo '</ul>';
            echo '</div>';
        }
    
        $stmt->close();

        echo '
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete this form?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
              </div>
            </div>
          </div>
        </div>
        ';
    }
    // Display a form
    public function displayForm($formId) {
        $userId = $_SESSION['id'];
        if (!$userId) {
            echo "User not logged in.";
            return;
        }

        $qry = "SELECT fm.form_name, ff.field_name, ff.field_type FROM forms_master
            fm JOIN formfield_master ff ON fm.id = ff.form_id WHERE fm.id = $formId";
        
        $res = mysqli_query($this->conn, $qry);
        
        if (!$res) {
            echo "Error executing query: " . mysqli_error($this->conn);
            return;
        }
        
        $formfield = [];
        $formName = '';
        
        while ($row = mysqli_fetch_assoc($res)) {

            if (empty($formName)) {
                $formName = $row['form_name'];
            }
  
            $formFields[] = [
                'field_name' => $row['field_name'],
                'field_type' => $row['field_type'],
            ];
        }
    
        if (empty($formFields)) {
            echo "No form found.";
        } else {
            echo "<div class='container'>
                    <div class='mt-5 row justify-content-center'>
                    <h1>{$formName}</h1>
                    </div>";
            echo "<form class='row justify-content-center mb'>";
            
            foreach ($formFields as $field) {
                echo "<div class='col-6 form-group mx-4 mt-3'>";
                echo "<label for='{$field['field_name']}'>{$field['field_name']}:</label>";
                
                switch ($field['field_type']) {
                    case 'textarea':
                        echo "<textarea class='form-control' cols='15' rows='4' placeholder='{$field['field_name']}'></textarea>";
                        break;
                    case 'radio':
                        echo "<br><input type='radio' name='{$field['field_type']}' value='Option 1'> Option 1<br>";
                        echo "<input type='radio' name='{$field['field_type']}' value='Option 2'> Option 2";
                        break;
                    case 'checkbox':
                        echo "<br><input type='checkbox' name='{$field['field_name']}' value='Option 1'> Option 1<br>";
                        echo "<input type='checkbox' name='{$field['field_name']}' value='Option 2'> Option 2";
                        break;
                    default:
                        echo "<input type='{$field['field_type']}' class='form-control' placeholder='{$field['field_name']}' reuired>";
                        break;
                }
                echo "</div>";
            }
            
            echo "</form></div>";
        }
    }

    public function deleteForm($formId) {
        if (!isset($_SESSION['id'])) {
            echo json_encode(['success' => false, 'error' => 'User not logged in.']);
            return;
        }

        $userId = $_SESSION['id'];

        // Delete form fields
        $stmt = $this->conn->prepare("DELETE FROM formfield_master WHERE form_id = ?");
        $stmt->bind_param("i", $formId);
        if (!$stmt->execute()) {
            echo json_encode(['success' => false, 'error' => 'Failed to delete form fields.']);
            return;
        }
        $stmt->close();

        // Delete the form
        $stmt = $this->conn->prepare("DELETE FROM forms_master WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $formId, $userId);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete form.']);
        }
        $stmt->close();
    }
}

// Handle POST request to save a form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Controller = new Controller();
    $Controller->saveForm();
}

// Handle DELETE request to delete a form
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $formId = $data['id'] ?? 0; 
    $Controller = new Controller();
    $Controller->deleteForm($formId);
}

// Handle GET request to display a form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $Controller = new Controller();

    if (!isset($_GET['id'])) {
        $Controller->displayAllForms();
    } else {
        $formId = intval($_GET['id']);
        $Controller->displayForm($formId);
    }
}

?>