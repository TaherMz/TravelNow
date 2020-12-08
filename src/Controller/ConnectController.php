<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ConnectController extends AbstractController
{
    /**
     * @Route("/" , name="connect")
     * @return Response
     */

    public function index(): Response
    {
        return  $this->render('pages/connect.html.twig');
    }
}