document.addEventListener('DOMContentLoaded', function() {
    function updateFloorPlanTypes() {
        var propertySelect = document.getElementById('associated_property');
        var propertyId = propertySelect.value;

        var floorPlanTypeSelect = document.querySelector('[data-depend-id="floor_plan_type_select"]');
        var floorPlanTypeText = document.querySelector('[data-depend-id="floor_plan_type_text"]');

        console.log('Floor Plan Type Select:', floorPlanTypeSelect);
        console.log('Floor Plan Type Text:', floorPlanTypeText);

        if (propertyId && floorPlanTypeSelect) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', ajaxurl.url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        console.log('API Response:', response); // Log the response for debugging
                        if (response.success && Array.isArray(response.data)) {
                            floorPlanTypeSelect.innerHTML = '';
                            response.data.forEach(function(option) {
                                var opt = document.createElement('option');
                                opt.value = option.title; // Adjust as needed
                                opt.text = option.label;  // Adjust as needed
                                floorPlanTypeSelect.appendChild(opt);
                            });
                            floorPlanTypeSelect.parentElement.style.display = 'block'; // Ensure the field is shown

                            // Update the read-only text field with the selected value
                            if (floorPlanTypeText) {
                                floorPlanTypeText.value = floorPlanTypeSelect.value;
                            }
                        } else {
                            console.error('Unexpected response format:', response);
                        }
                    } catch (e) {
                        console.error('Failed to parse JSON response:', e);
                    }
                }
            };
            xhr.send('action=get_floor_plan_types&property_id=' + propertyId);
        } else if (floorPlanTypeSelect) {
            floorPlanTypeSelect.parentElement.style.display = 'none'; // Hide if no property selected
        }
    }

    var propertySelect = document.querySelector('[name="associated_property"]');
    if (propertySelect) {
        propertySelect.addEventListener('change', updateFloorPlanTypes);
    }

    // Update the read-only text field when the dropdown value changes
    var floorPlanTypeSelect = document.querySelector('[data-depend-id="floor_plan_type_select"]');
    if (floorPlanTypeSelect) {
        floorPlanTypeSelect.addEventListener('change', function() {
            var selectedValue = floorPlanTypeSelect.value;
            var floorPlanTypeText = document.querySelector('[data-depend-id="floor_plan_type_text"]');
            console.log('Selected Value:', selectedValue);
            console.log('Floor Plan Type Text:', floorPlanTypeText);
            if (floorPlanTypeText) {
                floorPlanTypeText.value = selectedValue; // Update the text field with the selected value
            }
        });
    }

    // Initial load
    updateFloorPlanTypes();
});
