<?php
function display_errors($errors){
  $display = '<ul class="bg-danger">';
  foreach ($errors as $error) {
    $display .='<li class="text-danger">'.$error.'</li>';break;
  }
  $display .='</ul>';
  return $display;
}
// secure the sql syntax
function sanitize($dirty){
  return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function money($number){
  return '$'.$number;
}

function login($user_id){
  $_SESSION['SBUser'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  mysql_query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
  $_SESSION['success_flash'] = '帐号登入成功!';
  header('Location: dashboard.php');
}

function is_logged_in(){
  if (isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
    return true;
  }
  return false;
}

// function login_error_redirect($url = 'index.php'){
//   $_SESSION['error_flash'] = 'You must be logged in to access that page';
//   header('Location: '.$url);
// }
// function permission_error_redirect($url = 'index.php'){
//   $_SESSION['error_flash'] = 'You do not have permission to access that page';
//   header('Location: '.$url);
// }

function has_permission($permission = 'admin'){
  global $user_data;
  $permissions = explode(',', $user_data['permissions']);
  if (in_array($permission,$permissions,true)) {
    return true;
  }
  return false;
}
function pretty_date($date){
  return date("M d, Y h:i A",strtotime($date));
}

function get_category($child_id){
  global $db;
  $id = sanitize($child_id);
  $query = mysql_query("SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child'
  FROM categories_en c
  INNER JOIN categories_en p
  ON c.parent = p.id
  WHERE c.id = '$id'");
  $category = mysql_fetch_assoc($query);
  return $category;
}

function sizesToArray($string){
  $sizesArray = explode(',',$string);
  $returnArray = array();
  foreach ($sizesArray as $size) {
    $s = explode (':',$size);
    $returnArray[] = array('size' => $s[0], 'quantity' => $s[1],'threshold' => $s[2]);
  }
  return $returnArray;
}

function sizesToString($sizes){
  $sizeString = '';
  foreach($sizes as $size){
    $sizeString .= $size['size'].':'.$size['quantity'].':'.$size['threshold'].',';
  }
  $trimmed = rtrim($sizeString, ',');
  return $trimmed;
}

function utf8Substr($str, $from, $len)
{
   return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                      '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                      '$1',$str);
}
