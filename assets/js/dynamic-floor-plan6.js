document.addEventListener('DOMContentLoaded', function() {
    function updateFloorPlanTypes() {
        var propertySelect = document.getElementById('associated_property');
        var propertyId = propertySelect.value;

        var floorPlanTypeSelect = document.querySelector('[data-depend-id="floor_plan_type_select"]');

        if (propertyId && floorPlanTypeSelect) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', ajaxurl.url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    floorPlanTypeSelect.innerHTML = '';
                    response.forEach(function(option) {
                        var opt = document.createElement('option');
                        opt.value = option.value;
                        opt.text = option.label;
                        floorPlanTypeSelect.appendChild(opt);
                    });
                    floorPlanTypeSelect.parentElement.style.display = 'block'; // Ensure the field is shown
                }
            };
            // xhr.send('action=get_floor_plan_types&property_id=' + propertyId);
            xhr.send('action=get_floor_plan_types&property_id=' + 6759);
        } else if (floorPlanTypeSelect) {
            floorPlanTypeSelect.parentElement.style.display = 'none'; // Hide if no property selected
        }
    }

    var propertySelect = document.querySelector('[name="associated_property"]');
    if (propertySelect) {
        propertySelect.addEventListener('change', updateFloorPlanTypes);
    }

    // Initial load
    updateFloorPlanTypes();
});
