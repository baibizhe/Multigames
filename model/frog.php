<?php
// $frogs = array("0"=>"y1","1"=>"y2","2"=>"y3","4"=>"g1","5"=>"g2","6"=>"g3");
// echo array_keys($frog);
// // for ($i=0;$i<7;$i++){
// //        echo  $frogs["$i"];

// // }
class FrogGame {
	public $frogs = array("0"=>"y1","1"=>"y2","2"=>"y3","3"=>"n","4"=>"g1","5"=>"g2","6"=>"g3");
	public $state = "";

	public function __construct() {
        $this->frogs =  array("0"=>"y1","1"=>"y2","2"=>"y3","3"=>"n","4"=>"g1","5"=>"g2","6"=>"g3");

    	}
    public function render($i){
            
            if($pic[$i] == "n"){echo "empty.gif";}
        
    }
	public function move($frog){
		for ($i=0;$i<7;$i++){
            if($frogs[i] == $frog){$frogs[i] == "n";}
            if($frogs[i] == "n"){$frogs[i] = $frog;}
        }

        if($forgs[0]=="g1" && $forgs[1]=="g2" && $forgs[2]=="g3" ){
            $this->state = "win";
        }
	}

	public function getState(){
		return $this->state;
	}
}?>


