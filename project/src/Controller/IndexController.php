<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Type\GuestbookType;
use App\Repository\GuestbookRepository;

class IndexController extends AbstractController
{
    public function __construct(private readonly int $limit, private readonly GuestbookRepository $repository)
    {

    }

    #[Route(path:'/', name:'index')]
    public function indexAction(Request $request): Response
    {
        $form = $this->createForm(GuestbookType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->repository->add($data);
            $this->repository->flush();
            $this->addFlash('success', 'Erfolgreich gespeichert!');
            return $this->redirectToRoute('index');
        }

        $maxPages = $this->getMaxPages($this->limit);
        $currentPage = $this->getCurrentPage($request, $maxPages);
        $entries = $this->repository->getPaginatedEntries($this->limit, $currentPage);

        return $this->renderForm('index.html.twig', [
            'guestBookForm' => $form,
            'entries' => $entries,
            'maxPages' => $maxPages,
            'currentPage' => $currentPage
        ]);
    }

    private function getMaxPages(int $limit): int
    {
        $totalEntries = $this->repository->count([]);
        return (int)ceil($totalEntries/$limit);
    }

    private function getCurrentPage(Request $request, int $maxPages): int
    {
        $page = (int)$request->get('page', 1);
        return min(max($page, 1), $maxPages);
    }
}
