<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Service\ProduitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/produits")]
class ProduitController extends AbstractController
{

    // injection de dépendance de ProduitService dans le controller
    public function __construct(private ProduitService $service)
    {
    }

    // route retournant l'entièreté des produits
    #[Route("/", name: "get.produits", methods: "GET")]
    public function getAll(): JsonResponse
    {
        // on récupère les datas du service
        $data = $this->service->getAll();
        // on retourne au format json() les datas
        return $this->json($data);
    }

    // route retournant un produit par son id
    // prend en paramètre une id présente dans l'url
    #[Route("/{id}", name: "get.produit.by.id", methods: "GET")]
    public function getById(int $id): JsonResponse
    {
        $data = $this->service->getById($id);
        return $this->json($data);
    }


    #[Route('/add', name: "post.produit", methods: "POST")]
    public function save(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent());
        $result = $this->service->create($data);
        return $this->json($result);
    }

    #[Route("/update/{id}", name: "put.produit", methods: "PUT")]
    public function update(Request $request, int $id, Produits $produits = null): JsonResponse
    {
        if ($produits == null) {
            return $this->json("L'id est incorrecte");
        }
        $data = json_decode($request->getContent());
        $result = $this->service->update($data, $produits);
        return $this->json($result);
    }
}
