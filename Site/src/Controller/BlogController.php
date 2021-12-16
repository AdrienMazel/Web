<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Category;

use App\Form\ArticleType;
use App\Form\CommentType;
use App\Form\CategoryType;
use App\Form\SearchType;

use App\Data\SearchData;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home(ArticleRepository $repoArticle, Request $request)
    {
        $data = new SearchData();

        $form = $this->createForm(SearchType::class, $data);

        $form->handleRequest($request);

        $articles = $repoArticle->findSearch($data);
;
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles,
            'formSearch' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/edit/{id}", name="blog_edit")
     */
    public function formEdit(Article $article = null, Request $request, ObjectManager $manager)
    {

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $article->setCreatedAt(new \DateTime);

            $manager->persist($article);
            $manager->flush();

        }

        return $this->render('blog/edit.html.twig', [
            'formArticle' => $form->createView(),
            'article' => $article->getId()
        ]);
    }

    /**
     * @Route("/blog/user/{id}", name="blog_user")
     */
    public function blogUser(ArticleRepository $repo, User $user)
    {


        $articles = $repo->findBy(
            ['user_id' => $user->getId()]
        );

        return $this->render('blog/blog.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/blog/category", name="blog_category")
     */
    public function createCategory(Category $category = null, Request $request, ObjectManager $manager)
    {
        if(!$category) {
            $category = new Category();
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('blog_category');
        }

        return $this->render('blog/category.html.twig', [
            'formCategory' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/{id}/new", name="blog_create")
     */
    public function form(Article $article = null, User $user, Request $request, ObjectManager $manager)
    {
        if(!$article) {
            $article = new Article();
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $article->setCreatedAt(new \DateTime);
            $article->setUserId($user);

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/user/{user}/delete/{id}", name="blog_delete")
     */
    public function delete(Article $article, ObjectManager $manager, ArticleRepository $repo, User $user)
    {
        $manager->remove($article);
        $manager->flush();

        $articles = $repo->findBy(
            ['user_id' => $user->getId()]
        );

        return $this->render('blog/blog.html.twig', [
            'articles' => $articles
        ]);
    }
}