document.addEventListener("DOMContentLoaded", () => {
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

    formArea.insertAdjacentHTML("beforeend", fieldHTML);
  }

  function createFieldTemplate(label, inputHTML) {
    return `
                <div class="form-field dragg" draggable="true" style="grid-column: span 1;">
                    <label class="form-label">${label}</label>
                    ${inputHTML}
                    <button class="toggle-width-btn" onclick="toggleFieldWidth(this)">Toggle Width</button>
                </div>
            `;
  }

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
                <input type="radio" name="radio" value="option1"> Option 1<br>
                <input type="radio" name="radio" value="option2"> Option 2
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

  window.toggleFieldWidth = function (button) {
    const field = button.parentElement;
    const currentSpan = field.style.gridColumn;
    field.style.gridColumn = currentSpan === "span 2" ? "span 1" : "span 2";
  };
});

document.querySelector(".createform").addEventListener("click", function () {
  const formName = document.getElementById("form-name").value.trim();
  const formData = [];

  if (!formName) {
    alert("Please enter a form name.");
    window.location.href = "index.php"; // Correct redirection
    return;
  }

  document.querySelectorAll("#form-area .form-field").forEach((field) => {
    const fieldType =
      field.querySelector("input, select, textarea").getAttribute("type") ||
      "text";
    const fieldLabel = field.querySelector("label").innerText;
    formData.push({
      label: fieldLabel,
      type: fieldType,
    });
  });

  document.getElementById("form_data").value = JSON.stringify({
    formName,
    fields: formData,
  });
});
