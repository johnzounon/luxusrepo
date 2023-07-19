<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717162433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD edit_user_id INT NOT NULL, ADD updated_at DATETIME NOT NULL, ADD is_visible TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C11D90682F FOREIGN KEY (edit_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_64C19C11D90682F ON category (edit_user_id)');
        $this->addSql('ALTER TABLE sub_category ADD edit_user_id INT NOT NULL, ADD updated_at DATETIME NOT NULL, ADD is_visible TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F7981D90682F FOREIGN KEY (edit_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BCE3F7981D90682F ON sub_category (edit_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C11D90682F');
        $this->addSql('DROP INDEX IDX_64C19C11D90682F ON category');
        $this->addSql('ALTER TABLE category DROP edit_user_id, DROP updated_at, DROP is_visible');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F7981D90682F');
        $this->addSql('DROP INDEX IDX_BCE3F7981D90682F ON sub_category');
        $this->addSql('ALTER TABLE sub_category DROP edit_user_id, DROP updated_at, DROP is_visible');
    }
}
