<?php
/*
Plugin Name: KL Media All Categories Column
Plugin URI: https://github.com/educate-sysadmin/kl-media-allcategories-column
Description: Wordpress plugin to workaround column display issue on media listing for Media Library Categories
Version: 0.1
Author: b.cunningham@ucl.ac.uk
Author URI: https://educate.london
License: GPL2
*/

function kl_column_allcategories($columns) {
    $columns['colAllCategories'] = __('All Categories');
    return $columns;
}
add_filter( 'manage_media_columns', 'kl_column_allcategories' );

function column_allcategories_row($columnName, $columnID) {
    if($columnName == 'colAllCategories'){ 
        $categories = get_the_category( $columnID);
        $output = '';
        foreach ($categories as $category) {
            $output .= $category->name.',';
        }
        if (strlen($output) >0 ) { 
            $output = substr($output, 0, strlen($output)-1); // de-comma
        }
        echo $output; 
    } 
} 
add_filter( 'manage_media_custom_column', 'column_allcategories_row', 10, 2 ); 
