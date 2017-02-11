<?php


namespace AppBundle\Controller\MapGenerator;

use AppBundle\Form\BasketballInputFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapGeneratorController extends Controller
{
    /**
     * @Route("/input", name="user_input")
     */
    public function inputAction(Request $request)
    {
        $form = $this->createForm(
            BasketballInputFormType::class
        );

        return $this->render('map_generator/input_form.html.twig', [
            'productForm' => $form->createView()
        ]);
    }
}