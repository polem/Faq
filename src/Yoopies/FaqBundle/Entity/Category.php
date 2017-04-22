<?php

namespace Yoopies\FaqBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Category
{
    private $title;
    private $categories;
    private $articles;

    public function __construct($title)
    {
        $this->title = $title;
        $this->categories = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function addCategory(self $category)
    {
        $this->categories->add($category);
    }

    public function addArticle(Article $article)
    {
        $this->articles->add($article);
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param ArrayCollection $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    /**
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param ArrayCollection $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }
}
