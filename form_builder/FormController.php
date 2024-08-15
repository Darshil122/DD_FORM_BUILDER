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
            // Insert form_master
            $stmt = $this->conn->prepare("INSERT INTO forms_master (user_id, form_name, created_at) VALUES (?, ?, NOW())");
            $stmt->bind_param("is", $userId, $formName);
            if (!$stmt->execute()) {
                throw new Exception('Form insert failed: ' . $stmt->error);
            }
            $formId = $stmt->insert_id;
            $stmt->close();
    
            // Insert formfields_master
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
    
        echo "<div class='container'>";
        echo '<h1>Your Forms</h1>';
        echo "<ul class='mt-1 row d-flex justify-content-center'>";
        while ($stmt->fetch()) {
            echo "<li class='navbar-nav col-7'><button class='mt-5 btn btn-light py-4'>
            <div class='col'>
                <li>
            <p class='float-left px-2 h5'>$formName</p>
        </li>
         <li class='float-right px-2'>
                <a href='?id=$formId'><i class='fas fa-eye'></i></a>&nbsp;&nbsp;<i class='fas fa-edit'></i>
                <a class='btn delete-form' data-id='$formId' data-toggle='modal' data-target='#confirmDeleteModal'><i class='fas fa-trash'></i></a>
            </li>
        </div>
            </button></li>";
        }        
        echo '</ul>';
        echo '</div>';

        if ($stmt->num_rows === 0) {
            echo "No forms found.";
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
        
        $exc = mysqli_query($this->conn, $qry);
        
        if (!$exc) {
            echo "Error executing query: " . mysqli_error($this->conn);
            return;
        }
        
        $formfield = [];
        $formName = '';
        
        while ($row = mysqli_fetch_assoc($exc)) {

            if (empty($formName)) {
                $formName = $row['form_name'];
            }
  
            $formfield[] = [
                'field_name' => $row['field_name'],
                'field_type' => $row['field_type']
            ];
        }
        
        if (empty($formfield)) {
            echo "Form not found.";
        } else {
            echo "<div class='container'>
                    <div class = 'row justify-content-center'>";
            echo "<h1 class = 'mt-4'>{$formName}</h1>
                    </div>";
            echo "<form class = 'row justify-content-center'>";
            foreach ($formfield as $field) {
                echo "<div class='col-6 form-group mx-4 mt-3'>";
                echo "<label>{$field['field_name']}:</label>";
                if ($field['field_type'] == 'textarea') {
                    echo "<textarea class='form-control' cols = '15' rows = '4' placeholder='{$field['field_name']}'></textarea>";
                } else {
                    echo "<input type='{$field['field_type']}' class='form-control' placeholder='{$field['field_name']}'>";
                }
                echo "</div>";
            }
            echo '</form>
                </div>';

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
    $formController = new FormController();
    $formController->saveForm();
}

// Handle DELETE request to delete a form
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $formId = $data['id'] ?? 0; 
    $formController = new FormController();
    $formController->deleteForm($formId);
}

// Handle GET request to display a form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $formController = new FormController();

    if (!isset($_GET['id'])) {
        $formController->displayAllForms();
    } else {
        $formId = intval($_GET['id']);
        $formController->displayForm($formId);
    }
}

?>