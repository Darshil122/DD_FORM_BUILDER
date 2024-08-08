<?php
// routes.php

require 'FormController.php';

$formController = new FormController();

if (isset($formId) && $formId !== null) {
    // $formController->displayForm($formId); // Fetch and display the form based on the formID
} else {
    echo "route page";
    // echo "Form ID is not provided.";
}
?>
