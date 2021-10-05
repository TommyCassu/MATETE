<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005123305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_annonce (commande_id INT NOT NULL, annonce_id INT NOT NULL, INDEX IDX_EEE14582EA2E54 (commande_id), INDEX IDX_EEE1458805AB2F (annonce_id), PRIMARY KEY(commande_id, annonce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_annonce ADD CONSTRAINT FK_EEE14582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_annonce ADD CONSTRAINT FK_EEE1458805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce ADD producteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5AB9BB300 FOREIGN KEY (producteur_id) REFERENCES producteur (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5AB9BB300 ON annonce (producteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_annonce');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5AB9BB300');
        $this->addSql('DROP INDEX IDX_F65593E5AB9BB300 ON annonce');
        $this->addSql('ALTER TABLE annonce DROP producteur_id');
    }
}
