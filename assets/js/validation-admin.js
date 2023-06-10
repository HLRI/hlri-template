jQuery(document).ready(function ($) {
    // Handle the form submission
    $('input#title').on('change', function (event) {
        event.preventDefault();
        return;
    });
    $('form#post').on('submit', function (event) {
        // Check if an associated property is selected
        var associatedProperty = $('select#associated_property').val();
        if (!associatedProperty) {
            event.preventDefault(); // Prevent the default form submission
            alert('Please select an associated property.');
            return;
        }
        // Check if a floor plan name is entered
        var floorPlanName = $('input#title').val();
        if (!floorPlanName) {
            event.preventDefault(); // Prevent the default form submission
            alert('Please enter a floor plan name.');
            return;
        } else if (!floorPlanName && !associatedProperty) {
            event.preventDefault(); // Prevent the default form submission
        }
        // Update the preview link with the correct URL structure

        // If validation passes, proceed with the form submission
        $(this).unbind('submit').submit();
    });
});
