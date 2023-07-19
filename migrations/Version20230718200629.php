<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230718200629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_availability ADD user_id INT NOT NULL, ADD edit_user_id INT NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product_availability ADD CONSTRAINT FK_B21380D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_availability ADD CONSTRAINT FK_B21380D41D90682F FOREIGN KEY (edit_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B21380D4A76ED395 ON product_availability (user_id)');
        $this->addSql('CREATE INDEX IDX_B21380D41D90682F ON product_availability (edit_user_id)');
        $this->addSql('ALTER TABLE product_condition ADD user_id INT NOT NULL, ADD edit_user_id INT NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE product_condition ADD CONSTRAINT FK_D3763ECEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product_condition ADD CONSTRAINT FK_D3763ECE1D90682F FOREIGN KEY (edit_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D3763ECEA76ED395 ON product_condition (user_id)');
        $this->addSql('CREATE INDEX IDX_D3763ECE1D90682F ON product_condition (edit_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_availability DROP FOREIGN KEY FK_B21380D4A76ED395');
        $this->addSql('ALTER TABLE product_availability DROP FOREIGN KEY FK_B21380D41D90682F');
        $this->addSql('DROP INDEX IDX_B21380D4A76ED395 ON product_availability');
        $this->addSql('DROP INDEX IDX_B21380D41D90682F ON product_availability');
        $this->addSql('ALTER TABLE product_availability DROP user_id, DROP edit_user_id, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE product_condition DROP FOREIGN KEY FK_D3763ECEA76ED395');
        $this->addSql('ALTER TABLE product_condition DROP FOREIGN KEY FK_D3763ECE1D90682F');
        $this->addSql('DROP INDEX IDX_D3763ECEA76ED395 ON product_condition');
        $this->addSql('DROP INDEX IDX_D3763ECE1D90682F ON product_condition');
        $this->addSql('ALTER TABLE product_condition DROP user_id, DROP edit_user_id, DROP created_at, DROP updated_at');
    }
}
