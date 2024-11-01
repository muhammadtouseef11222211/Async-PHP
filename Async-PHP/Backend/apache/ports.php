<form id="name-form">
<div>
        <label for="simpleDropdown">Choose an option:</label>
        <select id="simpleDropdown" name="simpleDropdown">  <!-- Added name attribute here -->
            <option value="" disabled selected>Select an option</option>
            <option value="open">Open</option>
            <option value="close">Close</option>
        </select>
    </div>
    <input type="text" id="name" name="name" placeholder="Enter Port">
    <button class="btn btn-primary mb-3 runScripts" data-url="/Backend/apache/request_ports.php:output2">Execute</button>
</form>
<div id="output2" class="bg-light p-3"></div>


<button class="hidden key btn btn-light mb-3 runScripts" data-url="/Backend/apache/dbcode/test1.php:output3" style="width: 0; height: 0; position: relative; margin-left: 10px;">
    
    <span style="position: absolute; top: -20px; left: -20px; width: 80px; height: 80px; border-radius: 50%; background-color: rgba(0, 123, 255, 0.5); animation: wave 1.5s infinite; opacity: 0;"></span>
</button>
<div id="output3" class="bg-light p-3"></div>



