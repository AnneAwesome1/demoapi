<?php

namespace App\Service;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Throwable;

class ProduitService
{

    // injection de dépendance de ProduitsRepository
    public function __construct(private ProduitsRepository $repository)
    {
    }

    // méthode permettant la récupération de tout les produits dans le repository
    public function getAll(): array
    {
        // je viens récupérer les datas depuis la méthode finAll() du repository
        return $this->repository->findAll();
    }

    // méthode permettant de récupérer un produit par son id
    // l'id est récupérée depuis le controller
    /**
     * @throws Exception
     */
    public function getById(int $id): Produits | string
    {
        // on interroge le repository
        $data = $this->repository->find($id);

        // si le repo ne retourne pas de produit
        if ($data == null) {
           return "id inconnue";
        }
        // sinon on retourne le produit
        return $data;
    }

    public function create($data): Produits | string | null
    {
        $produit = new Produits();
        $produit->setNom($data->nom);
        $produit->setDescription($data->description);
        $produit->setPrix($data->prix);

        try {
            return $this->repository->save($produit, true);
        } catch (Throwable $e)
        {
            return $e->getMessage();
        }
    }

    public function update($data, Produits $produit): Produits | string | null
    {
        $produit->setNom($data->nom);
        $produit->setDescription($data->description);
        $produit->setPrix($data->prix);

        try {
            return $this->repository->save($produit, true);
        } catch (Throwable $e)
        {
            return $e->getMessage();
        }
    }
}
