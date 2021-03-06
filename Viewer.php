<?php

namespace NTI\PdfJsBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Router;
use Twig\Environment;

class Viewer {

    /** @var ContainerAwareInterface $container */
    private $container;

    /** @var Environment $templating */
    private $templating;

    /** @var Router $router */
    private $router;

    public function __construct(ContainerInterface $container, Environment $templating, Router $router) {
        $this->container = $container;
        $this->templating = $templating;
        $this->router = $router;
    }

    public function viewFromRoute($route, $params, $filename) {

        $params[] = array("filename" => $filename);

        $pdf = $this->router->generate($route, $params);

        return $this->templating->render('NTIPdfJsBundle:Viewer:viewer.html.twig', array(
            'file' => $pdf
        ));
    }

    public function viewFromPath($path, $pdf) {
        return $this->templating->render('NTIPdfJsBundle:Viewer:viewer.html.twig', array(
            'file' => $pdf
        ));
    }

}