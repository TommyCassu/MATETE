<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211202144009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier ADD producteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2AB9BB300 FOREIGN KEY (producteur_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24CC0DF2AB9BB300 ON panier (producteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2AB9BB300');
        $this->addSql('DROP INDEX UNIQ_24CC0DF2AB9BB300 ON panier');
        $this->addSql('ALTER TABLE panier DROP producteur_id');
    }
}
