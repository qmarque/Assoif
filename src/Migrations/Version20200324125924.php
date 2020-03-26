<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324125924 extends AbstractMigration
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
        $this->addSql('ALTER TABLE produit ADD typeproduit_id INT NOT NULL, CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27F66E9EF6 FOREIGN KEY (typeproduit_id) REFERENCES type_produit (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27F66E9EF6 ON produit (typeproduit_id)');
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
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27F66E9EF6');
        $this->addSql('DROP INDEX IDX_29A5EC27F66E9EF6 ON produit');
        $this->addSql('ALTER TABLE produit DROP typeproduit_id, CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE satistique CHANGE assoiffeur_id assoiffeur_id INT DEFAULT NULL');
    }
}
