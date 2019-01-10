<?php
$route['course-academic-batch-upload'] = 'upload_utilities/course_academic_batch_utilities/index';
$route['course-academic-batch-upload-process'] = 'upload_utilities/course_academic_batch_utilities/upload_file';
$route['course-academic-batch-upload-valid'] = 'upload_utilities/course_academic_batch_utilities/get_temp_table_data_grid';
$route['course-academic-batch-upload-invalid'] = 'upload_utilities/course_academic_batch_utilities/get_temp_table_data_grid';
$route['course-academic-batch-delete-row'] = 'upload_utilities/course_academic_batch_utilities/delete_temp_record';
$route['course-academic-batch-export'] = 'upload_utilities/course_academic_batch_utilities/export_grid_data';
$route['course-academic-batch-import'] = 'upload_utilities/course_academic_batch_utilities/save_import_data';
//book ledger 
$route['book-ledger-upload'] = 'upload_utilities/book_ledger_upload_utilities/index';
$route['book-ledger-upload-template-download'] = 'upload_utilities/book_ledger_upload_utilities/get_ledger_template';
$route['book-ledger-upload-process'] = 'upload_utilities/book_ledger_upload_utilities/upload_file';
$route['book-ledger-upload-valid'] = 'upload_utilities/book_ledger_upload_utilities/get_temp_table_data_grid';
$route['book-ledger-upload-invalid'] = 'upload_utilities/book_ledger_upload_utilities/get_temp_table_data_grid';
$route['book-ledger-upload-delete-row'] = 'upload_utilities/book_ledger_upload_utilities/delete_temp_record';
$route['book-ledger-upload-export'] = 'upload_utilities/book_ledger_upload_utilities/export_grid_data';
$route['book-ledger-upload-import'] = 'upload_utilities/book_ledger_upload_utilities/save_import_data';