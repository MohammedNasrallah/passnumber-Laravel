<?php
header('Cache-Control: no-store, private, no-cache, must-revalidate'); header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); 
header('Expires: 0', false); 
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
header ('Pragma: no-cache');
// //try
/*An authentication process is disclosed which uses categories of icons
to create an easy to remember passnumber for use with an electronic platform.
The process may assign each icon a discrete value during registration.
A hash value is created based on combining the discrete values for each icon in the passnumber. 
During a login process, the user is presented with the icons, sometimes in a randomly shuffled.
The user may input the icons that make up his or her passnumber. 
The process may access stored values for user selected icons in the login passnumber entry field
and calculate a login hash value. The process may then determine whether the login hash value matches
the registration hash value to permit or deny login access to the electronic platform.

    Copyright (C) 2020 Mohammed Nasrallah

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
 Contact us at passnumber.com or email us at: info@passnumber.com*/
 ;?>

<?php session_start();?>
<?php
  unset($_SESSION['_values']);
  unset($_SESSION['showKeys']);
  unset($_SESSION['showSubArray0']);
  unset($_SESSION['showSubArray1']);
  unset($_SESSION['showSubArray2']);
  unset($_SESSION['showSubArray3']);
?>
<?php
//Login assistant file

function sub_array_keys($_symbols) {
    $result = array();
    foreach ($_symbols as $key => $sub_array) {
        $result[$key] = array_keys($sub_array);
    }return $result;}
    
        function customShuffle(array &$_symbols) {
    $firstElement = array_shift($_symbols);
    shuffle($_symbols);
    array_unshift($_symbols, $firstElement);
}


function shuffle_assoc(&$_symbols) {
    $keys = array_keys($_symbols);

    shuffle($keys);

    foreach ($keys as $key) {
        $new[$key] = $_symbols[$key];
    }

    $_symbols = $new;

    return true;
}


function sort_sub_array_by_array($_symbols, $_keys) {
    $result = array();
    foreach ($_keys as $key_1 => $sub_array_keys) {
        foreach ($sub_array_keys as $key_2) {
            $result[$key_1][$key_2] = $_symbols[$key_1][$key_2];
        }
    }
    return $result;
}
    
    
?>
    
 <?php $user_login = ""; $userChain = "";  'user_login' == ""; 'user_pass' == ""; ?>

<?php

$_values = array( 
array(0, 1, 2, 3, 4), // 0
array(0, 10, 20, 30, 40), // 1
array(0, 100, 200, 300, 400), // 2
array(0, 1000, 2000, 3000, 4000), // 3
);



$_symbols = array(
  array(0,'<img src="passnumber/images/foodicons/food-1.jpg" width="50" height="50"/>','<img src="passnumber/images/foodicons/food-2.jpg" width="50" height="50"/>','<img src="passnumber/images/foodicons/food-3.jpg" width="50" height="50"/>','<img src="passnumber/images/foodicons/food-4.jpg" width="50" height="50"/>'), //0
  array(0,'<img src="passnumber/images/fruitsicons/fruites-1.jpg" width="50" height="50"/>','<img src="passnumber/images/fruitsicons/fruites-2.jpg" width="50" height="50"/>','<img src="passnumber/images/fruitsicons/fruites-3.jpg" width="50" height="50"/>','<img src="passnumber/images/fruitsicons/fruites-4.jpg" width="50" height="50"/>'), //1
  array(0,'<img src="passnumber/images/animalsicons/animal-1.jpg" width="50" height="50"/>','<img src="passnumber/images/animalsicons/animal-2.jpg" width="50" height="50"/>','<img src="passnumber/images/animalsicons/animal-3.jpg" width="50" height="50"/>','<img src="passnumber/images/animalsicons/animal-4.jpg" width="50" height="50"/>'), //2
  array(0,'<img src="passnumber/images/jobsicons/job-1.jpg" width="50" height="50"/>','<img src="passnumber/images/jobsicons/job-2.jpg" width="50" height="50"/>','<img src="passnumber/images/jobsicons/job-3.jpg" width="50" height="50"/>','<img src="passnumber/images/jobsicons/job-4.jpg" width="50" height="50"/>'), //3
  );


// Shuffling both of arrays ($_symbols and $_values) once to get a consistent shuffled arrays.
$_keys = sub_array_keys($_symbols);

array_walk($_keys, function(&$_keys) { customShuffle($_keys);});

shuffle_assoc($_keys);

$_symbols = sort_sub_array_by_array($_symbols, $_keys);
$_values = sort_sub_array_by_array($_values, $_keys);

$showKeys = array_keys($_symbols);

$showSubArray0 = array_keys($_symbols[$showKeys[0]]);
$showSubArray1 = array_keys($_symbols[$showKeys[1]]);
$showSubArray2 = array_keys($_symbols[$showKeys[2]]);
$showSubArray3 = array_keys($_symbols[$showKeys[3]]);

$_SESSION['_values'] = $_values;
$_SESSION['showKeys'] = $showKeys;
$_SESSION['showSubArray0'] = $showSubArray0;
$_SESSION['showSubArray1'] = $showSubArray1;
$_SESSION['showSubArray2'] = $showSubArray2;
$_SESSION['showSubArray3'] = $showSubArray3;

// echo "<pre>";
// print_r($_SESSION);
// exit();

?>

            <?php 
                $_symbols = array(
                  array(0,'<img src="passnumber/images/foodicons/food-1.jpg" width="84" height="84"/>','<img src="passnumber/images/foodicons/food-2.jpg" width="84" height="84"/>','<img src="passnumber/images/foodicons/food-3.jpg" width="84" height="84"/>','<img src="passnumber/images/foodicons/food-4.jpg" width="84" height="84"/>'), //0
                  array(0,'<img src="passnumber/images/fruitsicons/fruites-1.jpg" width="84" height="84"/>','<img src="passnumber/images/fruitsicons/fruites-2.jpg" width="84" height="84"/>','<img src="passnumber/images/fruitsicons/fruites-3.jpg" width="84" height="84"/>','<img src="passnumber/images/fruitsicons/fruites-4.jpg" width="84" height="84"/>'), //1
                  array(0,'<img src="passnumber/images/animalsicons/animal-1.jpg" width="84" height="84"/>','<img src="passnumber/images/animalsicons/animal-2.jpg" width="84" height="84"/>','<img src="passnumber/images/animalsicons/animal-3.jpg" width="84" height="84"/>','<img src="passnumber/images/animalsicons/animal-4.jpg" width="84" height="84"/>'), //2
                  array(0,'<img src="passnumber/images/jobsicons/job-1.jpg" width="84" height="84"/>','<img src="passnumber/images/jobsicons/job-2.jpg" width="84" height="84"/>','<img src="passnumber/images/jobsicons/job-3.jpg" width="84" height="84"/>','<img src="passnumber/images/jobsicons/job-4.jpg" width="84" height="84"/>'), //3
                  );
            ?>
            <div id="image_mode">
              <table id="userArrayTable">
                <tr>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[0]][$showSubArray0[4]] ?><span>4</span></td>
                </tr>
                <tr id="tr2">
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[1]][$showSubArray1[4]] ?><span>4</span></td>
                </tr>
                <tr>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[2]][$showSubArray2[4]] ?><span>4</span></td>
                </tr>
                <tr id="tr4">
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[1]] ?><span>1</span></td>
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[2]] ?><span>2</span></td>
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[3]] ?><span>3</span></td>
                  <td><?php echo $_symbols[$showKeys[3]][$showSubArray3[4]] ?><span>4</span></td> 
                </tr>
              </table>
            </div>   
   
   