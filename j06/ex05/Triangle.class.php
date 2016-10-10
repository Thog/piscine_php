<?php
class Triangle
{
    static $verbose = false;
    private $_a;
    private $_b;
    private $_c;

    public function __construct($a, $b, $c)
    {
        if ($a instanceof Vertex && $b instanceof Vertex && $c instanceof Vertex)
        {
            $this->_a = $a;
            $this->_b = $b;
            $this->_c = $c;
            if (Self::$verbose)
                printf("Triangle( a: %s, b: %s, c: %s ) ) constructed\n", $a, $b, $c);
        } else
            $this->__destruct();
    }

    function __destruct()
    {
        if (Self::$verbose)
            printf("Triangle( a: %s, b: %s, c: %s ) ) destructed\n", $a, $b, $c);
    }

    function __toString()
    {
        return (vsprintf("Triangle( a: %s, b: %s, c: %s ) )", $a, $b, $c));
    }

    public static function doc()
    {
        $read = fopen("Triangle.doc.txt", 'r');
        while ($read && !feof($read))
            echo fgets($read);
        echo "\n";
    }

    public function getA()
    {
        return $this->_a;
    }

    public function getB()
    {
        return $this->_b;
    }

    public function getC()
    {
        return $this->_c;
    }
}
?>