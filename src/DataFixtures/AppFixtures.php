<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produit;
use App\Entity\Taille;
use App\Entity\Paiement;
use App\Entity\Couleur;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadClientUser($manager);
        $this->loadAdminUser($manager);
        // Création des tailles
        $tailleXS = new Taille();
        $tailleXS->setNom('XS');
        $manager->persist($tailleXS);

        $tailleS = new Taille();
        $tailleS->setNom('S');
        $manager->persist($tailleS);

        $tailleM = new Taille();
        $tailleM->setNom('M');
        $manager->persist($tailleM);

        $tailleL = new Taille();
        $tailleL->setNom('L');
        $manager->persist($tailleL);

        $tailleXL = new Taille();
        $tailleXL->setNom('XL');
        $manager->persist($tailleXL);

        $tailleXXL = new Taille();
        $tailleXXL->setNom('XXL');
        $manager->persist($tailleXXL);

        $tailleXXXL = new Taille();
        $tailleXXXL->setNom('XXXL');
        $manager->persist($tailleXXXL);

        // Création des couleurs
        $couleurBeige = new Couleur();
        $couleurBeige->setNom('Beige');
        $manager->persist($couleurBeige);

        $couleurBlanc = new Couleur();
        $couleurBlanc->setNom('Blanc');
        $manager->persist($couleurBlanc);

        $couleurBleu = new Couleur();
        $couleurBleu->setNom('Bleu');
        $manager->persist($couleurBleu);

        $couleurGris = new Couleur();
        $couleurGris->setNom('Gris');
        $manager->persist($couleurGris);

        $couleurJaune = new Couleur();
        $couleurJaune->setNom('Jaune');
        $manager->persist($couleurJaune);

        $couleurKaki = new Couleur();
        $couleurKaki->setNom('Kaki');
        $manager->persist($couleurKaki);

        $couleurMarron = new Couleur();
        $couleurMarron->setNom('Marron');
        $manager->persist($couleurMarron);

        $couleurNoir = new Couleur();
        $couleurNoir->setNom('Noir');
        $manager->persist($couleurNoir);

        $couleurOrange = new Couleur();
        $couleurOrange->setNom('Orange');
        $manager->persist($couleurOrange);

        $couleurRose = new Couleur();
        $couleurRose->setNom('Rose');
        $manager->persist($couleurRose);

        $couleurRouge = new Couleur();
        $couleurRouge->setNom('Rouge');
        $manager->persist($couleurRouge);

        $couleurVert = new Couleur();
        $couleurVert->setNom('Vert');
        $manager->persist($couleurVert);

        $couleurViolet = new Couleur();
        $couleurViolet->setNom('Violet');
        $manager->persist($couleurViolet);

        // Création des moyens de paiement
        $paiementCarte = new Paiement();
        $paiementCarte->setNom('Carte bancaire');
        $manager->persist($paiementCarte);

        $paiementCheque = new Paiement();
        $paiementCheque->setNom('Chèque');
        $manager->persist($paiementCheque);

        $paiementVirement = new Paiement();
        $paiementVirement->setNom('Virement');
        $manager->persist($paiementVirement);

        $paiementPrelevement = new Paiement();
        $paiementPrelevement->setNom('Prélèvement');
        $manager->persist($paiementPrelevement);

        $manager->flush();

        // Création des produits
        for ($i = 1; $i <= 30; $i++) {
            $produit = new Produit();
            $produit->setNom('Produit ' . $i);
            $produit->setPrix(mt_rand(10, 100));

            // Alternez entre les tailles XS et S
            $produit->addTaille($i % 2 === 0 ? $tailleXS : $tailleS);

            // Alternez entre les couleurs Rouge et Bleu
            $produit->setCouleur($i % 2 === 0 ? 'Rouge' : 'Bleu');

            $produit->setDescription('blabla');

            // Alternez entre les moyens de paiement Carte bancaire et Chèque
            $produit->setMoyenPaiement($i % 2 === 0 ? $paiementCarte : $paiementCheque);

            // Alternez entre les produits en ligne et hors ligne
            $produit->setOnline($i % 2 === 0);

            $manager->persist($produit);
        }

    }
        private function loadClientUser(ObjectManager $manager)
        {
            $client = new User();
            $client->setEmail('client@example.com');
            $client->setRoles(['ROLE_USER']);
            $client->setPassword($this->passwordHasher->hashPassword($client, 'password'));
            $client->setNom('Client');
            $client->setPrenom('User');
            $client->setAge(25);
            $client->setAdresse('123 Street, City');
            $client->setTelephone('123456789');
    
            $manager->persist($client);
            $manager->flush();
        }
    
        private function loadAdminUser(ObjectManager $manager)
        {
            $admin = new User();
            $admin->setEmail('admin@example.com');
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($this->passwordHasher->hashPassword($admin, 'adminpassword'));
            $admin->setNom('Admin');
            $admin->setPrenom('Admin');
            $admin->setAge(30);
            $admin->setAdresse('456 Street, City');
            $admin->setTelephone('987654321');
            $manager->persist($admin);
            $manager->flush();
        }
    }
