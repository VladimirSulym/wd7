<script>
            let socket = new WebSocket('ws://127.0.0.1:38100');
</script>

<?php
die();
/**
 * @todo comment my code
 */

$config = include __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';

if (true) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

include 'classes/core.php';

$app = new core($config);
$app->run();

/**/
//include 'app/controllers/MainController.php';
/*
$app = new core;
$app->run();

/*
include 'classes/core.php';

$app = new core;
$app->run();
/**/

/*
$r = new request;
echo '<pre>';
print_r($r->metod());
die();
/**/

/*
$a = 100; // 0x00f1023d
// 
// $this-> | self:: | static:: | parent::

class a
{
    public function __destruct() {echo "\n---------------\n";}

    public $test = 100;
    protected $pr = 90;

    public function test()
    {
        echo $this->test . "\n";
        echo self::$pr . "\n";
    }
}

class b extends a
{
    public function getValue()
    {
        return self::value();
    }
    public function value()
    {
        return 100;
    }
}

class c extends b
{
    //private $pr = 900;
    public $test = 200;
    
    public function test()
    {
        parent::test();
        return;
        return parent::getValue();
    }
    public function getValue()
    {
        return $this->value();
    }
    public function value()
    {
        return 200;
    }
}

$obj = new c; // 0x00f1023d
echo $obj->test();

/*
class a
{
    public $test;
    public function test() {}
}

/*
die();
class img
{
    protected $types = [
        'image/gif', 
        'image/jpeg', 
        'image/pjpeg', 
        'image/png', 
        'image/webp'
    ];

    public function resF ()
    {
         //разрешенные форматы картинок.
        $res = [
            'old_name' => '',
            'new_name' => '',
            'size' => '',
            'type' => ''
        ];

        if (!in_array($_FILES['file']['type'], $this->types)) {
            echo 'файл не является картинкой';
            return;
        }

        $res['old_name'] = $_FILES['file']['name'];
        $res['new_name'] = md5_file($_FILES['file']['tmp_name']);
        $res['size'] = $_FILES['file']['size'];
        $res['type'] = $_FILES['file']['type'];
        move_uploaded_file($_FILES['file']['tmp_name'], './ns/' . $res['new_name']);
        //print_r($res);
        return($res);
    }
}
$res = new img();
$res->resF();
/*
echo '<pre>';
print_r($_FILES);
class fileLoader
{
    const FILE_MAX_SIZE = 5242880;
    protected $availableTypes = [
        'image/jpeg',
        'image/gif',
        'image/png',
        'image/webp',
        'image/xml+svg'
    ];

    protected function validateFile()
    {
        if (((int) $_FILES['img']['size']) > self::FILE_MAX_SIZE) {
            throw new Exception('Too large size of file');
        }
        if (!in_array($_FILES['img']['type'], $this->availableTypes)) {
            throw new Exception('Wrong filetype');
        }
    }

    protected function getNewName()
    {
        $extension = explode('.', $_FILES['img']['name']);
        $extension = end($extension);
        return md5_file($_FILES['img']['tmp_name']) . '.' . $extension;
    }

    public function change($path)
    {
        try {
            $this->validateFile();
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $arr = [
            'origin_name'   => $_FILES['img']['name'],
            'size'          => $_FILES['img']['size'],
            'type'          => $_FILES['img']['type'],
            'save_name'     => $this->getNewName()
        ];

        move_uploaded_file($_FILES['img']['tmp_name'], rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $arr['save_name']);

        return $arr;
    }
}
$fileLoader = new fileLoader();
print_r($fileLoader->change('./img/tmp/'));



/*
class a
{
    public function __construct()
    {
        
    }
}
class b extends a
{
    private function __construct()
    {
        
    }
}
die();
/*
$parts = pathinfo($_GET['controller']);
echo '<pre>';print_r($parts);
$ext = $parts['extension'];
$blacklist = array('php', 'phtml', 'php3', 'php4', 'php5');
if(in_array($ext, $blacklist)) {
	die('Invalid input');
}
/**/
//phpinfo();die();
//var_dump(get_magic_quotes_gpc());
//echo __DIR__;die();
/*
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/app/controllers');
$ctr = $_GET['controller'];
//echo strlen($ctr);die();
$ctrFileName = ($ctr) . 'Controller.php';
//echo
//echo '<pre>';print_r(pathinfo($ctrFileName));die();
var_dump(include $ctrFileName);

/*
include 'classes/core.php';

$app = new core;
$app->run();
/**/


/*
//Замечание: Конструкторы, определённые в классах-родителях не вызываются автоматически, если дочерний класс определяет собственный конструктор. Чтобы вызвать конструктор, объявленный в родительском классе, требуется вызвать parent::__construct() внутри конструктора дочернего класса. Если в дочернем классе не определён конструктор, то он может быть унаследован от родительского класса как обычный метод (если он не был определён как приватный). 
include './classes/singletonTrait.php';
abstract class d
{
    public function __construct()
    {
        echo "A\n";
    }
}
abstract class c  extends  d
{
    public function __construct()
    {
        echo "A\n";
    }
}
class b extends  c
{
    public function __construct()
    {
        echo "A\n";
    }
    //use singletonTrait;
}
abstract class aParent extends b
{
    public function __construct()
    {
        echo "A\n";
    }
}
class a extends aParent
{
    public function __construct()
    {
        echo "A\n";
    }
    //use singletonTrait;
}
class aChild extends a
{
    public function __construct()
    {
        echo "B\n";
        parent::__construct();
    }
    public function test()
    {
        echo "?????\n";
    }
}
$a = aChild::getInstance();
//$a = new aChild;


//$a->test();
//$a = a::getInstance();
//$a->test();
print_r($a);
die();
/*
class a
{
    private $objB = null;
    private $objC = null;

    public function __construct()
    {
        $this->objB = new b();
        $this->objC = new c();
    }

    public function doWork()
    {
        $this->objB->printStr();
        $this->objC->printStr();
    }
}

class b
{
    public function printStr()
    {
        echo "aaaa\n";
    }
}
class c
{
    public function printStr()
    {
        echo "ccc\n";
    }
}

$a = new a();
$a->doWork();
die();
//загрузка файловecho '<pre>';
/*
print_r($_FILES);
class fileLoader
{
    public function change()
    {
        $arr = [];
        $arr['origin_name'] = $_FILES['img']['name'];
        $arr['size'] = $_FILES['size'];
        $arr['type'] = $_FILES['type'];
        $newName = md5_file($_FILES['tmp_name']);
        move_uploaded_file($_FILES['tmp_name'],'img/'.$newName);
        $arr['save_name'] = $newName;
        return $arr;
    }
}
$fileLoader = new fileLoader($_FILES);
print_r($fileLoader->change());
/**/

// 
//class fileLoader1
//{
//    public function test()
//    {
//        echo '<pre>';
//        print_r($_FILES);
//    }
//    /*
//    [
//        'save_name' => '', 
//        'orig_name' => '', 
//        'size' => '', 
//        'type' => ''
//    ];
//    /**/
//    //print_r($_FILES);
//    //move_uploaded_file($filename, $destination);
//    // jpg jpeg - image/jpeg
//}
//$f = new fileLoader;
//$f->test();
//
//class test
//{
//    public      $a = 100;
//    protected   $b = 200;
//    private     $c = 300;
//
//    protected function testA()
//    {
//        //echo $this->c . "\n";
//        //sha1_file();
//        //md5_file();
//        //hash('sha512', '');
//        return $this->c;
//    }
//}
//
//class test2 extends test
//{
//    protected        $c = 90;
//    //protected      $a = 10;
//    public function testB()
//    {
//        echo $this->c . "\n";
//        //echo $this->b . "\n";
//        return $this->testA();
//    }
//}
//
//$t2 = new test2;
//echo $t2->testB();
//echo "\n";
//print_r($t2);
