<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="./dist/img/logo.png">
    <!-- <link rel="stylesheet" href="style.css"> -->

    <style>
        .box {
            position: relative;
            left: 30%;
            margin-top: 40px;
            margin-bottom: 20px;
            height: 65vh;
            padding: 20px;
            width: 30%;
            border: 2px solid #b3b1b1;
            overflow: auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .draging,
        .draggable-field {
            cursor: grab;
            margin-bottom: 20px;
        }
        .dragg {
            cursor: grab;
            margin-bottom: 0px;
        }

        .createform {
            position: absolute;
            top: 100%;
            left: 51.5%;
            border-radius: 10px;
            width: 12vw;
            padding: 10px 0;
            font-size: 20px;
            border: none;
            color: #fff;
            background-color: #007bff;
        }

        .form-field {
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            display: flex; 
            flex-direction: column;
            grid-column: span 1; 
            height:100px;
        }

        .form-field label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-field input,
        .form-field textarea,
        .form-field select {
            padding: 5px;
            margin-bottom: 5px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
        }

        .toggle-width-btn {
            align-self: flex-end;
            margin-top: -80px;
            padding: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        @media only screen and (min-width: 1000px) {
            .toggle {
                display: none;
            }
        }
    </style>

    <!-- css link -->
    <?php include "./Include/style.php"; ?>
    <title>Form Builder</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- header -->
        <?php include "./Include/header.php"; ?>

        <!-- sidebar -->
        <?php include "./Include/sidebar.php"; ?>

        <div class="content-wrapper">

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-5 box" id="form-area">
                            <!-- Form fields will be dropped here -->
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <button class="createform btn-primary">Create Form</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- footer -->

        <footer class="main-footer" style="color:black; background-color: rgba(0, 0, 0, 0.2); padding-bottom:12px;">
            Copyright &copy; <strong>DD Form Builder</strong> 2024-25.
            All rights reserved.
        </footer>
    </div>

    <!-- script -->
    <?php include "./Include/script.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <!-- <script src="./script.js"></script> -->

    <script>
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
                    case 'datetime':
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
                return createFieldTemplate('Text Field', '<input type="text" class="form-control" placeholder="Enter text">');
            }

            function getNumberFieldHTML() {
                return createFieldTemplate('Number Field', '<input type="number" class="form-control" placeholder="Enter number">');
            }

            function getEmailFieldHTML() {
                return createFieldTemplate('Email Field', '<input type="email" class="form-control" placeholder="Enter email">');
            }

            function getPasswordFieldHTML() {
                return createFieldTemplate('Password Field', '<input type="password" class="form-control" placeholder="Enter password">');
            }

            function getRadioFieldHTML() {
                return createFieldTemplate('Radio Field', `
                    <input type="radio" name="radio" value="option1"> Option 1<br>
                    <input type="radio" name="radio" value="option2"> Option 2
                `);
            }

            function getDropdownFieldHTML() {
                return createFieldTemplate('Dropdown List', `
                    <select class="form-control">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                    </select>
                `);
            }

            function getMessageFieldHTML() {
                return createFieldTemplate('Message Field', '<textarea class="form-control" rows="4" placeholder="Enter message"></textarea>');
            }

            function getCheckboxFieldHTML() {
                return createFieldTemplate('Checkbox Field', `
                    <input type="checkbox" value="1"> Checkbox 1<br>
                    <input type="checkbox" value="2"> Checkbox 2
                `);
            }

            function getDateFieldHTML() {
                return createFieldTemplate('Date Field', '<input type="date" class="form-control">');
            }

            function getTimeFieldHTML() {
                return createFieldTemplate('Time Field', '<input type="time" class="form-control">');
            }

            function getDateTimeFieldHTML() {
                return createFieldTemplate('Date Time Field', '<input type="datetime-local" class="form-control">');
            }

            function getWeekFieldHTML() {
                return createFieldTemplate('Week Field', '<input type="week" class="form-control">');
            }

            window.toggleFieldWidth = function (button) {
                const field = button.parentElement;
                const currentSpan = field.style.gridColumn;
                field.style.gridColumn = currentSpan === 'span 2' ? 'span 1' : 'span 2';
            };
        });
    </script>
</body>

</html>
