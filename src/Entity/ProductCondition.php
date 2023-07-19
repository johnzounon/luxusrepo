<?php

namespace App\Entity;

use App\Repository\ProductConditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductConditionRepository::class)]
class ProductCondition
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

    #[ORM\OneToMany(mappedBy: 'condition_value', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $products;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'productConditions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'editProductConditions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $edit_user = null;

    public function __construct()
    {
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
            $product->setConditionValue($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getConditionValue() === $this) {
                $product->setConditionValue(null);
            }
        }

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
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

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
