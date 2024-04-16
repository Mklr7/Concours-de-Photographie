<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222151922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant ADD photo_id INT NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B117E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B117E9E4C8C ON participant (photo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B117E9E4C8C');
        $this->addSql('DROP INDEX IDX_D79F6B117E9E4C8C ON participant');
        $this->addSql('ALTER TABLE participant DROP photo_id');
    }
}
