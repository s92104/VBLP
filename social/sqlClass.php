<?php
include("mysql_connect.inc.php");
define("title", 0);
define("writer", 1);
define("article", 2);
define("time", 3);
define("comment", 4);
define("hot", 5);
define("head", 6);
define("token", 0);
define("username", 1);
define("email", 3);
define("point", 4);
define("name", 5);
define("genre", 6);
define("emailVerify", 7);
define("verifyCode", 8);

/**
 *
 */
class datebase
{
    private $sqlName;
}

/**
 *
 */
class Mysql extends datebase
{

  // function __construct(argument)
    // {
    //   // code...;
    // }
    public function exe($sql)
    {
        return mysql_query($sql);
    }
    public function selectFrom($datasheet)
    {
        $sql="SELECT * FROM $datasheet";
        return mysql_query($sql);
    }
    public function select($datasheet, $which, $what)
    {
        $sql="SELECT * FROM $datasheet WHERE $which =  '$what'";
        return mysql_query($sql);
    }
    public function orderby($board, $something)
    {
        $sql = "SELECT * FROM $board ORDER BY $something DESC";
        return mysql_query($sql);
    }
    public function update($datasheet, $colcomment, $comment, $coltitle, $title)
    {
        $sql = "UPDATE $datasheet SET $colcomment = '$comment' WHERE $coltitle =  '$title'";
        return mysql_query($sql);
    }
    public function insert(
        $datasheet,
        $dtitle,
        $dwriter,
        $darticle,
        $dtime,
        $title,
        $id,
        $article,
        $time
    ) {
        $sql = "INSERT INTO $datasheet($dtitle,$dwriter,$darticle,$dtime) values
      ('$title','$id','$article','$time')";
        return mysql_query($sql);
    }
    public function num_rows($sql)
    {
        return mysql_num_rows($sql);
    }
    public function fetch_row($sql)
    {
        return mysql_fetch_row($sql);
    }

    public function getRow($datasheet, $which, $what)
    {
        $row = mysql_fetch_row(Mysql::select($datasheet, $which, $what));
        return $row;
    }
    public function delete($datasheet, $which, $what)
    {
        $sql = "DELETE FROM $datasheet WHERE $which =  '$what'";
        return mysql_query($sql);
    }
}
