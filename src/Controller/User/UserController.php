<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Model\User\UseCase\Update\UpdateCommand;
use App\Model\User\UseCase\Update\UpdateForm;
use App\ReadModel\User\UserFetcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("IS_AUTHENTICATED_REMEMBERED")
 */
final class UserController extends AbstractController
{
    private MessageBusInterface $messageBus;
    
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }
    
    /**
     * @Route("/profile", name="profile", methods={"GET", "POST"})
     *
     * @param Request     $request
     * @param UserFetcher $users
     * @return Response
     */
    public function profile(Request $request, UserFetcher $users): Response
    {
        $user = $users->findFullById($this->getUser()->getId());
        
        $command = UpdateCommand::fromRequest($user);
        
        $form = $this->createForm(UpdateForm::class, $command);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->messageBus->dispatch($command);
                $this->addFlash('success', 'Профиль обновлён.');
                return $this->redirectToRoute('profile');
            } catch (HandlerFailedException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }
        
        return $this->render('user/profile.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
