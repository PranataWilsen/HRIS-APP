<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================
// Dashboard
// ==========================
$routes->get('/', 'Dashboard::index');

// ==========================
// Pegawai (AJAX CRUD)
// ==========================
$routes->get('/pegawai', 'EmployeeController::index');
$routes->get('/pegawai/create', 'EmployeeController::create');
$routes->get('/pegawai/edit/(:num)', 'EmployeeController::edit/$1');
$routes->post('/pegawai/storeAjax', 'EmployeeController::storeAjax');
$routes->post('/pegawai/updateAjax/(:num)', 'EmployeeController::updateAjax/$1');
$routes->post('/pegawai/toggleActive/(:num)', 'EmployeeController::toggleActive/$1');


// ==========================
// Departemen (AJAX CRUD)
// ==========================
$routes->get('/departemen', 'DepartmentController::index');
$routes->get('/departemen/create', 'DepartmentController::create');
$routes->get('/departemen/edit/(:num)', 'DepartmentController::edit/$1');
$routes->post('/departemen/storeAjax', 'DepartmentController::storeAjax');
$routes->post('/departemen/updateAjax/(:num)', 'DepartmentController::updateAjax/$1');
$routes->post('/departemen/deleteAjax/(:num)', 'DepartmentController::deleteAjax/$1');

// ==========================
// Keahlian (AJAX CRUD)
// ==========================
$routes->get('/keahlian', 'KeahlianController::index');
$routes->get('/keahlian/create', 'KeahlianController::create');
$routes->get('/keahlian/edit/(:num)', 'KeahlianController::edit/$1');
$routes->post('/keahlian/storeAjax', 'KeahlianController::storeAjax');
$routes->post('/keahlian/updateAjax/(:num)', 'KeahlianController::updateAjax/$1');
$routes->post('/keahlian/deleteAjax/(:num)', 'KeahlianController::deleteAjax/$1');

// ==========================
// Quiz
// ==========================
$routes->get('/quiz', 'QuizController::index');
$routes->post('/quiz/submit', 'QuizController::submit');
$routes->get('/quiz/result/(:num)', 'QuizController::result/$1');

// ==========================
// Report
// ==========================
$routes->get('/report/perDepartemen', 'ReportController::perDepartemen');
$routes->get('/report/perKeahlian', 'ReportController::perKeahlian');
$routes->get('/report/hasilKuis', 'ReportController::hasilKuis');

// Export Excel
$routes->get('/report/exportDepartemenExcel', 'ReportController::exportDepartemenExcel');
$routes->get('/report/exportKeahlianExcel', 'ReportController::exportKeahlianExcel');
$routes->get('/report/exportHasilKuisExcel', 'ReportController::exportHasilKuisExcel');

// ==========================
// Chart
// ==========================
$routes->get('/chart', 'ChartController::index');
