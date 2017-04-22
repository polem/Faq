<?php

namespace Yoopies\FaqBundle\Services;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Yaml\Yaml;
use Yoopies\FaqBundle\Entity\Category;

class CategoryRepository
{
    /**
     * @var string
     */
    private $configFile;

    private $categoriesTree;

    /**
     * CategoryRepository constructor.
     * @param string $configFile
     */
    public function __construct(string $configFile) {

        $this->configFile = $configFile;
    }

    public function findAll()
    {
        if (null === $this->categoriesTree) {
            $this->loadCategories();
        }

        return $this->categoriesTree;
    }

    public function loadCategories()
    {
        $categoriesData = Yaml::parse(file_get_contents($this->configFile));

        $categoriesDataIndex = [];
        $categories = new ArrayCollection();
        $categoriesTree = new ArrayCollection();

        foreach ($categoriesData as $data) {
            $categoriesDataIndex[$data['slug']] = $data;
            $categories->set($data['slug'], new Category($data['title']));
        }

        foreach ($categoriesDataIndex as $slug => $data) {

            /** @var Category $category */
            $category = $categories->get($slug);

            if (!isset($data['category'])) {
                $categoriesTree->add($category);
                continue;
            }

            /** @var Category $parentCategory */
            $parentCategory = $categories->get($data['category']);
            $parentCategory->addCategory($category);

        }

        $this->categoriesTree = $categoriesTree;
    }
}