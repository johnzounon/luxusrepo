<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Category::class, orphanRemoval: true)]
    private Collection $categories;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: SubCategory::class, orphanRemoval: true)]
    private Collection $subCategories;

    #[ORM\OneToMany(mappedBy: 'edit_user', targetEntity: Category::class, orphanRemoval: true)]
    private Collection $editcategories;

    #[ORM\OneToMany(mappedBy: 'edit_user', targetEntity: SubCategory::class, orphanRemoval: true)]
    private Collection $editSubCategories;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $products;

    #[ORM\OneToMany(mappedBy: 'edit_user', targetEntity: Product::class, orphanRemoval: true)]
    private Collection $editProducts;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ProductCondition::class, orphanRemoval: true)]
    private Collection $productConditions;

    #[ORM\OneToMany(mappedBy: 'edit_user', targetEntity: ProductCondition::class, orphanRemoval: true)]
    private Collection $editProductConditions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ProductAvailability::class, orphanRemoval: true)]
    private Collection $productAvailabilities;

    #[ORM\OneToMany(mappedBy: 'edit_user', targetEntity: ProductAvailability::class, orphanRemoval: true)]
    private Collection $editProductAvailabilities;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->subCategories = new ArrayCollection();
        $this->editcategories = new ArrayCollection();
        $this->editSubCategories = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->editProducts = new ArrayCollection();
        $this->productConditions = new ArrayCollection();
        $this->editProductConditions = new ArrayCollection();
        $this->productAvailabilities = new ArrayCollection();
        $this->editProductAvailabilities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

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

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setUser($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getUser() === $this) {
                $category->setUser(null);
            }
        }

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
            $subCategory->setUser($this);
        }

        return $this;
    }

    public function removeSubCategory(SubCategory $subCategory): static
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getUser() === $this) {
                $subCategory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getEditcategories(): Collection
    {
        return $this->editcategories;
    }

    public function addEditcategory(Category $editcategory): static
    {
        if (!$this->editcategories->contains($editcategory)) {
            $this->editcategories->add($editcategory);
            $editcategory->setEditUser($this);
        }

        return $this;
    }

    public function removeEditcategory(Category $editcategory): static
    {
        if ($this->editcategories->removeElement($editcategory)) {
            // set the owning side to null (unless already changed)
            if ($editcategory->getEditUser() === $this) {
                $editcategory->setEditUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SubCategory>
     */
    public function getEditSubCategories(): Collection
    {
        return $this->editSubCategories;
    }

    public function addEditSubCategory(SubCategory $editSubCategory): static
    {
        if (!$this->editSubCategories->contains($editSubCategory)) {
            $this->editSubCategories->add($editSubCategory);
            $editSubCategory->setEditUser($this);
        }

        return $this;
    }

    public function removeEditSubCategory(SubCategory $editSubCategory): static
    {
        if ($this->editSubCategories->removeElement($editSubCategory)) {
            // set the owning side to null (unless already changed)
            if ($editSubCategory->getEditUser() === $this) {
                $editSubCategory->setEditUser(null);
            }
        }

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
            $product->setUser($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getUser() === $this) {
                $product->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getEditProducts(): Collection
    {
        return $this->editProducts;
    }

    public function addEditProduct(Product $editProduct): static
    {
        if (!$this->editProducts->contains($editProduct)) {
            $this->editProducts->add($editProduct);
            $editProduct->setEditUser($this);
        }

        return $this;
    }

    public function removeEditProduct(Product $editProduct): static
    {
        if ($this->editProducts->removeElement($editProduct)) {
            // set the owning side to null (unless already changed)
            if ($editProduct->getEditUser() === $this) {
                $editProduct->setEditUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductCondition>
     */
    public function getProductConditions(): Collection
    {
        return $this->productConditions;
    }

    public function addProductCondition(ProductCondition $productCondition): static
    {
        if (!$this->productConditions->contains($productCondition)) {
            $this->productConditions->add($productCondition);
            $productCondition->setUser($this);
        }

        return $this;
    }

    public function removeProductCondition(ProductCondition $productCondition): static
    {
        if ($this->productConditions->removeElement($productCondition)) {
            // set the owning side to null (unless already changed)
            if ($productCondition->getUser() === $this) {
                $productCondition->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductCondition>
     */
    public function getEditProductConditions(): Collection
    {
        return $this->editProductConditions;
    }

    public function addEditProductCondition(ProductCondition $editProductCondition): static
    {
        if (!$this->editProductConditions->contains($editProductCondition)) {
            $this->editProductConditions->add($editProductCondition);
            $editProductCondition->setEditUser($this);
        }

        return $this;
    }

    public function removeEditProductCondition(ProductCondition $editProductCondition): static
    {
        if ($this->editProductConditions->removeElement($editProductCondition)) {
            // set the owning side to null (unless already changed)
            if ($editProductCondition->getEditUser() === $this) {
                $editProductCondition->setEditUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductAvailability>
     */
    public function getProductAvailabilities(): Collection
    {
        return $this->productAvailabilities;
    }

    public function addProductAvailability(ProductAvailability $productAvailability): static
    {
        if (!$this->productAvailabilities->contains($productAvailability)) {
            $this->productAvailabilities->add($productAvailability);
            $productAvailability->setUser($this);
        }

        return $this;
    }

    public function removeProductAvailability(ProductAvailability $productAvailability): static
    {
        if ($this->productAvailabilities->removeElement($productAvailability)) {
            // set the owning side to null (unless already changed)
            if ($productAvailability->getUser() === $this) {
                $productAvailability->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductAvailability>
     */
    public function getEditProductAvailabilities(): Collection
    {
        return $this->editProductAvailabilities;
    }

    public function addEditProductAvailability(ProductAvailability $editProductAvailability): static
    {
        if (!$this->editProductAvailabilities->contains($editProductAvailability)) {
            $this->editProductAvailabilities->add($editProductAvailability);
            $editProductAvailability->setEditUser($this);
        }

        return $this;
    }

    public function removeEditProductAvailability(ProductAvailability $editProductAvailability): static
    {
        if ($this->editProductAvailabilities->removeElement($editProductAvailability)) {
            // set the owning side to null (unless already changed)
            if ($editProductAvailability->getEditUser() === $this) {
                $editProductAvailability->setEditUser(null);
            }
        }

        return $this;
    }
}
