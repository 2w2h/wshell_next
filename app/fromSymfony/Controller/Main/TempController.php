<?php

namespace WshellBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TempController extends Controller
{
    public function stickersAction($pack, $size)
    {
      return $this->render('WshellBundle:Temp:stickers.html.twig', [
        'pack' => $pack,
        'size' => $size,
      ]);
    }
}
