<?php

namespace App\TreeNode;

use App\Entities\Category;

class CategoryTree{

    private $id;
    private $name;
    private $childlist = array();
    private $depth;

    public function __construct($id,$name,$depth){

        $this->id = $id;
        $this->name = $name;
        $this->depth = $depth;

        $categories = Category::where('parent_id',$id)->get();
        foreach($categories as $key=>$category){
            $this->childlist[$key] = new CategoryTree($category->id,$category->name,$depth+1);
        }
    }

    public function display(){

        if($this->depth > 0){

            for($i = 0; $i < $this->depth; $i++)  {
                echo "<option value='".$this->id."'>- ".$this->name."</option>";
            }
        }
        else{
            echo  "<option>".$this->name."</option>";
        }
        $num_children = sizeof($this->childlist);
        for($i = 0; $i<$num_children; $i++) {
             $this->childlist[$i]->display();
        }
    }
}

?>