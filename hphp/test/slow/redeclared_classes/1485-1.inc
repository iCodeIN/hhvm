<?hh

  class A {
    private $a = 1;
  }
  class B extends A {
    public $a;
    function f() {
 $this->a = 2;
 }
  }
