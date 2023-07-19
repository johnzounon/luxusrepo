<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title_fr = null;

    #[ORM\Column(length: 255)]
    private ?string $title_de = null;

    #[ORM\Column(length: 255)]
    private ?string $title_it = null;

    #[ORM\Column(length: 255)]
    private ?string $title_fr_slug = null;

    #[ORM\Column(length: 255)]
    private ?string $title_de_slug = null;

    #[ORM\Column(length: 255)]
    private ?string $title_it_slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_fr = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_de = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_it = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: SubCategory::class, orphanRemoval: true)]
    private Collection $subCategories;

    #[ORM\ManyToOne(inversedBy: 'categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $UpdatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'editcategories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $edit_user = null;

    #[ORM\Column]
    private ?bool $is_visible = null;

    #[ORM\Column]
    private ?int $ranking = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private Collection $products;

    public function __construct()
    {
        $this->subCategories = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleFr(): ?string
    {
        return $this->title_fr;
    }

    public function setTitleFr(string $title_fr): static
    {
        $this->title_fr = $title_fr;

        return $this;
    }

    public function getTitleDe(): ?string
    {
        return $this->title_de;
    }

    public function setTitleDe(string $title_de): static
    {
        $this->title_de = $title_de;

        return $this;
    }

    public function getTitleIt(): ?string
    {
        return $this->title_it;
    }

    public function setTitleIt(string $title_it): static
    {
        $this->title_it = $title_it;

        return $this;
    }

    public function getTitleFrSlug(): ?string
    {
        return $this->title_fr_slug;
    }

    public function setTitleFrSlug(string $title_fr_slug): static
    {
        $this->title_fr_slug = $title_fr_slug;

        return $this;
    }

    public function getTitleDeSlug(): ?string
    {
        return $this->title_de_slug;
    }

    public function setTitleDeSlug(string $title_de_slug): static
    {
        $this->title_de_slug = $title_de_slug;

        return $this;
    }

    public function getTitleItSlug(): ?string
    {
        return $this->title_it_slug;
    }

    public function setTitleItSlug(string $title_it_slug): static
    {
        $this->title_it_slug = $title_it_slug;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->description_fr;
    }

    public function setDescriptionFr(string $description_fr): static
    {
        $this->description_fr = $description_fr;

        return $this;
    }

    public function getDescriptionDe(): ?string
    {
        return $this->description_de;
    }

    public function setDescriptionDe(string $description_de): static
    {
        $this->description_de = $description_de;

        return $this;
    }

    public function getDescriptionIt(): ?string
    {
        return $this->description_it;
    }

    public function setDescriptionIt(string $description_it): static
    {
        $this->description_it = $description_it;

        return $this;
    }

    /**
     * @return Collection<int, SubCategory>
     */
    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function addSubCategory(SubCategory $subCategory): static
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories->add($subCategory);
            $subCategory->setCategory($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategory $subCategory): static
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getCategory() === $this) {
                $subCategory->setCategory(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $UpdatedAt): static
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getEditUser(): ?User
    {
        return $this->edit_user;
    }

    public function setEditUser(?User $edit_user): static
    {
        $this->edit_user = $edit_user;

        return $this;
    }

    public function isIsVisible(): ?bool
    {
        return $this->is_visible;
    }

    public function setIsVisible(bool $is_visible): static
    {
        $this->is_visible = $is_visible;

        return $this;
    }

    public function getRanking(): ?int
    {
        return $this->ranking;
    }

    public function setRanking(int $ranking): static
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }
}
