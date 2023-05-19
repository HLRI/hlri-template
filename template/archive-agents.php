<?php /* Template Name: Archive Agents */ ?>

<?php
function create_neighborhood_category($category_name) {
    $taxonomy = 'neighborhood'; 
    
    $category = term_exists($category_name, $taxonomy);
    
    if (!$category) {
        $category = wp_insert_term($category_name, $taxonomy);
    }
    
    return $category;
}

$filename = 'db.txt'; 
$lines = file($filename);

foreach ($lines as $line) {
    echo $line . '<br>';
    $category_name = trim($line); 
    
    $category = create_neighborhood_category($category_name);
    
    if (!is_wp_error($category)) {
        echo "دسته‌بندی \"$category_name\" با موفقیت ایجاد شد.<br>";
    } else {
        echo "خطا در ایجاد دسته‌بندی \"$category_name\". " . $category->get_error_message() . "<br>";
    }
}
?>
