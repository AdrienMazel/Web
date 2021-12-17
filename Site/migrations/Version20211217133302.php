<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217133302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_api ADD CONSTRAINT FK_3F1AFB75AE784107 FOREIGN KEY (auteurs_id) REFERENCES auteurlistapi (id)');
        $this->addSql('CREATE INDEX IDX_3F1AFB75AE784107 ON article_api (auteurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_api DROP FOREIGN KEY FK_3F1AFB75AE784107');
        $this->addSql('DROP INDEX IDX_3F1AFB75AE784107 ON article_api');
    }
}
