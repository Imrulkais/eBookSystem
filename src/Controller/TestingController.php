<?php
// src/Controller/TestingController.php
namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestingController extends AbstractController
{
    public function number()
    {
        return $this->render('base.html.twig');
    }
}