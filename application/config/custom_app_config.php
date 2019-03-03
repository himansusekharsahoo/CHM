<?php

/*
  |--------------------------------------------------------------------------
  | Library user type
  |--------------------------------------------------------------------------
  | @himansuS
  | @22Feb2019
  | This defines the type of library member and this is directly
  | related to rbac_user tables user_type column.
  | When ever we add/update/remove the user_type column data then
  | same should be updated here.
  |
 */
$config['LIB_USER_TYPE'] = array('staff' => 'staff', 'student' => 'student', 'library_member', 'developer');
$config['LIB_BOOK_QR_COLUMNS'] = array(
    'book_name' => 'book_name',
    'bcategory_name' => 'bcategory_name',
    'publicatoin_name' => 'publicatoin_name',
    'author_name' => 'author_name',
    'location' => 'location',
    'page' => 'page',
    'mrp' => 'mrp',
    'isbn_no' => 'isbn_no',
    'edition' => 'edition'
);
$config['LIB_BOOK_QR_COLUMNS_JSON'] = json_encode(
        array(
            array(
                'id' => 'book_name',
                'title' => 'Book name',
                'value' => 'book_name'
            ),
            array(
                'id' => 'bcategory_name',
                'title' => 'Category',
                'value' => 'bcategory_name'
            ),
            array(
                'id' => 'publicatoin_name',
                'title' => 'Publication',
                'value' => 'publicatoin_name'
            ),
            array(
                'id' => 'author_name',
                'title' => 'Author',
                'value' => 'author_name'
            ),
            array(
                'id' => 'location',
                'title' => 'Location',
                'value' => 'location'
            ),
            array(
                'id' => 'isbn_no',
                'title' => 'ISBN',
                'value' => 'isbn_no'
            )
            ,
            array(
                'id' => 'edition',
                'title' => 'Edition',
                'value' => 'edition'
            )
        )
);
$config['LIB_BOOK_QR_DEFAULT_COLUMNS'] =array('book_name','author_name','edition','location','isbn_no');
