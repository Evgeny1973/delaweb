<?php

declare(strict_types=1);

namespace App\Controller\SignUp;

use App\Model\User\UseCase\SignUp\SignUpForm;
use App\Model\User\UseCase\SignUp\SignUpCommand;
use App\Model\User\UseCase\SignUp\SignUpHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SignUpController extends AbstractController
{
    /**
     * @Route("/signup", name="signup", methods={"GET", "POST"})
     *
     * @param Request       $request
     * @param SignUpHandler $handler
     * @return Response
     */
    public function signUp(Request $request, SignUpHandler $handler): Response
    {
        $command = new SignUpCommand();
        
        $form = $this->createForm(SignUpForm::class, $command);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $handler->handle($command);
                $this->addFlash('success', 'Регистрация прошла успешно.');
                return $this->redirectToRoute('profile');
            } catch (\DomainException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }
        
        return $this->render('signup/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
