<?php

/*
|--------------------------------------------------------------------------
| First Non-Repeating Character
|--------------------------------------------------------------------------
|
| Problem Statement:
|
| Given a string, return the first non-repeating character.
|
| If all characters repeat, return null.
|
| Examples:
|
| Example 1:
| Input:
|   $str = "programming";
| Output:
|   "p"
|
| Example 2:
| Input:
|   $str = "aabbccddeef";
| Output:
|   "f"
|
| Example 3:
| Input:
|   $str = "aabbcc";
| Output:
|   null
|
| Function Signature:
|
|   function firstNonRepeatingCharacter(string $str)
|
| Constraints:
|
| - The string contains only lowercase English letters.
| - Return the first character that appears exactly once.
| - Return null if no such character exists.
|
*/

function firstNonRepeatingCharacter(string $str) {
    $charCount = [];
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        if (isset($charCount[$char])) {
            $charCount[$char]++;
        } else {
            $charCount[$char] = 1;
        }
    }
    foreach ($charCount as $char => $count) {
        if ($count === 1) {
            return $char;
        }
    }
    return null;
}

echo firstNonRepeatingCharacter("programming") . "\n"; // Output: "p"
echo firstNonRepeatingCharacter("aabbccddeef") . "\n"; // Output: "f"
echo firstNonRepeatingCharacter("aabbcc") . "\n"; // Output: null