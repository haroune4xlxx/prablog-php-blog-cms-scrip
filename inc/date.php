<?php

/*
    Uncomment (remove the double slash - //)
    from the date format you want to use

    Comment (Add a double slash - //) 
    to the front of the date formats you do NOT want to use
*/


function dateFormat() {
  $theDate = date("Y-m-d"); // 2017-12-31
  // $theDate = date("m-d-Y"); // 12-31-2017
  // $theDate = date("d-m-Y"); // 31-12-2017

  return $theDate;
}

