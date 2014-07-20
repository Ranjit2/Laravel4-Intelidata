<?php

// Example 1 - How import XLS File into database

 // Turn XLS file into an array
require_once 'bundles/laravel-phpexcel/PHPExcel/IOFactory.php';
 
$objPHPExcel = PHPExcel_IOFactory::load($file_path);
$rows = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
 
// get the column names
$xls_fields = isset($rows[1]) ? $rows[1] : array();
if (! empty($xls_fields)) {
  unset($rows[1]);
}

// xls returns $value = array('A' => 'value'); so you have to remove keys
$fields = array();
foreach ($xls_fields as $field) {
  $fields[] = strtolower($field);
}
 
// find each column's position from available data set
$name_pos = array_search('name', $fields);
$first_pos = array_search('first', $fields);
$last_pos = array_search('last', $fields);
$email_pos = array_search('email', $fields);
$phone_pos = array_search('phone', $fields);
$address_1_pos = array_search('address 1', $fields);
$address_2_pos = array_search('address 2', $fields);
$city_pos = array_search('city', $fields);
$state_pos = array_search('state', $fields);
$zip_pos = array_search('zip', $fields);
 
$birthday_pos = array_search('birthday', $fields);
 
if ($birthday_pos === false) {
  $birthday_pos = array_search('birthdate', $fields);
}

foreach ($rows as $row) {
  // remove keys again
  $data = array();
  foreach ($row as $key => $value) {
    $data[] = $value;
  }
   
  // construct the name for contact out of 'name' or 'first' & 'last'
  if ($name_pos !== false) {
    $name = explode(' ', $data[$name_pos]);
    $first = isset($name[0]) ? $name[0] : '';
    $last = isset($name[1]) ? $name[1] : '';
  } else {
    $first = $data[$first_pos];
    $last = $data[$last_pos];
  }
   
  // Only use birthday if exists
  if ($birthday_pos !== false) {
    $birthday = date('Y-m-d 00:00:00', strtotime($data[$birthday_pos]));
  } else {
    $birthday = '0000-00-00 00:00:00';
  }
   
  // fix birthdays 4/19/56 >> 4/19/2056 >> 4/19/1956
  if (strtotime($birthday) > time()) {
    $birthday = date('19y-m-d 00:00:00', strtotime($birthday));
  }
   
   
  // getting data read for insertion
  $email = $data[$email_pos];
  $phone = $data[$phone_pos];
  $address_1 = $data[$address_1_pos];
  $address_2 = $data[$address_2_pos];
  $city = $data[$city_pos];
  $state = $data[$state_pos];
  $zip = $data[$zip_pos];
   
   
  $contact = Contact::create(array(
    'user_id' => $this->user_id,
    'account_user_id' => $this->account_user_id,
    'duel_id' => $this->duel_id,
    'queue_id' => $this->id,
    'dashboard_id' => 0,
    'first' => $first != null ? $first : '',
    'last' => $last != null ? $last : '',
    'phone' => preg_replace("/[^0-9]/", "", $phone),
    'email' => $email != null ? $email : '',
    'address_1' => $address_1 != null ? $address_1 : '',
    'address_2' => $address_2 != null ? $address_2 : '',
    'city' => $city != null ? $city : '',
    'province' => $state != null ? $state : '',
    'zip' => $zip != null ? $zip : '',
    'birthday' => $birthday != null && $birthday != 0 ? $birthday : '',
  ));
   
  DB::table('contact_dashboard')->insert(array(
    'user_id' => $this->user_id,
    'account_user_id' => $this->account_user_id,
    'duel_id' => $this->duel_id,
    'dashboard_id' => $this->dashboard_id,
    'contact_id' => $contact->id
  ));
}
 
$this->contact_count = count($rows);
unset($rows);
unset($objPHPExcel);
