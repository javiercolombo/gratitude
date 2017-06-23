<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{


    private function getSerializer() {

        $encoders    = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        return new Serializer($normalizers, $encoders);

    }

    /**
    * Response helpers
    */

    protected function success($data) {

        $serializer = $this->getSerializer();

        $response = new Response($serializer->serialize($data, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(Response::HTTP_OK);

        return $response;

    }

    protected function fail($errorMsg, $errorCode = 500) {

        $response = new Response($errorMsg);
        $response->headers->set('Content-type', 'application/json');
        $response->setStatusCode($errorCode);

        return $response;

    }


    /**
    * Routing
    */

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/style-guide", name="style_guide")
     */
    public function styleGuideAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/style-guide.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/daily-gratitude", name="daily_gratitude")
     */
    public function dailyGratitudeAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/daily-gratitude.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }




}
