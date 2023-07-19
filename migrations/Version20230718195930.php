<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230718195930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, condition_value_id INT NOT NULL, availability_id INT NOT NULL, category_id INT DEFAULT NULL, sub_category_id INT DEFAULT NULL, user_id INT NOT NULL, edit_user_id INT NOT NULL, title_fr VARCHAR(255) NOT NULL, title_de VARCHAR(255) NOT NULL, title_it VARCHAR(255) NOT NULL, short_description_fr LONGTEXT NOT NULL, short_description_de LONGTEXT NOT NULL, short_description_it LONGTEXT NOT NULL, description_fr LONGTEXT NOT NULL, description_de LONGTEXT NOT NULL, description_it LONGTEXT NOT NULL, is_visible TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, price DOUBLE PRECISION NOT NULL, sale_price DOUBLE PRECISION NOT NULL, is_sale_price TINYINT(1) NOT NULL, INDEX IDX_D34A04ADDE6669BB (condition_value_id), INDEX IDX_D34A04AD61778466 (availability_id), INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04ADF7BFE87C (sub_category_id), INDEX IDX_D34A04ADA76ED395 (user_id), INDEX IDX_D34A04AD1D90682F (edit_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_availability (id INT AUTO_INCREMENT NOT NULL, title_fr VARCHAR(255) NOT NULL, title_de VARCHAR(255) NOT NULL, title_it VARCHAR(255) NOT NULL, is_available TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_condition (id INT AUTO_INCREMENT NOT NULL, title_fr VARCHAR(255) NOT NULL, title_de VARCHAR(255) NOT NULL, title_it VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDE6669BB FOREIGN KEY (condition_value_id) REFERENCES product_condition (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD61778466 FOREIGN KEY (availability_id) REFERENCES product_availability (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1D90682F FOREIGN KEY (edit_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADDE6669BB');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD61778466');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF7BFE87C');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD1D90682F');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_availability');
        $this->addSql('DROP TABLE product_condition');
    }
}
