<?php

/*
|--------------------------------------------------------------------------
| Rotate Array to the Right
|--------------------------------------------------------------------------
|
| Problem Statement:
|
| Given an array of integers, rotate the array to the right by `k`
| positions.
|
| A right rotation moves the last element of the array to the front.
| Repeat this process `k` times.
|
| Examples:
|
| Example 1:
| Input:
|   $arr = [1, 2, 3, 4, 5, 6, 7];
|   $k = 3;
|
| Output:
|   [5, 6, 7, 1, 2, 3, 4]
|
| Example 2:
| Input:
|   $arr = [1, 2];
|   $k = 5;
|
| Output:
|   [2, 1]
|
| Function Signature:
|
|   function rotateArray(array $arr, int $k): array
|
| Constraints:
|
| - The array contains one or more integers.
| - `k` may be greater than the length of the array.
| - Return the rotated array.
| - Do not modify the original array unless specified.
|
*/

function rotateArray(array $arr, int $k): array 
{
    $n = count($arr); 
    // Store the total number of elements in the array

    $k = $k % $n; 
    // If k is greater than array length, reduce unnecessary rotations
    // Example: array length = 2, k = 5 => 5 % 2 = 1 rotation

    $rotated = array(); 
    // Create an empty array to store the rotated elements

    for ($i = 0; $i < $n; $i++) { 
        // Loop through every index of the array
        // $i represents the position in the new rotated array

        $index = ($i - $k + $n) % $n;
        // Calculate which index from the original array should come here
        // Adding $n prevents negative indexes
        // % $n keeps the index within the array range (0 to n-1)

        $rotated[$i] = $arr[$index];
        // Assign the original array value to the new rotated array position
    }

    return $rotated; 
    // Return the final rotated array
}

echo implode(", ", rotateArray([1, 2, 3, 4, 5, 6, 7], 3)) . "\n"; // Output: "5, 6, 7, 1, 2, 3, 4"
echo implode(", ", rotateArray([1, 2], 5)) . "\n"; // Output: "2, 1"