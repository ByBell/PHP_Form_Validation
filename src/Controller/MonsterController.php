<?php

namespace App\Controller;

use App\Entity\Monster;
use App\Form\MonsterType;
use App\Repository\MonsterRepository;
use App\Service\Bleech;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MonsterController extends Controller
{
    /**
     * @Route("/monster", name="monster_index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $monsterCollection = $em->getRepository("App:Monster")->findAll();

        return $this->render('monster/index.html.twig', [ 'monsters' => $monsterCollection]);
    }

    /**
     * @param int $id
     * @return response
     *
     * @Route("/monster/{id}", name="monster_show")
     */
    public function show($id, Bleech $bleech)
    {
        $em = $this->getDoctrine()->getManager();
        $monsterCollection = $em->getRepository("App:Monster")->findOneBy(['id' => $id]);
        $age = $bleech->getAge($monsterCollection->getDob());

        return $this->render('monster/show.html.twig', [ 'monster' => $monsterCollection, 'age' => $age]);
    }

    /**
     * @Route("/register", name="monster_register")
     */
    public function registerForm(Request $request ): Response
    {
        $monster = new Monster();
        $form = $this -> createForm(MonsterType::class, $monster);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($monster);
            $em->flush();

            return $this->redirectToRoute('monster_index');

        }

        return $this->render('monster/register.html.twig', ['formAjout'=>$form->createView()]);
    }

    /**
     * @param int $id
     *
     * @return response
     *
     * @Route("/delete/{id}", name="monster_delete")
     */
    public function deleteForm($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monsterDel = $em->getRepository("App:Monster")->findOneBy(['id' => $id]);
        $em->remove($monsterDel);
        $em->flush();

        return $this->redirectToRoute('monster_index');
    }
}
