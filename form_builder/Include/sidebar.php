<aside class="main-sidebar bg-white" style="margin-top: 68px;">
    <!-- <a href="./index.php">
    <img src="dist/img/logo.png" alt="FormBuilder" height="80px" width="250px">
    </a> -->
    <div class="sidebar">

        <nav class="mt-1">
            <div class="mb-3 d-flex user-select-none">
                <h2 class="font-weight-bold">Input Field</h2>
            </div>

            <ul class="inputField flex-column" style="list-style-type: none;  padding-left: 10px;">
                
                <li class="draging" draggable="true" data-type="text">
                    <label for="text">Text&nbsp;:</label>
                    <input type="text" name="text" id="text" placeholder="ex.FirstName" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="number">
                    <label for="numner">Number&nbsp;:</label>
                    <input type="number" name="number" id="number" placeholder="ex.1234567895" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="email">
                    <label for="email">Email&nbsp;:</label>
                    <input type="email" name="email" id="email" placeholder="ex.abc@gmail.com" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="password">
                    <label for="password">Password&nbsp;:</label>
                    <input type="password" name="password" id="password" placeholder="Enter password" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="radio">
                    <label for="radio">Radio&nbsp;:</label><br>
                    <input type="radio" name="radio" id="radio" value="radio" disabled>&nbsp;radio&nbsp;
                    <br><input type="radio" name="radio" id="radio" value="radio" disabled>&nbsp;radio  
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="dropdown">
                    <label for="list">Dropdown List:</label>
                    <select class="form-control" name="list" id="list" disabled>
                        <option value="List 1">List 1</option>
                        <option value="List 2">List 2</option>
                    </select>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="message">
                    <label for="text">Message&nbsp;:</label><br>
                    <textarea name="text" id="text" cols="20" rows="4" placeholder="Any message" disabled></textarea>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="checkbox">
                    <label for="">Checkbox&nbsp;:</label><br>
                    <input type="checkbox" id="checkbox1" name="checkbox" value="checkbox" disabled>
                    <label for="checkbox1">Checkbox1</label><br>
                    <input type="checkbox" id="checkbox2" name="checkbox" value="checkbox" disabled>
                    <label for="checkbox2">Checkbox2</label>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="date">
                    <label for="date">Date&nbsp;:</label><br>
                    <input type="date" name="date" id="date" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="time">
                    <label for="time">time&nbsp;:</label><br>
                    <input type="time" name="time" id="time" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="datetime">
                    <label for="datetime">Date Time&nbsp;:</label>
                    <input type="datetime-local" name="datetime" id="datetime" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="week">
                    <label for="week">Week&nbsp;:</label><br>
                    <input type="week" name="week" id="week" disabled>
                </li>
                <hr>
                <li class="draging nav-item" draggable="true" data-type="button">
                    <label for="button">Button&nbsp;:</label><br>
                    <input type="button" class="btn btn-success" name="button" id="button" value="Button" disabled>
                </li>
            </ul>
        </nav>

    </div>

</aside>