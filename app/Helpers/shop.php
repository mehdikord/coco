<?php

function shop_categories_filter($items): array
{
    $result=[];
    foreach ($items as $item){
        $category = \App\Models\Category::find($item);
        if ($category){
            $result[]=$category->id;
            if ($category->children()->count()){
                foreach ($category->children as $child){
                    $result[] = $child->id;
                }
            }
        }
    }
    return array_unique($result);
}
