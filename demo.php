<?php
require('./Task.php');
require('./Scheduler.php');

function micro_time(){
    list($usec, $sec) = explode(" ", microtime());
    echo $sec+$usec.PHP_EOL;
}

function task1(){
    for ($i=1; $i<=10; ++$i) {
        echo "This is task 1 iteration $i.\n";
        yield;
    }
}

function task2(){
    for ($i=1; $i<=5; ++$i) {
        echo "This is task 2 iteration $i.\n";
        yield;
    }
}
$scheduler = new Scheduler;
$scheduler->newTask(task1());
$scheduler->newTask(task2());
$scheduler->run();
exit;

function gen(){
    $ret = (yield 'yield1');
    var_dump(array('yield1', $ret));
    var_dump('gen1');
    $ret = (yield 'yield2');
    var_dump(array('yield2', $ret));
    var_dump('gen2');
}

$gen = gen();
var_dump($gen->current());
var_dump($gen->next());
var_dump($gen->current());
var_dump($gen->next());
var_dump($gen->current());
var_dump($gen->send('ret1'));
//var_dump($gen->send('ret2'));
exit;

function logger($fileName){
    $fileHandle = fopen($fileName, 'a');
    while (true) {
        fwrite($fileHandle, yield . "\n");
    }
}

$logger = logger(__DIR__ . '/log');
$logger->send('Foo');
$logger->send('Bar');
exit;

function xrange($start, $end, $step=1) {
    for($i = $start; $i<= $end; $i+= $step) {
        yield $i;
    }
}

$range = xrange(1, 1000000);
//var_dump($range->current());
//var_dump($range->next());
//var_dump($range->current());
//var_dump($range);exit;
//var_dump($range instanceof Iterator);exit;
foreach ($range as $num) {
    echo $num, "\n";
}

exit;

function getLines($path)
{
   $f = fopen($path,'r');
   while($f && !feof($f))
   {
        $data = fgets($f);
        yield $data;
    }

    fclose($f);

}
$path = './demo.log';
foreach(getLines($path) as $line=>$val)
{
    if($line>100000) break;
    echo $val."<br />";
}
exit;

$str = 'acdbcaefasssdaazxpngalajpifqwenzsdpxmsh';
micro_time();
if(strlen($str) > 0){
    $str = array_search( 1, array_count_values(str_split($str, 1)));
    print_r($str);
}
micro_time();

micro_time();
$string = $str; //"abaccdeff";
$length = strlen($string);
for ($i = 0; $i < $length; $i++) {
    if (substr_count($string, $string {
        $i
    }) == 1) return $string {
        $i
    };
}
micro_time();

exit;

/**
 * 组合枚举
 */
function c($arr, $n, &$res, $pre = array())
{
    if ($n == 0)
    {
        $res[] = $pre;
    }
    else
    {
        $count = count($arr);
        for ($i = 0; $i < $count - $n + 1; $i++)
        {
            $temp = array_shift($arr);
            c($arr, $n - 1, $res, array_merge($pre, array(
                $temp
            )));
        }
    }
}
// 处理数组
$arr = array(11, 18, 12, 1, -2, 20, 8, 10, 7, 6, 12, 6, 6, 6, -6 );
$sum = 18; // 条件和值

$count = count($arr);
// 从C(18,1) 循环到 C(18,18)
for ($i = 1; $i <= $count; $i++)
{
    $res = array();
    c($arr, $i, $res);
print_r($res);
//    foreach ($res as $val)
//    {
//        if (array_sum($val) == $sum)
//        {
//            echo implode(' + ', $val), ' = ', $sum, PHP_EOL;
//        }
//    }
}
