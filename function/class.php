<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 一  3/13 16:30:02 2017
 *
 * @File Name: class.php
 * @Description:
 * *****************************************************************/
class A{
     function foo(){
         if (isset($this)) {
              echo '$this is defined (';
              echo get_class($this);
              echo ")\n";
               } else {
                                                                                echo "\$this is not defined.\n";
                                                                                        }
                                }
}
