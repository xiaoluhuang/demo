<?php
/* *****************************************************************
 * @Author: huangxiolu
 * @Created Time : 三  5/24 08:50:05 2017
 *
 * @File Name: src/Book.php
 * @Description:
 * *****************************************************************/
namespace Src;
class Book
{
    private $book=array();
    public function pushBook($bookId,$bookName)
    {
        if ($bookId && $bookName) {
            $this->book[$bookId] = $bookName;
        }
    }
    public function getBook($bookId)
    {
        return $this->book[$bookId];
    }
}
