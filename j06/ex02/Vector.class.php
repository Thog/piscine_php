<?php

require_once 'Vertex.class.php';
class Vector
{
    public static $verbose = FALSE;
    private $_x;
    private $_y;
    private $_z;
    private $_w = 0;
    
    public function __construct(array $args)
    {
        if (!array_key_exists('dest', $args))
            return;
        if (!array_key_exists('orig', $args))
            $args['orig'] = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
        $this->_x = $args['dest']->getX() - $args['orig']->getX();
        $this->_y = $args['dest']->getY() - $args['orig']->getY();
        $this->_z = $args['dest']->getZ() - $args['orig']->getZ();
        $this->_w = $args['dest']->getW() - $args['orig']->getW();
        if (self::$verbose == TRUE)
            printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) constructed\n", $this->getX(), $this->getY(), $this->getZ(), $this->getW());
    }

    public function __destruct()
    {
        if (self::$verbose == TRUE)
            printf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed\n", $this->getX(), $this->getY(), $this->getZ(), $this->getW());
    }

    public function __toString()
    {
        return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->getW()));
    }

    public function magnitude()
    {
        return (sqrt($this->getX() * $this->getX() + $this->getY() * $this->getY() + $this->getZ() * $this->getZ()));
    }

    public function normalize()
    {
        $magnitude = $this->magnitude();
        return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() / $magnitude, 'y' => $this->getY() / $magnitude, 'z' => $this->getZ() / $magnitude)))));
    }

    public function add(Vector $other)
    {
        return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() + $other->getX(), 'y' => $this->getY() + $other->getY(), 'z' => $this->getZ() + $other->getZ())))));
    }

    public function sub(Vector $other)
    {
        return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() - $other->getX(), 'y' => $this->getY() - $other->getY(), 'z' => $this->getZ() - $other->getZ())))));
    }

    public function opposite()
    {
        return (new Vector(array('dest' => new Vertex(array('x' => -$this->getX(), 'y' => -$this->getY(), 'z' => -$this->getZ())))));
    }

    public function scalarProduct($k)
    {
        return (new Vector(array('dest' => new Vertex(array('x' => $this->getX() * $k , 'y' => $this->getY() * $k , 'z' => $this->getZ() * $k)))));
    }

    public function dotProduct(Vector $other)
    {
        return ($this->getX() * $other->getX() + $this->getY() * $other->getY() + $this->getZ() * $other->getZ());
    }

    public function cos(Vector $other)
    {
        return ($this->dotProduct($other) / (abs($this->magnitude() * sqrt($other->getX() * $other->getX() + $other->getY() * $other->getY() + $other->getZ() * $other->getZ()))));
    }
    
    public function crossProduct(Vector $other)
    {
        return (new Vector(array('dest' => new Vertex(array('x' => $this->getY() * $other->getZ() - $this->getZ() * $other->getY() , 'y' => $this->getZ() * $other->getX() - $this->getX() * $other->getZ() , 'z' => $this->getX() * $other->getY() - $this->getY() * $other->getX())))));
    }

    public static function doc()
    {
        $read = fopen("Vector.doc.txt", 'r');
        while ($read && !feof($read))
            echo fgets($read);
        echo "\n";
    }

    public function getX() { return $this->_x; }
    public function getY() { return $this->_y; }
    public function getZ() { return $this->_z; }
    public function getW() { return $this->_w; }
}

?>