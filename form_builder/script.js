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
        </label>
        ${inputHTML}
        <button class="toggle-width-btn" type="button" onclick="toggleFieldWidth(this)">Toggle Width</button>
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
    const field = button.closest(".form-field"); // Get the parent .form-field div
    field.classList.toggle("full-width"); // Toggle the class
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

      // Get the field type from the data attribute
      const fieldType = field.dataset.type;

      return {
        label: labelElement ? labelElement.value : "", // Updated label
        type: fieldType, // Get the field type from the data attribute
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
