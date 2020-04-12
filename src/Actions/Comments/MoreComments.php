<?php

namespace App\Actions\Comments;

use App\Entity\Comments;
use App\Repository\CommentsRepository;
use App\Repository\FigureRepository;
use App\Traits\RequestToolsTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class MoreCom
 * @package App\Actions\Comments
 * @Route("tricks/details/more_com", name="more.coms")
 *
 */
class MoreComments extends CommentsTools
{
    /** @var Environment  */
    private $environment;

    /**
     * MoreComments constructor.
     * @param Environment $environment
     * @param EntityManagerInterface $manager
     * @param TokenStorageInterface $tokenStorage
     * @param FigureRepository $tricksRepo
     * @param CommentsRepository $commentsRepo
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        Environment $environment,
        EntityManagerInterface $manager,
        TokenStorageInterface $tokenStorage,
        FigureRepository $tricksRepo,
        CommentsRepository $commentsRepo,
        UrlGeneratorInterface $router
    ) {
        parent::__construct($manager,$tokenStorage,$tricksRepo,$commentsRepo, $router);
        $this->environment = $environment;
    }


    /**
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function __invoke(Request $request)
    {
        $pageId = $this->getPageId($request);
        $trickId = $this->getTrickId($request);
        $offset = $pageId * Comments::LIMIT_PER_PAGE - Comments::LIMIT_PER_PAGE;
        $countComments = $this->countCommentsByIdTrick();
        $rest = $countComments > Comments::LIMIT_PER_PAGE ? false : $pageId * Comments::LIMIT_PER_PAGE < $countComments;
        return new Response(
            $this->environment->render(
                'block_for_include/block_for_coms_ajax.html.twig',
                [
                'user' => $this->getConnectedUser(),
                'commentsToShow' => $this->getCommentsToShow($trickId, $offset),
                'rest' => $rest
                ]
            )
        );
    }
}