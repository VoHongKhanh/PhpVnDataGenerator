<?php
/**
  * Test
  * 
  * 
  * @package PhpVnDataGenerator
  * @author  Võ Hồng Khanh <khanhvohong@gmail.com>
  * @license LGPL
  * @version 1.0   
  */

/**
  * @package PhpVnDataGenerator
  */
namespace PhpVnDataGenerator;

use PhpVnDataGenerator\VnBase;

/**
  * @class VnTest Test library features.
  */
class VnTest
{
	/**
      * @method          testUniqueList  Check unique list.
      * @param  string   $a              An array.
      * @param  string   $isSort         Is array sored: VnSorting, VnNonSorting.
      * @return void                       
      */
    public function testUniqueList(&$a, $isSort = VnBase::VnSorting) {
        if ($isSort) {
            sort($a, SORT_STRING);
        }

        $n = count($a);
        $duplicates = [];
        for ($i=0; $i <= $n-2 ; $i++) { 
            if ($a[$i] == $a[$i+1] ||
                VnBase::Vn2En($a[$i]) == VnBase::Vn2En($a[$i+1])) {
                array_push($duplicates, ["index"=>$i, "name"=>$a[$i]." - ".$a[$i+1]]);
            }
        }
        if (count($duplicates) == 0) {
            echo "<b>don't have duplicate name</b>";
        } else {
            echo "<b>duplicate names</b><br/>";
            foreach ($duplicates as $i => $value) {
                echo ($i+1).". ".$value['index']." and ".($value['index']+1)." (".$value['name'].")<br/>";
            }
        }
    }
}
