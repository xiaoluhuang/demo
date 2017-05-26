<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  5/24 08:50:56 2017
 *
 * @File Name: test/BookTest.php
 * @Description:
 * *****************************************************************/
namespace Test;

use PHPUnit\Framework\TestCase;
use Src\Clean;

class CleanTest extends TestCase
{
    public function testclean()
    {
        $book = new Clean();
        $array = ['   adf   ', 'sdf ', ' "   sdf ', ' aff nnn\'',];
        $book->myTrim($array);
        $this->assertEquals('《三体》',$book->getBook(1) );
    }
}
