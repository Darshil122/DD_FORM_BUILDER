<?php
require 'FormController.php';

$controller = new FormController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'saveForm') {
    $controller->saveForm();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'displayForm') {
    $formId = $_GET['form_id'];
    $controller->displayForm($formId);
} else {
    echo "Invalid action.";
}
?>
