<?php
class categoria {
    public $id;
    public $desc;
    
    public function __construct($id, $desc){
        $this->id=$id;
        $this->desc=$desc;
    }
}
