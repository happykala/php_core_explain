<?php

/**
 * @abstract 查找值
 */
function binary_search($nums,$search){
    if(count($nums) <= 1){
        return $nums;
    }
    binary_search_internal($nums,$search,0,count($nums) - 1);

}

function binary_search_internal($nums,$search,$low,$high){
    if($low > $high){
        return -1;
    }
    $mid = floor(($low + $hight)/2);
    if($search < $nums[$mid]){
        binary_search_internal($nums,$search,$low,$mid - 1);
    }else if($search > $nums[$mid]){
        binary_search_internal($nums,$search,$mid + 1,$high);
    }else{
        return $mid;
    }
}




/**
 * @abstract 产找第一个等于的值
 */
function binary_search_first($nums,$search){
    if(count($nums) <= 1){
        return $nums;
    }
    binary_search_internal_first($nums,$search,0,count($nums) - 1);

}

function binary_search_internal_first($nums,$search,$low,$high){
    if($low > $high){
        return -1;
    }
    $mid = floor(($low + $hight)/2);
    if($search < $nums[$mid]){
        binary_search_internal_first($nums,$search,$low,$mid - 1);
    }else if($search > $nums[$mid]){
        binary_search_internal_first($nums,$search,$mid + 1,$high);
    }else{
        if($mid == 0 || $nums[$mid -1] != $search){
            return $mid;
        }else{
            binary_search_internal_first($nums,$search,$low,$mid -1);
        }
        return $mid;
    }
}


/**
 * @abstract  查找第一个大于给定值的处理
 */
function binary_search_first_than($nums,$search){
    if(count($nums) <= 1){
        return $nums;
    }
    binary_search_internal_first_than($nums,$search,0,count($nums) - 1);
}

function binary_search_internal_first_than($nums,$search,$low,$high){
    if($low > $high){
        return -1;
    }
    $mid = floor(($low + $hight)/2);
    if($search <= $nums[$mid]){
        if($mind == 0 || $nums[$mid + 1] > $search){
            return $mid;
        }else{
            binary_search_internal_first_than($nums,$search,0,$mid - 1);
        }
    }else if($search > $nums[$mid]){
        binary_search_internal_first_than($nums,$search,$mid+1,$high);
    }
}


/**
 * @abstract 查找最后一个小于等于的值
 */
function binary_search_last_less($nums,$search){
    if(count($nums) <= 1){
        return $nums;
    }
    binary_search_internal_last_less($nums,$search,0,count($nums) - 1);
}

function binary_search_internal_last_less($nums,$search,$low,$high){
    if($low > $high){
        return -1;
    }
    $mid = floor(($low + $hight)/2);
    if($nums[$mid] <= $search){
        if($mid == count($nums) -1 || $nums[$mid + 1] > $search){
            return $mid;
        }else{
            binary_search_internal_last_less($nums,$search,0,$mid -1);
        }
    }else if($nums[$mid] > $search){
        binary_search_internal_last_less($nums,$search,$mid + 1,$high);
    }
}