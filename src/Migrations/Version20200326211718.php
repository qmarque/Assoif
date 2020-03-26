<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326211718 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assoiffe CHANGE cartebleue_id cartebleue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assoiffeur CHANGE administrateur_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE assoiffe_id assoiffe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification CHANGE assoiffe_id assoiffe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE satistique CHANGE assoiffeur_id assoiffeur_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assoiffe CHANGE cartebleue_id cartebleue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assoiffeur CHANGE administrateur_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande CHANGE assoiffe_id assoiffe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification CHANGE assoiffe_id assoiffe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE satistique CHANGE assoiffeur_id assoiffeur_id INT DEFAULT NULL');
    }
}
