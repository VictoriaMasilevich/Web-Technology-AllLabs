<?php
 
    class Include_template {
      private $_file; 
      private $_arr; 

      public function SetTemplate($file)
      { 
        $this->_file = $file; 
      }
 
      public function AssignArr($VarName, $VarValue) 
      { 
        if ($VarName !== '') { 
          $this->_arr[$VarName] = $VarValue; 
        } 
      }
 
      public function Display() 
      { 
        echo $this->_Prepare(); 
      }
 
      private function _Prepare() 
      { 
        $Content = ''; 
        if (file_exists($this->_file)) { 
          $Content = file_get_contents($this->_file); 
          foreach ($this->_arr as $VarName=>$VarValue) {
            $Content = str_replace('{' . $VarName . '}', $VarValue, $Content); 
          } 
        } 
        return $Content; 
      } 
    }
 
?>