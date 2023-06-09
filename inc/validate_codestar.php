<?php

if (!function_exists('csf_validate_require')) {
    function csf_validate_require($value)
    {
        if (empty($value)) {
            return esc_html__('Please select an option!', 'csf');
        }
    }
}
