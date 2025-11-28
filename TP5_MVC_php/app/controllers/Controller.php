<?php
abstract class Controller {
    
    // Abstract methods to be implemented by concrete subclasses
    abstract public function index();

    //abstract public function show($id);

    abstract public function create();

    abstract public function edit();

    abstract public function delete();
}
