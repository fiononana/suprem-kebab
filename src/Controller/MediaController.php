<?php

namespace App\Controller;

use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/media')]
class MediaController extends AbstractController
{
    #[Route('/index', name: 'media_index', methods: ['GET'])]
    public function index(MediaRepository $mediaRepository): Response
    {
        return $this->render('media/index.html.twig', [
            'media' => $mediaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'media_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $medium = new Media();
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postData = $request->request->all();
            $entityManager = $this->getDoctrine()->getManager();
            $file = $form->get('photo')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $target_dir = __DIR__ . "../../photo" .$this->getParameter('photo_media');

            $target_file = $target_dir ."/". basename($fileName);
            try {
                $file->move(
                    $this->getParameter('photo_media'),
                    $target_file
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $medium->setPhoto($fileName);
            $entityManager->persist($medium);
            $entityManager->flush();

            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/new.html.twig', [
            'medium' => $medium,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'media_show', methods: ['GET'])]
    public function show(Media $medium): Response
    {
        return $this->render('media/show.html.twig', [
            'medium' => $medium,
        ]);
    }

    #[Route('/{id}/edit', name: 'media_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Media $medium): Response
    {
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $old_image = $request->request->get('old_image');
            $postData = $request->request->all();
            if (is_null($medium->getPhoto())) {
                $medium->setPhoto($old_image);
            } else {
                $file = $form->get('image')->getData();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $target_dir = __DIR__ . "../../photo" .$this->getParameter('photo_media');

                $target_file = $target_dir ."/". basename($fileName);
                move_uploaded_file($_FILES["media"]["tmp_name"]["image"], $target_file);
                $medium->setImage($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/edit.html.twig', [
            'medium' => $medium,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'media_delete', methods: ['DELETE'])]
    public function delete(Request $request, Media $medium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('media_index');
    }
}
