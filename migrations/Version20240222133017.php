<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222133017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pdf_document (id INT AUTO_INCREMENT NOT NULL, pdf VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE participant DROP pdf_filename');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11CBFD05C FOREIGN KEY (pdf_document_id) REFERENCES pdf_document (id)');
        $this->addSql('CREATE INDEX IDX_D79F6B11CBFD05C ON participant (pdf_document_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pdf_document');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11CBFD05C');
        $this->addSql('DROP INDEX IDX_D79F6B11CBFD05C ON participant');
        $this->addSql('ALTER TABLE participant ADD pdf_filename VARCHAR(255) NOT NULL');
    }
}
