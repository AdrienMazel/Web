<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AuteurlistapiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AuteurlistapiRepository::class)
 */
#[ApiResource]
class Auteurlistapi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\OneToMany(targetEntity=ArticleApi::class, mappedBy="auteurs")
     */
    #[Groups(['read'])]
    private $Articles;

    public function __construct()
    {
        $this->Articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|ArticleApi[]
     */
    public function getArticles(): Collection
    {
        return $this->Articles;
    }

    public function addArticle(ArticleApi $article): self
    {
        if (!$this->Articles->contains($article)) {
            $this->Articles[] = $article;
            $article->setAuteurs($this);
        }

        return $this;
    }

    public function removeArticle(ArticleApi $article): self
    {
        if ($this->Articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAuteurs() === $this) {
                $article->setAuteurs(null);
            }
        }

        return $this;
    }
}
