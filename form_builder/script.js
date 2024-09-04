document.addEventListener("DOMContentLoaded", () => {
  const draggables = document.querySelectorAll(".draging");
  const formArea = document.getElementById("form-area");

  draggables.forEach((draggable) => {
    draggable.addEventListener("dragstart", handleDragStart);
  });

  formArea.addEventListener("dragover", handleDragOver);
  formArea.addEventListener("drop", handleDrop);

  // Initialize sortable for drag and drop reordering
  new Sortable(formArea, {
    animation: 150,
    ghostClass: "sortable-ghost",
  });

  function handleDragStart(event) {
    event.dataTransfer.setData("text/plain", event.target.dataset.type);
  }

  function handleDragOver(event) {
    event.preventDefault(); // Allow drop by preventing the default behavior
  }

  function handleDrop(event) {
    event.preventDefault();
    const fieldType = event.dataTransfer.getData("text/plain");
    addFieldToFormArea(fieldType);
  }

  function addFieldToFormArea(fieldType) {
    let fieldHTML = "";

    switch (fieldType) {
      case "text":
        fieldHTML = getTextFieldHTML();
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
      default:
        console.error("Unknown field type:", fieldType);
    }

    // Insert the HTML into the form area
    formArea.insertAdjacentHTML("beforeend", fieldHTML);
  }

  // Helper function to create a field template
  function createFieldTemplate(label, inputHTML) {
    return `
      <div class="form-field dragg" draggable="true" style="grid-column: span 1;">
        <label class="form-label">
          <input type="text" class="label-input" value="${label}">
        </label>
        ${inputHTML}
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

  // Toggle the width of a form field between full and half-width
  window.toggleFieldWidth = function (button) {
    const field = button.parentElement;
    const currentSpan = field.style.gridColumn;
    field.style.gridColumn = currentSpan === "span 2" ? "span 1" : "span 2";
  };

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

      return {
        label: labelElement ? labelElement.value : "",
        type:
          inputElement.tagName.toLowerCase() === "textarea"
            ? "textarea"
            : inputElement.type,
        name: inputElement.name || "",
        options:
          inputElement.tagName.toLowerCase() === "select"
            ? Array.from(inputElement.options).map((option) => option.value)
            : null,
      };
    });

    formDataInput.value = JSON.stringify({
      formName: formName,
      formData: formFields,
    });

    fetch("FormController.php", {
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
