document.addEventListener('DOMContentLoaded', () => {
    const draggables = document.querySelectorAll('.draging');
    const formArea = document.getElementById('form-area');

    draggables.forEach(draggable => {
        draggable.addEventListener('dragstart', handleDragStart);
    });

    formArea.addEventListener('dragover', handleDragOver);
    formArea.addEventListener('drop', handleDrop);

    new Sortable(formArea, {
        animation: 150,
        ghostClass: 'sortable-ghost'
    });

    function handleDragStart(event) {
        event.dataTransfer.setData('text/plain', event.target.dataset.type);
    }

    function handleDragOver(event) {
        event.preventDefault();
    }

    function handleDrop(event) {
        event.preventDefault();
        const fieldType = event.dataTransfer.getData('text/plain');
        addFieldToFormArea(fieldType);
    }

    function addFieldToFormArea(fieldType) {
        let fieldHTML = '';

        switch (fieldType) {
            case 'text':
                fieldHTML = getTextFieldHTML();
                break;
            case 'number':
                fieldHTML = getNumberFieldHTML();
                break;
            case 'email':
                fieldHTML = getEmailFieldHTML();
                break;
            case 'password':
                fieldHTML = getPasswordFieldHTML();
                break;
            case 'radio':
                fieldHTML = getRadioFieldHTML();
                break;
            case 'dropdown':
                fieldHTML = getDropdownFieldHTML();
                break;
            case 'message':
                fieldHTML = getMessageFieldHTML();
                break;
            case 'checkbox':
                fieldHTML = getCheckboxFieldHTML();
                break;
            case 'date':
                fieldHTML = getDateFieldHTML();
                break;
            case 'time':
                fieldHTML = getTimeFieldHTML();
                break;
            case 'DateTime':
                fieldHTML = getDateTimeFieldHTML();
                break;
            case 'week':
                fieldHTML = getWeekFieldHTML();
                break;
            default:
                console.error('Unknown field type:', fieldType);
        }

        formArea.insertAdjacentHTML('beforeend', fieldHTML);
    }

    function getTextFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="text" class="form-label">Text Field:</label>
                <input type="text" class="form-control" id="text" placeholder="Enter text">
            </div>
        `;
    }

    function getNumberFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="number" class="form-label">Number Field:</label>
                <input type="number" class="form-control" id="number" placeholder="Enter number">
            </div>
        `;
    }

    function getEmailFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="email" class="form-label">Email Field:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
        `;
    }

    function getPasswordFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="password" class="form-label">Password Field:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
        `;
    }

    function getRadioFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label class="form-label">Radio Field:</label>
                <div>
                    <input type="radio" name="radio" value="option1"> Option 1&nbsp;
                    <input type="radio" name="radio" value="option2"> Option 2
                </div>
            </div>
        `;
    }

    function getDropdownFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="dropdown" class="form-label">Dropdown Field:</label>
                <select class="form-control" id="dropdown">
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                </select>
            </div>
        `;
    }

    function getMessageFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="message" class="form-label">Message Field:</label>
                <textarea class="form-control" id="message" rows="4" placeholder="Enter message"></textarea>
            </div>
        `;
    }

    function getCheckboxFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label class="form-label">Checkbox Field:</label>
                <div>
                    <input type="checkbox" id="checkbox1" value="option1">
                    <label for="checkbox1">Option 1</label>
                </div>
                <div>
                    <input type="checkbox" id="checkbox2" value="option2">
                    <label for="checkbox2">Option 2</label>
                </div>
            </div>
        `;
    }

    function getDateFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="date" class="form-label">Date Field</label>
                <input type="date" class="form-control" id="date">
            </div>
        `;
    }

    function getTimeFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="time" class="form-label">Time Field</label>
                <input type="time" class="form-control" id="time">
            </div>
        `;
    }

    function getDateTimeFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="dateTime" class="form-label">Date Time Field</label>
                <input type="datetime-local" class="form-control" id="dateTime">
            </div>
        `;
    }

    function getWeekFieldHTML() {
        return `
            <div class="form-field draggable-field" draggable="true">
                <label for="week" class="form-label">Week Field</label>
                <input type="week" class="form-control" id="week">
            </div>
        `;
    }
});
