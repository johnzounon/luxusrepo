<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
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

    #[ORM\Column(type: Types::TEXT)]
    private ?string $short_description_fr = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $short_description_de = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $short_description_it = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_fr = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_de = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_it = null;

    #[ORM\Column]
    private ?bool $is_visible = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $sale_price = null;

    #[ORM\Column]
    private ?bool $is_sale_price = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductCondition $condition_value = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductAvailability $availability = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?SubCategory $sub_category = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'editProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $edit_user = null;

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

    public function getShortDescriptionFr(): ?string
    {
        return $this->short_description_fr;
    }

    public function setShortDescriptionFr(string $short_description_fr): static
    {
        $this->short_description_fr = $short_description_fr;

        return $this;
    }

    public function getShortDescriptionDe(): ?string
    {
        return $this->short_description_de;
    }

    public function setShortDescriptionDe(string $short_description_de): static
    {
        $this->short_description_de = $short_description_de;

        return $this;
    }

    public function getShortDescriptionIt(): ?string
    {
        return $this->short_description_it;
    }

    public function setShortDescriptionIt(string $short_description_it): static
    {
        $this->short_description_it = $short_description_it;

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

    public function isIsVisible(): ?bool
    {
        return $this->is_visible;
    }

    public function setIsVisible(bool $is_visible): static
    {
        $this->is_visible = $is_visible;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getSalePrice(): ?float
    {
        return $this->sale_price;
    }

    public function setSalePrice(float $sale_price): static
    {
        $this->sale_price = $sale_price;

        return $this;
    }

    public function isIsSalePrice(): ?bool
    {
        return $this->is_sale_price;
    }

    public function setIsSalePrice(bool $is_sale_price): static
    {
        $this->is_sale_price = $is_sale_price;

        return $this;
    }

    public function getConditionValue(): ?ProductCondition
    {
        return $this->condition_value;
    }

    public function setConditionValue(?ProductCondition $condition_value): static
    {
        $this->condition_value = $condition_value;

        return $this;
    }

    public function getAvailability(): ?ProductAvailability
    {
        return $this->availability;
    }

    public function setAvailability(?ProductAvailability $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSubCategory(): ?SubCategory
    {
        return $this->sub_category;
    }

    public function setSubCategory(?SubCategory $sub_category): static
    {
        $this->sub_category = $sub_category;

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

    public function getEditUser(): ?User
    {
        return $this->edit_user;
    }

    public function setEditUser(?User $edit_user): static
    {
        $this->edit_user = $edit_user;

        return $this;
    }
}
