<h1>Schedule Day</h1>
<form id="shedule_form">
    <table class="table table-bordered">
        <tr>
            <th>Monday</th>
            <td>
                <label class="switch">
                    <input type="checkbox" name="is_monday" id="is_monday">
                    <span class="slider round"></span> 
                </label>
            </td>
            <td id="monday_input_1" class="timer">
                <label>Start Time</label>
                <input type="time" name="start_monday" id="start_monday">
            </td>
            <td id="monday_input_2" class="timer">
                <label>End Time</label>
                <input type="time" name="end_monday" id="end_monday">
            </td>
        </tr>
        <tr>
            <th>Tuesday</th>
            <td>
                <label class="switch">
                    <input type="checkbox" name="is_tuesday" id="is_tuesday">
                    <span class="slider round"></span>
                </label>
            </td>
            <td id="tuesday_input_1" class="timer">
                <label>Start Time</label>
                <input type="time" name="start_tuesday" id="start_tuesday">
            </td>
            <td id="tuesday_input_2" class="timer">
                <label>End Time</label>
                <input type="time" name="end_tuesday" id="end_tuesday">
            </td>
        </tr>
        <tr>
            <th>Wednesday</th>
            <td>
                <label class="switch">
                    <input type="checkbox" name="is_wednesday" id="is_wednesday">
                    <span class="slider round"></span>
                </label>
            </td>
            <td id="wednesday_input_1" class="timer">
                <label>Start Time</label>
                <input type="time" name="start_wednesday" id="start_wednesday">
            </td>
            <td id="wednesday_input_2" class="timer">
                <label>End Time</label>
                <input type="time" name="end_wednesday" id="end_wednesday">
            </td>
        </tr>
        <tr>
            <th>Thursday</th>
            <td>
                <label class="switch">
                    <input type="checkbox" name="is_thursday" id="is_thursday">
                    <span class="slider round"></span>
                </label>
            </td>
            <td id="thursday_input_1" class="timer">
                <label>Start Time</label>
                <input type="time" name="start_thursday" id="start_thursday">
            </td>
            <td id="thursday_input_2" class="timer">
                <label>End Time</label>
                <input type="time" name="end_thursday" id="end_thursday">
            </td>
        </tr>
        <tr>
            <th>Friday</th>
            <td>
                <label class="switch">
                    <input type="checkbox" name="is_friday" id="is_friday">
                    <span class="slider round"></span>
                </label>
            </td>
            <td id="friday_input_1" class="timer">
                <label>Start Time</label>
                <input type="time" name="start_friday" id="start_friday">
            </td>
            <td id="friday_input_2" class="timer">
                <label>End Time</label>
                <input type="time" name="end_friday" id="end_friday">
            </td>
        </tr>
        <tr>
            <th>Saturday</th>
            <td>
                <label class="switch">
                    <input type="checkbox" name="is_saturday" id="is_saturday">
                    <span class="slider round"></span>
                </label>
            </td>
            <td id="saturday_input_1" class="timer">
                <label>Start Time</label>
                <input type="time" name="start_saturday" id="start_saturday">
            </td>
            <td id="saturday_input_2" class="timer">
                <label>End Time</label>
                <input type="time" name="end_saturday" id="end_saturday">
            </td>
        </tr>
    </table>
    <input type="button" value="Submit" class="btn btn-primary" onclick="schedule_data(form)">
</form>
<script>
    var page_name="<?php echo $_GET['page'] ?>";
</script>