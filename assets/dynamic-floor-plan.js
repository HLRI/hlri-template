jQuery(document).ready(function($) {
    function updateFloorPlanTypes() {
        var propertyId = $('#associated_property').val();
        if (propertyId) {
            $.post(ajaxurl, {
                action: 'get_floor_plan_types',
                property_id: propertyId
            }, function(response) {
                var $floorPlanTypeSelect = $('#floor_plan_type_select');
                $floorPlanTypeSelect.empty();
                $.each(response, function(index, option) {
                    $floorPlanTypeSelect.append($('<option>', {
                        value: option.value,
                        text: option.label
                    }));
                });
            });
        }
    }

    $('#associated_property').change(updateFloorPlanTypes);

    // Initial load
    updateFloorPlanTypes();
});
