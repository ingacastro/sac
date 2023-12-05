<?php
class subcategoria {
  public $idsubcat;
  public $cat;
  public $sub;
  public $desub;
  
  public function __construct($idsubcat, $cat, $sub, $desub) {
      $this->idsubcat=$idsubcat;
      $this->cat=$cat;
      $this->sub=$sub;
      $this->desub=$desub;
  }
}
