<?php
/**
 * @abstract
 */
function bulle_sort($num){
    if(count($num) <= 1){
        return $num;
    }
    for($i=0;$i<count($num);$i++){
        $flag = false;
        for($j=0;$j<count($num)-$i-1;$j++){
            if($num[$j] > $num[$j+1]){
                $temp = $num[$j];
                $num[$j] = $num[$j+1];
                $num[$j+1] = $temp;
                $flag = true;
            }
        }
        if(!$flag){
            break;
        }
    }
    return $num;
}

$nums = [4, 5, 6, 3, 2, 1];
print_r(bulle_sort($nums));exit;

/**
 * @abstract 
 */
function insert_sort($nums){
    if(count($nums) <= 1){
        return $nums;
    }
    for($i=0;$i<count($nums);$i++){
        $value = $nums[$i];
        $j=$i-1;
        for(;$j>=0;$j--){
            if($nums[$j+1] > $nums[$j]){
                $nums[$j+1]
            }else{
                break;
            }
        }
        $nums[$j+1] = $value;
    }
    return $nums;
}

/**
 * @abstract
 */
function select_sort($nums){
    if(count($nums) <= 1){
        return $nums;
    }    
    for($i=0;$i<count($nums);$i++){
        $min = $i;
        for($j=$i+1;$j<count($nums);$j++){
            if($nums[$j] < $nums[$min]){
                $min = $j;
            }
        }
        if($min != $i){
            $temp = $nums[$i];
            $nums[$i] = $nums[$min];
            $nums[$min] = $temp
        }
    }
    return $nums;
}

/**
 * @abstract 
 */
function quick_sort($nums){
    if(!is_array($nums)){
        return false;
    }
    if(count($nums) <= 1){
        return $nums;
    }
    $left = $right = array();
    for($i=0;$i<count($nums);$i++){
        if($nums[$i] > $nums[0]){
            $right[] = $nums[$i];
        }else{
            $left[] = $nums[$i];
        }
    }
    $left = quick_sort($left);
    $right = quick_sort($right);
    return array_merge($left,array($nums[0]),$right);
}