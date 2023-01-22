<?php
namespace Classes;

interface Routes {
    public function getController($name);
    public function getDefaultRoute();
    public function checkLogin($route);
    //public function checkAdminLogin($route);

}