<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // Créer une catégorie fakées
            $category = new Category();

            $category->setTitle("Politique")
                     ->setDescription($faker->paragraph());

            $manager->persist($category);

            // Créer entre 4 et 6 articles
            for($j = 1; $j <= mt_rand(4, 6); $j++) {
                $article = new Article();

                $article->setTitle($faker->sentence())
                    ->setContent($faker->paragraphs(10, true))
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);

                $manager->persist($article);

                //On donne des commentaires à l'article
                for($k = 1; $k <= mt_rand(4, 10); $k++) {
                    $comment = new Comment();

                    $days = (new \DateTime())->diff($article->getCreatedAt())->days;

                    $comment->setAuthor($faker->name())
                            ->setContent($faker->paragraphs(2, true))
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article);

                    $manager->persist($comment);
                }
            }
        $manager->flush();
    }
}
