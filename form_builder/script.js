document.addEventListener("DOMContentLoaded", () => {
  console.log("==> DOMContentLoaded :");
  const draggables = document.querySelectorAll(".draging");
  const formArea = document.getElementById("form-area");

  draggables.forEach((draggable) => {
    draggable.addEventListener("dragstart", handleDragStart);
  });

  formArea.addEventListener("dragover", handleDragOver);
  formArea.addEventListener("drop", handleDrop);

  new Sortable(formArea, {
    animation: 150,
    ghostClass: "sortable-ghost",
  });

  function handleDragStart(event) {
    // console.log("==> event:",event)
    event.dataTransfer.setData("text/plain", event.target.dataset.type);
  }

  function handleDragOver(event) {
    event.preventDefault();
  }

  function handleDrop(event) {
    event.preventDefault();
    const fieldType = event.dataTransfer.getData("text/plain");
    addFieldToFormArea(fieldType);
  }

  function addFieldToFormArea(fieldType) {
    // console.log("=> fieldType",fieldType);
    let fieldHTML = "";
    const fieldName = `field_${Date.now()}`; // Unique name

    switch (fieldType) {
      case "text":
        fieldHTML = getTextFieldHTML(fieldName);
        break;
      case "number":
        fieldHTML = getNumberFieldHTML();
        break;
      case "email":
        fieldHTML = getEmailFieldHTML();
        break;
      case "password":
        fieldHTML = getPasswordFieldHTML();
        break;
      case "radio":
        fieldHTML = getRadioFieldHTML();
        break;
      case "dropdown":
        fieldHTML = getDropdownFieldHTML();
        break;
      case "message":
        fieldHTML = getMessageFieldHTML();
        break;
      case "checkbox":
        fieldHTML = getCheckboxFieldHTML();
        break;
      case "date":
        fieldHTML = getDateFieldHTML();
        break;
      case "time":
        fieldHTML = getTimeFieldHTML();
        break;
      case "datetime":
        fieldHTML = getDateTimeFieldHTML();
        break;
      case "week":
        fieldHTML = getWeekFieldHTML();
        break;
      case "button":
        fieldHTML = getBtnFieldHTML();
        break;
      case "submit":
        fieldHTML = getSubmitBtnFieldHTML();
        break;
      case "reset":
        fieldHTML = getResetBtnFieldHTML();
        break;

      default:
        console.error("Unknown field type:", fieldType);
    }

    // Insert the HTML into the form area
    formArea.insertAdjacentHTML(
      "beforeend",
      `<div data-type="${fieldType}">${fieldHTML}</div>`
    );
    console.log(fieldType);
  }

  // Helper function to create a field template
  // Function to create the form field template
  function createFieldTemplate(label, inputHTML) {
    return `
      <div class="form-field dragg" draggable="true">
          <label class="form-label">
              <input type="text" class="label-input" value="${label}">
              <i class="far fa-trash-alt delete-icon"></i>
          </label>
          ${inputHTML}
      </div>
    `;
  }

  // Event delegation to handle dynamically created elements
document.addEventListener('click', function(event) {
  if (event.target.classList.contains('delete-icon')) {
    const formField = event.target.closest('.form-field');
    formField.remove(); // Removes the entire field container
  }
});

  

  function createButtonFieldTemplate(buttonHTML) {
    return `
      <div class="form-field button-field dragg" draggable="true">
        ${buttonHTML}
      </div>
    `;
  }

  // HTML generation functions for different field types
  function getTextFieldHTML() {
    return createFieldTemplate(
      "Text Field",
      '<input type="text" class="form-control" placeholder="Enter text">'
    );
  }

  function getNumberFieldHTML() {
    return createFieldTemplate(
      "Number Field",
      '<input type="number" class="form-control" placeholder="Enter number">'
    );
  }

  function getEmailFieldHTML() {
    return createFieldTemplate(
      "Email Field",
      '<input type="email" class="form-control" placeholder="Enter email">'
    );
  }

  function getPasswordFieldHTML() {
    return createFieldTemplate(
      "Password Field",
      '<input type="password" class="form-control" placeholder="Enter password">'
    );
  }

  function getRadioFieldHTML() {
    return createFieldTemplate(
      "Radio Field",
      `
<div class="radio-field">
  <input type="radio" name="radio" value="option1">
  <label>Option 1</label>
</div>
<div class="radio-field">
  <input type="radio" name="radio" value="option2">
  <label>Option 2</label>
</div>
`
    );
  }

  function getDropdownFieldHTML() {
    return createFieldTemplate(
      "Dropdown List",
      `
<select class="form-control">
  <option value="1">Option 1</option>
  <option value="2">Option 2</option>
</select>
`
    );
  }

  function getMessageFieldHTML() {
    return createFieldTemplate(
      "Message Field",
      '<textarea class="form-control" rows="4" placeholder="Enter message"></textarea>'
    );
  }

  function getCheckboxFieldHTML() {
    return createFieldTemplate(
      "Checkbox Field",
      `
<input type="checkbox" value="1"> Checkbox 1<br>
<input type="checkbox" value="2"> Checkbox 2
`
    );
  }

  function getDateFieldHTML() {
    return createFieldTemplate(
      "Date Field",
      '<input type="date" class="form-control">'
    );
  }

  function getTimeFieldHTML() {
    return createFieldTemplate(
      "Time Field",
      '<input type="time" class="form-control">'
    );
  }

  function getDateTimeFieldHTML() {
    return createFieldTemplate(
      "Date Time Field",
      '<input type="datetime-local" class="form-control">'
    );
  }

  function getWeekFieldHTML() {
    return createFieldTemplate(
      "Week Field",
      '<input type="week" class="form-control">'
    );
  }

  function getBtnFieldHTML() {
    return createButtonFieldTemplate(
      `
      <div class="button-options">
        <!-- Button to toggle collapse -->
        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#btnOptionsCollapse${Date.now()}" aria-expanded="false" aria-controls="btnOptionsCollapse">
          Button Options
          <i class="fas fa-chevron-down"></i> <!-- Icon for down arrow -->
        </button>
        
        <!-- Collapsible section -->
        <div class="collapse mt-3" id="btnOptionsCollapse${Date.now()}">
          <label>Button Text: </label>
          <input type="text" class="form-control button-text" value="Click Me" placeholder="Enter Button Text">
          
          <label>Button Type: </label>
          <select class="form-control button-type">
            <option value="button">Button</option>
            <option value="submit">Submit</option>
            <option value="reset">Reset</option>
          </select>
          
          <label>Button Style: </label>
          <select class="form-control button-style">
            <option value="btn-primary">Primary</option>
            <option value="btn-secondary">Secondary</option>
            <option value="btn-success">Success</option>
            <option value="btn-danger">Danger</option>
            <option value="btn-warning">Warning</option>
            <option value="btn-info">Info</option>
          </select>
        </div>
      </div>
    
      <!-- Preview button -->
      <input type="button" class="btn btn-primary button-preview mt-3" value="Click Me">
      `
    );
  }
  
  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('editBtn')) {
      // Gather all form data before redirect
      const formFields = Array.from(formArea.children).map((field) => {
        const inputElement = field.querySelector("input, textarea, select");
        const labelElement = field.querySelector(".label-input");
        const fieldType = field.dataset.type;
        console.log(fieldType);

        let options = null;
        let buttonDetails = null;

        if (fieldType === "dropdown") {
          options = Array.from(field.querySelector("select").options).map((option) => option.value);
        } else if (fieldType === "button") {
          buttonDetails = {
            text: field.querySelector('.button-text').value,
            type: field.querySelector('.button-type').value,
            style: field.querySelector('.button-style').value,
          };
        }

        return {
          label: labelElement ? labelElement.value : "",
          type: fieldType,
          name: inputElement ? inputElement.name : "",
          options: options,
          buttonDetails: buttonDetails
        };
      });

      // Serialize form data to JSON
      const formData = JSON.stringify({
        formName: document.getElementById("formName").value,
        formData: formFields,
      });

      // Save form data in local storage (or send it via URL query string)
      localStorage.setItem('formData', formData);

      // Redirect to index page
      window.location.href = "index.php"; // Adjust this path as needed
    }
  });


  formArea.addEventListener('input', (event) => {
    const field = event.target.closest('.form-field');
    
    if (field && field.classList.contains('button-field')) {
      const buttonText = field.querySelector('.button-text').value;
      const buttonType = field.querySelector('.button-type').value;
      const buttonStyle = field.querySelector('.button-style').value;
      const buttonPreview = field.querySelector('.button-preview');
      
      // Update button preview text
      buttonPreview.value = buttonText;
      
      // Update button type
      buttonPreview.setAttribute('type', buttonType);
      
      // Update button style
      buttonPreview.className = `btn ${buttonStyle} button-preview`;
    }
  });
  
  const formNameInput = document.getElementById("formName");
  const formDataInput = document.getElementById("form_data");

  function createForm() {
    const formName = formNameInput.value;
    if (!formName) {
      alert("Please enter a form name.");
      return;
    }

    const formFields = Array.from(formArea.children).map((field) => {
      const inputElement = field.querySelector("input, textarea, select");
      const labelElement = field.querySelector(".label-input");
  
      const fieldType = field.dataset.type;
  
      let options = null;
      let buttonDetails = null;
  
      if (fieldType === "dropdown") {
        options = Array.from(field.querySelector("select").options).map((option) => option.value);
      } else if (fieldType === "button") {
        buttonDetails = {
          text: field.querySelector('.button-text').value,
          type: field.querySelector('.button-type').value,
          style: field.querySelector('.button-style').value,
        };
      }
  
      return {
        label: labelElement ? labelElement.value : "",
        type: fieldType,
        name: inputElement ? inputElement.name : "",
        options: options,
        buttonDetails: buttonDetails
      };
    });
  
    formDataInput.value = JSON.stringify({
      formName: formNameInput.value,
      formData: formFields,
    });

    fetch("Controller.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: formDataInput.value,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Form saved successfully!");
        } else {
          alert("Error: " + data.error);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  document
    .getElementById("dynamic-form")
    .addEventListener("submit", (event) => {
      event.preventDefault();
      createForm();
    });
});
