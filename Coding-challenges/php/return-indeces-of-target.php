<?php

/**
 * Question: Given an array of integers: $arr = [2, 7, 11, 15]; 
 * and a target: $target = 9; 
 * Return the indices of the two numbers whose sum equals the target.
*/

function arrIndex($arr, $target){

$arrCount = count($arr);
   
for($i = 0; $i < $arrCount; $i++){
	    for($j = $i+1; $j<$arrCount; $j++){
			$addition = $arr[$i] + $arr[$j];
			if($addition == $target){
				return [$i, $j];
			}
		}	
	}

	return [];
}

var_dump(arrIndex([1, 2, 3, 4, 5], 7));
var_dump(arrIndex([2, 7, 11, 15], 9));
var_dump(arrIndex([3,2,4], 6));