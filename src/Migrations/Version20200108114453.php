<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200108114453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie ADD libelle VARCHAR(255) NOT NULL, DROP femme, DROP homme, DROP enfant, DROP maison, DROP media_loisir, DROP autre');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categorie ADD femme VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD homme VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD enfant VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD maison VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD media_loisir VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD autre VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP libelle');
    }
}
